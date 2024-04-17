<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projects;
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



    
}