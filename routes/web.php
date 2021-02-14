<?php

use Illuminate\Support\Facades\Route;

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

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'admin'])
->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('pengajar', 'pengajarController');
    Route::resource('kategori', 'kategoriController');
    Route::resource('course', 'CourseController');
    // Route::post('/kategori', 'kategoriController@store')->name('kategori');
    Route::post('/lesson/create', 'Admin\LessonController@store')->name('create-lesson');
});

Route::get('/keluar', '\App\Http\Controllers\Auth\LoginController@logout')->name('keluar');
Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');
