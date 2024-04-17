<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Formcontroller;
use App\Http\Controllers\Projectmanager;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\Passwordchangecontroller;
use App\Http\Controllers\Taskmanager;
use App\Http\Controllers\User;
use App\Http\Controllers\projects;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/loginform', function () {
    return view('loginform');
});

Route::get('/signupform', function () {
    return view('signupform');
});

Route::post('/loginform', [Formcontroller::class ,'login_form'])->name('loginform');
Route::post('/signupform', [Formcontroller::class ,'signup_form'])->name('signupform');
Route::get('/projectform' , [Formcontroller::class ,'project_form'])->name('projectform');

Route::post('/projectadd', [Projectmanager::class ,'add_project'])->name('projectadd');
Route::get('/logout', [Projectmanager::class ,'logout'])->name('logout');
Route::get('/forgetpassword', [ForgetPassword::class, 'forgetpassword']);
Route::post('/forgetpassword', [ForgetPassword::class, 'forget_password']);
Route::get('/passwordresetstatus', [ForgetPassword::class, 'passwordresetstatuspage']);

Route::get('/resetpassword/{token}', [ForgetPassword::class, 'validateResetPasswordRequest']);
Route::post('/resetpassword', [ForgetPassword::class, 'changepassword'])->name('change_password');

Route::get('/changepassword', function () {
    return view('changepassword');
});

Route::post('/changepassword', [Passwordchangecontroller::class ,'change_password']);
Route::get('/todolist', [Taskmanager::class, 'get_projects_users']);
Route::post('/addtask', [Taskmanager::class, 'add_task']);

Route::get('/taskdisplay', [Taskmanager::class , 'Displaytasks']);

Route::get('/edit-task' ,[Taskmanager::class, 'edittaskpage']);
Route::post('/edittask', [Taskmanager::class, 'edittask']);


Route::get('/delete-task' ,[Taskmanager::class, 'deletetask']);


