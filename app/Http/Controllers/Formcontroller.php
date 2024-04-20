<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\projects;

use Illuminate\Http\Request;

use Auth;

class Formcontroller extends Controller
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

      // Map the form input names to the database column names
      $credentials = [
          'email' => $request->input('email'),
          'password' => $request->input('password'), // 'password' is used here because Laravel will hash it automatically
      ];

      if (Auth::attempt($credentials)) 
      {
           // Get the authenticated user
            $user = Auth::user();

            // Store the user ID in the session
            session()->put('user_id', $user->id);

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
        $projects = projects::with(['tasks.users', 'tasks.files'])->get();
        return view('projectform', ['projects' => $projects]);
       
    }
    

}
