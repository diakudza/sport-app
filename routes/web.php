<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SportsmanController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TrainingController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login.page');
Route::post('/login', [AuthController::class, 'auth'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.action');

Route::get('/add-training', [SportsmanController::class, 'index'])->name('sportsmen.training.page');
Route::post('/add-training', [SportsmanController::class, 'add'])->name('sportsmen.training.add');
Route::get('/trainings', [SportsmanController::class, 'trainings'])->name('sportsmen.trainings');
Route::get('/trainings/{id}', [TrainingController::class, 'detail'])->name('training.detail');

Route::get('/events', [EventController::class, 'index'])->name('event.page');
Route::get('/events/{id}', [EventController::class, 'detail'])->name('event.detail');


