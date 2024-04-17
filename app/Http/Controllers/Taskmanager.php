<?php

namespace App\Http\Controllers;
use App\Models\projects;
use App\Models\User;
use App\Models\tasks;
use App\Models\files;
use App\Models\task_files;
use App\Models\project_task;
use App\Models\task_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Taskmanager extends Controller
{
    public function get_projects_users()
    {
        $projects = projects::all();
        $users = User::all();

        // Now you can use $projects in your view or further processing
        return view('Todolist', compact('projects'), compact('users'));
    }

    public function add_task(Request $request) 
    {   
      try
      {
        DB::transaction(function () use ($request)
        {   
            //tasks table
            $task = new tasks();
            $task->task = $request->input('task');
            $task->description = $request->input('description');
            $task->priority = $request->input('priority');
            $task->save();
            $lastInsertedId = $task->task_id;   //last inserted task id
                
            //files table operation
            if($request->hasFile('FILE')) 
            {    
                $fileIDs = array();

                $request->validate([
                    'FILE.*' => 'mimes:jpg,jpeg,pdf,csv|max:2048',  // Only allow .jpg, .jpeg, and .png file types. Limit the size to 2048 kilobytes.
                ]);

                foreach($request->file('FILE') as $file) 
                {   
                
                    $filename = $file->getClientOriginalName();
    
                    // Move the file to your desired location (public/uploads in this case)
                    $file->move(public_path('uploads'), $filename);
    
                    // Insert the file info into the database
                    $fileRecord = new files();
                    $fileRecord->file_name = $filename;
                    $fileRecord->file_loc = 'uploads/' . $filename;
                    $fileRecord->task_id =  $lastInsertedId;
                    $fileRecord->save();
                    $fileIDs[] = $fileRecord->file_id;   //last inserted file id     
                }
                
            }
            
            // Insert into task_file data into the database
            foreach ($fileIDs as $fileID) 
            {
                $task_file = new task_files();
                $task_file->task_id =   $lastInsertedId;
                $task_file->file_id = $fileID;
                $task_file->save();
            }

            //Insert intp project_task table
            if($request->has('selectedProjects'))
            {    
                
                foreach ($request->input('selectedProjects') as $projectname)
                {
                    $project_selected = projects::where('project_name',$projectname)->first();
                   
                    $project_tasks = new project_task();
                    $project_tasks->project_id = $project_selected->Project_id;
                    $project_tasks->task_id =   $lastInsertedId;
                    $project_tasks->save();
                }
            }
            
            //Insert into task_user table
            if($request->has('selectedUsers'))
            {    
                
                foreach ($request->input('selectedUsers') as $user)
                {
                    $user_selected = User::where('name',$user)->first();
                   
                    $task_users = new task_user();
                    $task_users->id = $user_selected->id;
                    $task_users->task_id =   $lastInsertedId;
                    $task_users->save();
                }
            }
               
        });
        return redirect('/todolist')->with('message', 'Task and its details added successfully'); 
      }
      
       catch (\Exception $e) 
        {
        return redirect()->back()->with('error', 'Error inserting data: ' . $e->getMessage());
        }
    }

    public function Displaytasks()
    {
        // Retrieve tasks
        $tasks = tasks::with('task_user', 'task_files', 'projects')->get();

        // Pass tasks to the view
        return view('taskdisplay', ['tasks' => $tasks]);
    }

}
