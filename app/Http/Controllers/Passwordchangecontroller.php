<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;

class PasswordChangeController extends Controller
{
    public function change_password(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/', 'confirmed'],
        ]);

        // Make sure the session has started before accessing session data
        if ($request->session()->has('user_id')) 
        {
           
             $user = User::where('id', session('user_id'))->first();
             
            if ($user && password_verify($request['oldpassword'], $user->password)) 
            {
                // Update the user's password
                $user->update(['password' => Hash::make($request['password'])]);
                Auth::logout();
                $request->session()->forget('user');
                return redirect('/loginform')->with('passwordchange', 'Password has been successfully changed.');
            } 
            else 
            {
                return back()->with('message', 'There was an error resetting your password.');
            }
        } 
        else 
        {
            return back()->with('message', 'Session expired or user not authenticated.');
        }
    }
}
