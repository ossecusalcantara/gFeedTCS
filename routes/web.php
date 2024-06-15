<?php

use App\Http\Controllers\AnswersEvaluationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\PerformanceEvaluationsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SkillsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', [Controller::class, 'fazerLogin']);
Route::get('/login', [Controller::class, 'fazerLogin']);
Route::post('/login', [DashboardController::class, 'auth'])->name('user.login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
Route::get('api/dashboard', [DashboardController::class, 'getDadosDashboard'])->name('user.getDadosDashboard');
Route::get('api/dashboard/{id}', [DashboardController::class, 'getDadosDashboardUserShow'])->name('user.getDadosDashboardUserShow');

/*
|--------------------------------------------------------------------------
| Routes PerformanceEvaluations
|--------------------------------------------------------------------------
|
*/
Route::get('/performanceEvaluations/listagem', [PerformanceEvaluationsController::class, 'listagem'])->name('performanceEvaluations.listagem');
Route::get('/performanceEvaluations/manager/listagem', [PerformanceEvaluationsController::class, 'listagem'])->name('performanceEvaluations.managerlist');
Route::get('/performanceEvaluations/manager/responder/{id}', [PerformanceEvaluationsController::class, 'accomplish'])->name('performanceEvaluations.accomplish');
Route::resource('performanceEvaluations', PerformanceEvaluationsController::class);

/*
|--------------------------------------------------------------------------
| Routes User
|--------------------------------------------------------------------------
|
*/
Route::get('/listagem', [UsersController::class, 'listagem'])->name('user.listagem');
Route::get('/user/user-profile/{id}', [UsersController::class, 'userProfile'])->name('user.user-profile');
Route::put('/user/profileUpdate/{id}', [UsersController::class, 'profileUpdate'])->name('user.profileUpdate');
Route::resource('user', UsersController::class);

/*
|--------------------------------------------------------------------------
| Routes Office, Departament and Skilss
|--------------------------------------------------------------------------
|
*/
Route::get('/office/listagem', [OfficesController::class, 'listagem'])->name('office.listagem');
Route::resource('office', OfficesController::class);

Route::get('/departament/listagem', [DepartamentsController::class, 'listagem'])->name('departament.listagem');
Route::resource('departament', DepartamentsController::class);

Route::get('/skill/listagem', [SkillsController::class, 'listagem'])->name('skill.listagem');
Route::resource('skill', SkillsController::class);

Route::get('/questions/listagem', [QuestionsController::class, 'listagem'])->name('questions.listagem');
Route::resource('questions', QuestionsController::class);

Route::resource('answersEvaluation', AnswersEvaluationsController::class);
Route::resource('feedback', FeedbackController::class);
