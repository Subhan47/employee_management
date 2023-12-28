<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('/', [EmployeeController::class, 'index'])->name('index');
Route::get('/create-employee', [EmployeeController::class, 'create'])->name('create-employee');
Route::post('/store-employee', [EmployeeController::class, 'store'])->name('store-employee');
Route::get('/show-employee/{id}', [EmployeeController::class, 'show'])->name('show-employee');
Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit'])->name('edit-employee');
Route::post('/update-employee/{id}', [EmployeeController::class, 'update'])->name('update-employee');
Route::post('/destroy-employee/{id}', [EmployeeController::class, 'destroy'])->name('destroy-employee');
Route::get('/search', [EmployeeController::class, 'search'])->name('search');
