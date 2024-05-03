<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\FormController;

class FormControllerTest extends TestCase
{
    //use RefreshDatabase; // Use the RefreshDatabase trait to reset the database after each test

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_signup() 
    {
        $user = [
            'name' => 'Kiran',
            'email' => 'kiran@gmail.com',
            'password' => 'Kiran@123',
            'gender' => 'male',
        ];
    
        // Make a POST request to the signup form route
        $response = $this->post(route('signupform'), $user);
    
        // Assert that the response redirects to the signup form
        $response->assertRedirect();
        
         // Assert that the user details are inserted into the database
        $this->assertDatabaseHas('users', [
            'name' => 'Kiran',
            'email' => 'kiran@gmail.com',
            'gender' => 'male',
        ]);
    }
    
    public function test_login() 
    {
        $credentials = [
         
            'email' => 'kiran@gmail.com',
            'password' => 'Kiran@123',
         
        ];
    
        // Make a POST request to the signup form route
        $response = $this->post('/loginform', $credentials);
    
        // Assert that the response redirects to the signup form
        $response->assertRedirect(route('projectdisplay'));
       
    }
}
