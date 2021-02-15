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
    Route::post('chapter/create/{id}', 'chapterController@create')->name('chapter-create');
    // lesson
    Route::post('/lesson/create/{id}', 'LessonController@store')->name('create-lesson');
    Route::get('/chapter/{course_id}/lesson/edit/{id}', 'LessonController@edit')->name('lesson-edit');
    Route::put('/chapter/{course_id}/lesson/update/{id}', 'lessonController@update')->name('lesson-update');
    Route::get('/chapter/{course_id}/lesson/delete/{id}', 'lessonController@destroy')->name('lesson-delete');
});

Route::get('/keluar', '\App\Http\Controllers\Auth\LoginController@logout')->name('keluar');
Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');
