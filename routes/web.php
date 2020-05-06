<?php
// Cross Origin

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

Route::get('/', function () {
    return view('welcome');
});
// Login
Route::post('login', 'UsersController@authenticate');
Route::post('authenticate', 'UsersController@authenticate');
// Register
Route::post('register', 'UsersController@register');

Route::get('posts', 'PostController@index');
Route::get('posts/index', 'PostController@index');
Route::post('posts/add', 'PostController@add');

// Employee crud
Route::get('employees', 'EmployeesController@index');
Route::post('employees', 'EmployeesController@store');
Route::get('employees/{id}', 'EmployeesController@show');
Route::put('employees/{id}', 'EmployeesController@update');
Route::delete('employees/{id}', 'EmployeesController@destroy');

//Fileuplaod
Route::get('fileupload', 'EmployeesController@filelist');
Route::post('fileupload', 'EmployeesController@fileupload');
Route::delete('filedelete/{id}', 'EmployeesController@filedelete');

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
