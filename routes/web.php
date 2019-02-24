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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/companies', 'CompanyController@index');
Route::get('/admin/companies/create', 'CompanyController@create');
Route::post('/admin/companies', 'CompanyController@store');
Route::get('/admin/companies/{id}', 'CompanyController@show');
Route::get('admin/companies/{id}/update', 'CompanyController@edit');
Route::post('/admin/companies/{id}/update', 'CompanyController@update');
Route::get('/admin/companies/{id}/delete', 'CompanyController@destroy');

Route::get('/admin/employees/create', 'EmployeeController@create');
Route::post('/admin/employees', 'EmployeeController@store');
Route::get('/admin/employees', 'EmployeeController@index');
Route::get('/admin/employees/{id}', 'EmployeeController@show');
Route::get('/admin/employees/{id}/update', 'EmployeeController@edit');
Route::post('/admin/employees/{id}/update', 'EmployeeController@update');
Route::get('/admin/employees/{id}/delete', 'EmployeeController@destroy');