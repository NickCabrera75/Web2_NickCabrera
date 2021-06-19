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
Route::get('/professors', 'App\Http\Controllers\ProfessorController@getProfessors');
Route::get('/professoradd', 'App\Http\Controllers\ProfessorController@showProfessorAdd');
Route::post('/professors', 'App\Http\Controllers\ProfessorController@postProfessor');
Route::get('/professors/{id}', 'App\Http\Controllers\ProfessorController@getProfessor');
Route::put('/professors', 'App\Http\Controllers\ProfessorController@putProfessor');
Route::delete('/professors/{id}','App\Http\Controllers\ProfessorController@deleteProfessor');

//Ajax
Route::get('/ajaxprofessors', 'App\Http\Controllers\AjaxProfessorController@getProfessors');
Route::post('/ajaxprofessors', 'App\Http\Controllers\AjaxProfessorController@postProfessor');
Route::put('/ajaxprofessors', 'App\Http\Controllers\AjaxProfessorController@putProfessor');
Route::delete('/ajaxprofessors/{id}', 'App\Http\Controllers\AjaxProfessorController@deleteProfessor');

Route::get('/', function () {
    return view('welcome');
});
