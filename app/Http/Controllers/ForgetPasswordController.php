<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
   public function forgetpassword()
   {
         return view('forgetpasswordform');
   }

   public function forget_password(Request $request)
    {     
        // Retrieve the value from the 'email' input field
        $emailInput = $request->input('email');

        // Validate the 'email' input field
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);
        $tokenhash = bcrypt($token);

        // to either update the existing reset entry or create a new one
        PasswordReset::updateOrCreate(
            ['email' => $emailInput], // Conditions to find the record
            ['token' => $tokenhash, 'created_at' => now()] // Fields to update or create
        );

        // Construct the password reset URL
        $resetUrl = url("/resetpassword/{$token}?email={$emailInput}");

        // Email subject
        $subject = 'Password Reset Link';
    

        // Send the email using a view
        try {
            Mail::send('email.resetpassword', ['resetUrl' => $resetUrl], function ($msg) use ($emailInput, $subject) {
                $msg->to($emailInput)->subject($subject);
            });
            return back()->with('message', 'Reset email sent successfully, check your inbox!');
        } 
        catch (\Exception $e) 
        {
            
            return back()->with('message', 'Mail sending failed');
        }
    }

    public function validateResetPasswordRequest(Request $request, $token = null)
    {
        $email = $request->query('email');
        
        // Retrieve the token record from the password_resets table
        $tokenRecord = PasswordReset::where('email', $email)->first();

        // Check if the token record exists and if the token matches after hashing
        if ($tokenRecord && Hash::check($token, $tokenRecord->token)) 
        {
            // Token is valid, show the reset password form
            return view('resetpasswordform', ['token' => $token, 'email' => $email]);
        } 
        else 
        {
            // Token is invalid or does not exist
            return redirect()->route('reset.status');
        }
    }

    public function PasswordResetstatuspage()
    {
        $message = 'Invalid or expired token.';
        return view('email.displayresetpasswordstatus', compact('message'));
    }


   public function changepassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/','confirmed'],
        ]);

        $pass = $request['password'];
        $email = $request['email'];

        $user = User::where('email', $email)->update(['password' => Hash::make($pass)]);

        if($user) 
        {
            PasswordReset::where('email', $email)->delete();   //Deleting token record from the PasswordReset table
            return redirect('/loginform')->with('PasswordResetstatus', 'Password has been successfully reset.');    
        } 
        else 
        {
            return back()->with('message', 'There was an error resetting your password.');
        }
    }   
}



