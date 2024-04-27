<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function signup_form(Request $request)
    {
        $request->validate([

          'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
          'email' => 'required|string|email|unique:users', 
          'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/'],
      ]);


        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->gender = $request['gender'];
  
        
        if($user->save())
        {
            return redirect('/signupform')->with('message', 'User successfully signed up!');
        }
      
    }


    public function login_form(Request $request)
    {
          $request->validate([
          'email' => 'required|string|email',
          'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/'],
      ]);

      $credentials = [
          'email' => $request->input('email'),
          'password' => $request->input('password'), 
      ];

      if (Auth::attempt($credentials)) 
      {
           // Get the authenticated user
            $user = Auth::user();

            // Store the user ID in the session
            session()->put('user_id', $user->id);
            session()->put('user', $user->name);

            return redirect('/projectform');
      } 
      else 
      {
          return redirect('/loginform')->with('message', 'Invalid email address or password!');
      }

    }

    public function project_form(Request $request)
    {
        $request->session()->forget('selectedUser');
        $request->session()->forget('selectedProject');
        
        $proj = new ProjectManagerController();
        return $proj->DisplayProjects();
        
        //$totalRows = DB::table('projects')->count(); // Get the total number of rows
       // $paginationController = new PaginationController();
       // $result = $paginationController->displayPagination('Project', $totalRows); 
       
       
    }

}
