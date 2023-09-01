<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\admin\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view('/','AdminLTE.index');
//Route::get('/{id}','AdminController@index');
Route::resource('min', 'admin\AdminController');
Route::post('/login','admin\loginController@index')->name('login')->middleware('guest');
Route::get('/user/logout', 'AdminController@logout')->name('user.logout');
Route::get('/login', 'admin\AdminController@index')->middleware('guest');
Route::view('clinic','clinic/majors');

// Route::view('up/{id}','AdminLTE/recover-password');
// Route::get('del/{id}','AdminController@destroy');

// Route::view('/{user}','AdminLTE/index')->middleware('auth');
// Route::post('/store/user','AdminController@store')->name('store');

// Route::post('/user', 'AdminController@login')->name('user.show');
// Route::view('user/login', 'AdminLTE/login')->name('user.login')->middleware('guest');
// Route::put('user/{user}', 'AdminController@update')->name('users.update');

