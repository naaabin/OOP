<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\Pnote;

class ProjectManagerController extends Controller
{    

    public function project_form(Request $request)
    {
        $request->session()->forget('selectedUser');
        $request->session()->forget('selectedProject');
        return view('projectform');
    }

    public function add_project(Request $request)
    {
        $projectname = $request->input('project_name');
        $description = $request->input('description');
        $projectadd = new Project();
        $projectadd->project_name = $projectname;
        $projectadd->description = $description;

        if($projectadd->save())
        {
            return redirect('/projectdisplay')->with('message', 'Project added successfully');

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
                abort(404);
            }
            else
            {
                 return view('editproject')->with('project',$project);
            }
    }

    public function editproject(Request $request)
    {
            if($request->has('back'))
            {
                return redirect('/projectdisplay');
            }

                $id = $request->input('new_ID');
              
                // Retrieve the project instance
                $project = Project::find($id);
                
                if (is_null($project)) 
                {
                    abort(404);
                }

                $request->validate([
                
                    'note' => 'required|string'

                ]);
                
                $note = $request->input('note');
                // Create a new note
                $note = new Pnote();
                $note->project_id = $id;
                $note->Description = $request->input('note');
                $note->save();
        
                // Update the project
                $project->project_name = $request->input('new_project');
                $project->description  = $request->input('new_description');
                
                if($project->save())
                {
                    return redirect('/projectdisplay')->with('message', 'The selected project has been updated successfully');

                }
                else
                {
                    return redirect('/projectdisplay')->with('error', 'Project Update failed, please try again');

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
                    return redirect('/projectdisplay')->with('message', 'The selected project has been deleted successfully');
                }
                else
                {
                    return redirect('/projectdisplay')->with('error', 'Project deletion failed');
                }
            }
    }


    public function logout(Request $request)
    {
    
            Auth::logout();
            $request->session()->flush();


            return redirect('/loginform')->with('message', 'You have been logged out successfully.');
    }
    
    public function DisplayProjects()
    {
        
        $projects = Project::paginate(3);
    
        return view('projectdisplay', [
       
        'projects' => $projects
       ]);   
    }

    public function userdashboard()
    {
        $users = User::with('tasks')->get();
        return view('Userdashboard', ['users' => $users]);

    }

    public function filterpage(Request $request)
    {
        // Get the selected user and project from the request
        $selectedUser = $request->input('UserDropdownData');
        $selectedProject = $request->input('ProjectDropdownData');
    
        // Store the selected user and project into the session
        $request->session()->put('selectedUser', $selectedUser);
        $request->session()->put('selectedProject', $selectedProject);

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
        else
        {
          
            $tasks = Task::with('users', 'projects')->get();
        }
    
        // Return the view with the filtered data
        return view('filtering', [
            'tasks' => $tasks,
            'userfilter' => $userfilter,
            'projectfilter' => $projectfilter,
            'taskfilter' => $taskfilter,
        ]);
    }
    
    public function Projectupdatehistory(Request $request)
    {
        $id = $request->query('project_id');
        $projects = Project::where('project_id', $id)->with('notes')->get();
        return view('ProjectUpdateStatusPage', ['projects'=> $projects]);
    }
       
}