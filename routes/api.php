<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// user
Route::get('user', 'api\userController@index');
Route::post('register', 'api\userController@register');
Route::post('login', 'api\userController@login');

// Mentor Route
Route::get('/mentor', 'mentorController@index');
Route::post('/mentor/create', 'mentorController@creat');
Route::put('/mentor/update/{id}', 'mentorController@update');
Route::get('mentor/{id}', 'mentorController@show');
Route::delete('mentor/{id}', 'mentorController@destroy');

// course
Route::get('/course', 'api\courseController@index');
Route::post('/course/create', 'api\courseController@create');
Route::put('course/update/{id}', 'api\courseController@update');
Route::get('course/{id}', 'api\courseController@show');
Route::delete('course/{id}', 'api\courseController@destroy');

// chapter
Route::get('chapter', 'api\chapterController@index');
Route::get('chapter/{id}', 'api\chapterController@show');
Route::post('chapter/create', 'api\chapterController@create');
Route::put('chapter/update/{id}', 'api\chapterController@update');
Route::delete('chapter/{id}', 'api\chapterController@delete');

// lessons
Route::get('lesson', 'api\lessonController@index');
Route::get('lesson/{id}', 'api\lessonController@show');
Route::post('lesson/create', 'api\lessonController@create');
Route::put('lesson/update/{id}', 'api\lessonController@update');
Route::delete('lesson/{id}', 'api\lessonController@destroy');

// image course
Route::get('image-course', 'api\imageCourse\imageCourseController@index');
Route::get('image-course/{id}', 'api\imageCourse\imageCourseController@show');
Route::post('image-course/create', 'api\imageCourse\imageCourseController@create');
Route::delete('image-course/{id}', 'api\imageCourse\imageCourseController@destroy');

// my course
Route::get('my-course', 'api\myCourseController@index');
Route::post('my-course/create', 'api\myCourseController@create');

// review
Route::post('review/create', 'api\reviewController@create');