<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\PasswordReset;
use App\Http\Middleware\AuthGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class User_authenticationTest extends TestCase
{
    //use RefreshDatabase;
    public function test_unauthorized_user_cannot_access_projectform()
    {
        $response = $this->get('/projectform');
        $response->assertRedirect('/loginform');
        $response->assertStatus(302);
    }
    
    public function test_authorized_user_can_access_projecform()
    {
        $user = User::factory()->create();
    
        // Make a request to the /projectform route
        $response = $this->actingAs($user)
                         ->get('/projectform');
                         
        $response->assertStatus(200);
    }

    public function test_forget_password_sends_email()
    {
        // Create a user
        $user = User::factory()->create();
    
        // Fake the Mail facade
        Mail::fake();
    
        // Call the forget_password method
        $response = $this->post('/forgetpassword', ['email' => $user->email]);
    
        // Assert the response status is a redirect
        $response->assertRedirect();
        $response->assertStatus(302);  
    
        // Assert a mailable was sent to the given user
        Mail::assertSent(\App\Mail\ResetPasswordMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        // Assert a token was created for the user
        $this->assertDatabaseHas('password_resets', ['email' => $user->email]);
    }
    

    public function test_validate_password_reset_request()
    {
        $user = User::factory()->create();
        $token = Str::random(40);
        PasswordReset::create([
            'email'=> $user->email,
            'token'=> bcrypt($token),
        ]);

        $response= $this->get("/resetpassword/{$token}?email={$user->email}");
        $response->assertOk();
        $response->assertViewIs('resetpasswordform');

    }

    public function test_validate_invalid_password_reset_request()
    {
        $user = User::factory()->create();
        $token = Str::random(40);
        PasswordReset::create([
            'email'=> $user->email,
            'token'=> bcrypt($token),
        ]);

        $response= $this->get("/resetpassword/{$token}?Email={$user->email}");   //here, Email is used instead of email, so test passes.
        $response->assertRedirect(route('reset.status'));
    }

    public function test_change_password_with_valid_data()
    {
        $user = User::factory()->create();
        $token = Str::random(40);

        PasswordReset::create([
            'email'=> $user->email,
            'token'=> bcrypt($token),
        ]);
        
        $validData = [
            'password' => 'Newpassword@12',
            'password_confirmation' => 'Newpassword@12',
            'email' => $user->email,
        ];
    
        $response = $this->post('/resetpassword', $validData);
    
        // Re-retrieve the user from the database to store updatedhashed password to the user object
        $user = $user->fresh();
    
        // Assert the password was updated
        $hashedPassword = $user->password;   //now this contains updated hashed password
        $this->assertTrue(Hash::check($validData['password'], $hashedPassword));
    
        // Assert the token record is deleted from the PasswordReset table
        $this->assertDatabaseMissing('password_resets', [
            'email' => $validData['email'],
        ]);
        // Assert a redirect to the login form 
        $response->assertRedirect('/loginform');
        $response->assertSessionHas('PasswordResetstatus', 'Password has been successfully reset.');
        
    }
    
    public function test_change_password_with_invalid_data()
    {
        $user = User::factory()->create();
        $token = Str::random(40);  
        PasswordReset::create([
            'email'=> $user->email,
            'token'=> bcrypt($token),
        ]);

        $invalidData = [
            'password' => 'Newpassword@12',
            'password_confirmation' => 'ewpassword@12',
            'email' => $user->email,
        ];
    
        $response = $this->post('/resetpassword', $invalidData);      

        // Assert the token record is still there in the PasswordReset table
        $this->assertDatabasehas('password_resets', [
            'email' => $invalidData['email'],
        ]);

        $response->assertRedirect();     //redirect back to the resetpassword form and display error
    }
      

    

    
    
    

}
