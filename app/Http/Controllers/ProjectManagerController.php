<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProjectManagerController extends Controller
{    
    public function add_project(Request $request)
    {
        $projectname = $request->input('project');
        $description = $request->input('description');
        $projectadd = new Project();
        $projectadd->project_name = $projectname;
        $projectadd->description = $description;

        if($projectadd->save())
        {
            return back()->with('message', 'Project added successfully');

        }
        else
        {
            return back()->with('message', 'Project add failed');
        }
      
    }

    public function editprojectpage(Request $request)
    {
            $id = $request->query('project_id');
 
            $project = Project::find($id);
            if(is_null($project))
            {
                abort(404, 'Invalid project id');    
            }
            else
            {
                 return view('editproject')->with('project',$project);
            }
    }

    public function editproject(Request $request)
    {   
        $id = $request->input('new_ID');
        $project = Project::find($id);
        $project->Project_name = $request->input('new_project');
        $project->Description = $request->input('new_description');
        
        if($request->has('back'))
        {
            return redirect('/projectform');
        }

        elseif($project->save())
        {
            return redirect('/projectform')->with('message', 'The selected project has been updated successfully');
        }
      
        else
        {
            return redirect('/projectform')->with('error', 'Project update failed');
        }
    }

    public function deleteproject(Request $request)
    {
            $id = $request->query('project_id');
            $project = Project::find($id);
            if($project==null)
            {
                abort(404, 'Invalid project id');
            }
            else
            {
                $delete_status = Project::destroy($id); 
                if($delete_status)
                {
                    return redirect('/projectform')->with('message', 'The selected project has been deleted successfully');
                }
                else
                {
                    return redirect('/projectform')->with('error', 'project deletion failed');
                }
            }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        //clear the session data 
         $request->session()->flush();

        return redirect('/loginform')->with('message', 'You have been logged out successfully.');
    }


    public function DisplayProjects()
    {
        
        $projects = Project::all();
        $noprojecterror = '';
        if($projects->isEmpty())
        {
            $noprojecterror = 'No Project to display, please add project.';
        }

        $totalRows = DB::table('projects')->count(); // Get the total number of rows
        $paginationController = new PaginationController();
        $result = $paginationController->displayPagination('Project', $totalRows); 

        return view('projectdisplay',['noprojecterror'=>$noprojecterror,'pagination' => $result['pagination'], 'data' => $result['data']]);
        
    }

    public function userdashboard()
    {
        $users = User::with('tasks')->get();
        return view('Userdashboard', ['users' => $users]);

    }

    public function filterpage()
    {
        
        // Retrieve the flashed data from the session
        $tasks = session('tasks');
        $userfilter = session('userfilter');
        $projectfilter = session('projectfilter');
        $users = session('users');
        $projects = session('projects');
        $taskfilter = session('taskfilter');

        // If there is no flashed data, retrieve all users, Project, and Task from the database
        if (!$tasks && !$userfilter && !$projectfilter && !$users && !$projects && !$taskfilter) 
        {
            $users = User::all();
            $projects = Project::all();
            $tasks = Task::with('users', 'projects')->get();
        }

        return view('filtering', ['users' => $users, 'projects' => $projects, 'tasks' => $tasks , 'userfilter'=> $userfilter, 'projectfilter'=> $projectfilter, 'taskfilter' => $taskfilter]);
    }

    public function process_filter(Request $request)
    {
        // Get the selected user and project from the request
        $selectedUser = $request->input('UserDropdownData');
        $selectedProject = $request->input('ProjectDropdownData');

        // Store the selected user and project into the session
        $request->session()->put('selectedUser', $selectedUser);
        $request->session()->put('selectedProject', $selectedProject);

        // Retrieve all users and Project from the database
        $users = User::all();
        $projects = Project::all();

        // Initialize the variables to hold the results
        $userfilter = null;
        $projectfilter = null;
        $taskfilter = null;
        $tasks = null;

        // If a user is selected and no project is selected, fetch the user with its associated Task, Project, and files
        if (!empty($selectedUser) && empty($selectedProject)) 
        {
            $userfilter = User::with(['tasks.projects', 'tasks.files', 'tasks.users'])->find($selectedUser);
        }
        // If a project is selected and no user is selected, fetch the project with its associated Task, users, and files
        elseif (empty($selectedUser) && !empty($selectedProject)) 
        {
            $projectfilter = Project::with('tasks.projects', 'tasks.files', 'tasks.users')->find($selectedProject);
        }
        // If both a user and a project are selected, filter Task based on the selected user and project
        elseif (!empty($selectedUser) && !empty($selectedProject)) 
        {
            $taskfilter = Task::whereHas('users', function ($query) use ($selectedUser) {
                $query->where('users.id', $selectedUser);
            })->whereHas('projects', function ($query) use ($selectedProject) {
                $query->where('projects.project_id', $selectedProject);
            })->with(['users', 'projects', 'files'])->get();
        }

        // If neither a user nor a project is selected, fetch all Task with their associated users, Project, and files
        else 
        {
            $tasks = Task::with(['users', 'projects', 'files'])->get();
        }

        // Redirect to the filtering page with the results
        return redirect('/filtering')->with([
            'tasks' => $tasks,
            'userfilter' => $userfilter,
            'projectfilter' => $projectfilter,
            'users' => $users,
            'projects' => $projects,
            'taskfilter' => $taskfilter
        ]);
    }
    
}