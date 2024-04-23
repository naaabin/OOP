<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProjectManagerController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\TaskManagerController;

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
})->middleware('guest');

Route::get('/signupform', function () {
    return view('signupform');
});


Route::post('/loginform', [FormController::class ,'login_form'])->name('loginform');
Route::post('/signupform', [FormController::class ,'signup_form'])->name('signupform');

Route::post('/projectadd', [ProjectManagerController::class ,'add_project'])->name('projectadd');
Route::get('/logout', [ProjectManagerController::class ,'logout'])->name('logout');
Route::get('/ForgetPasswordController', [ForgetPasswordController::class, 'ForgetPasswordController']);
Route::post('/ForgetPasswordController', [ForgetPasswordController::class, 'forget_password']);
Route::get('/passwordresetstatus', [ForgetPasswordController::class, 'passwordresetstatuspage']);

Route::get('/resetpassword/{token}', [ForgetPasswordController::class, 'validateResetPasswordRequest']);
Route::post('/resetpassword', [ForgetPasswordController::class, 'changepassword'])->name('change_password');

Route::middleware('AuthGuard')-> group(  function()  {
    
    Route::get('/projectform' , [FormController::class ,'project_form'])->name('projectform')->middleware('AuthGuard');

    Route::get('/changepassword', function () {
        return view('changepassword');
    });
    
    Route::post('/changepassword', [PasswordChangeController::class ,'change_password']);
    Route::get('/todolist', [TaskManagerController::class, 'get_projects_users']);
    Route::post('/addtask', [TaskManagerController::class, 'add_task']);
    
    Route::get('/taskdisplay', [TaskManagerController::class , 'Displaytasks']);
    
    Route::get('/edit-task' ,[TaskManagerController::class, 'edittaskpage']);
    Route::post('/edit-task', [TaskManagerController::class, 'edittask']);
    
    
    Route::get('/delete-task' ,[TaskManagerController::class, 'deletetask']);
    Route::get('/projectdisplay', [ProjectManagerController::class , 'DisplayProjects']);
    
    Route::get('/users', [ProjectManagerController::class , 'userdashboard']);
    Route::get('/filtering', [ProjectManagerController::class , 'filterpage']);
    
    Route::post('/processfilter', [ProjectManagerController::class , 'process_filter']);
    Route::get('/processfilter', [ProjectManagerController::class , 'process_filter']);
    
    Route::get('/edit-project', [ProjectManagerController::class, 'editprojectpage']);
    Route::post('/edit-project', [ProjectManagerController::class, 'editproject']);

    Route::get('/delete-project' ,[ProjectManagerController::class, 'deleteproject']);

});