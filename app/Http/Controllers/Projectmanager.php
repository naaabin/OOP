<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projects;
use App\Models\User;
use App\Models\project_task;
use App\Models\tasks;
use App\Models\files;
use Illuminate\Support\Facades\Auth;

class Projectmanager extends Controller
{    
    public function add_project(Request $request)
    {
        $projectname = $request['project'];
        $description = $request['description'];

        $projectadd = new projects();
       

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

    public function logout(Request $request)
    {
        Auth::logout();

        //You can also clear the session data if needed
         $request->session()->flush();

        return redirect('/loginform')->with('message', 'You have been logged out successfully.');
    }


    public function Displayprojects()
    {
        // Retrieve tasks
        $projects = projects::with(['tasks.users', 'tasks.files'])->get();

        $noprojecterror = '';
        if($projects->isEmpty())
        {
            $noprojecterror = 'No tasks to display, please add tasks';
        }
        return view('projectdisplay', ['projects' => $projects, 'noprojecterror' => $noprojecterror]);
    }

    public function userdashboard()
    {
        $users = User::with('tasks')->get();
        return view('Userdashboard', ['users' => $users]);

    }

    public function filterpage()
    {
      // Retrieve all users and projects from the database
        $users = User::all();
        $projects = projects::all();

        // Retrieve all tasks with their associated user and project
        $tasks = tasks::with('users', 'projects')->get();


        return view('filtering', ['users' => $users, 'projects' => $projects, 'tasks' => $tasks]);
    }

    public function process_filter(Request $request)
    {
        $request->flash();
        $selectedUser = $request->input('user');
        $selectedProject = $request->input('project');
    
        // Start a query builder instance
        $query = tasks::query();
    
        // Apply filters on the query builder instance
        if ($selectedUser && $selectedProject) 
        {
            $query->whereHas('users', function ($query) use ($selectedUser) {
                $query->where('users.id', $selectedUser);
            })->whereHas('projects', function ($query) use ($selectedProject) {
                $query->where('projects.project_id', $selectedProject);
            });
        }
        elseif ($selectedUser) 
        {
            $query->whereHas('users', function ($query) use ($selectedUser) {
                $query->where('users.id', $selectedUser);
            });
        }
        elseif ($selectedProject) 
        {
            $query->whereHas('projects', function ($query) use ($selectedProject) {
                $query->where('projects.project_id', $selectedProject);
            });
        }
    
        // Execute the query and get the results
        $tasks = $query->with('users', 'projects', 'files')->get();
    
        // Retrieve all users and projects from the database
        $users = User::all();
        $projects = projects::all();
    
        // Return the filtered tasks to a view
        return view('/filtering', ['tasks' => $tasks, 'users' => $users, 'projects' => $projects]);
    }
    

    
}