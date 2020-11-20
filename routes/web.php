<?php

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
return view('home');
})->middleware('auth');

Route::group(['prefix' =>'admin', 'as' => 'admin'], function(){

  Route::get('/get_employees', 'EmployeesController@get_employees');
  Route::get('/get_employee', 'EmployeesController@get_employee');
  Route::get('/code_validation', 'EmployeesController@code_validation');
  Route::get('/code_validation_create', 'EmployeesController@code_validation_create');
  Route::post('/create_employee', 'EmployeesController@create_employee');
  Route::put('/update_employee', 'EmployeesController@update_employee');
  Route::put('/deactivate_employee', 'EmployeesController@deactivate_employee');
  Route::put('/delete_employee', 'EmployeesController@delete_employee');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
