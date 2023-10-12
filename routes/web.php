<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('save_student', [StudentController::class, 'save_student']);

Route::get('all_students', [StudentController::class, 'all_students']);
Route::get('edit_student/{id}', [StudentController::class, 'edit_student']);
Route::put('update_student', [StudentController::class, 'update_student']);
Route::delete('delete_student/{id}', [StudentController::class, 'delete_student']);
