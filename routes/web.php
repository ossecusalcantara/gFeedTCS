<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentsController;
use App\Http\Controllers\OfficesController;

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

Route::get('/login', [Controller::class, 'fazerLogin']);
Route::post('/login', [DashboardController::class, 'auth'])->name('user.login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

Route::get('/listagem', [UsersController::class, 'listagem'])->name('user.listagem');
Route::get('/office/listagem', [OfficesController::class, 'listagem'])->name('office.listagem');
Route::get('/departament/listagem', [DepartamentsController::class, 'listagem'])->name('departament.listagem');

Route::resource('user', UsersController::class);
Route::resource('office', OfficesController::class);
Route::resource('departament', DepartamentsController::class);

//Route::get('/user', [UsersController::class, 'cadastro'])->name('user.store');
//Route::get('/user', [UsersController::class, 'index'])->name('user.index');
//Route::resource('user', UsersController::class);