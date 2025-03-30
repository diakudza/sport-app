<?php

use App\Http\Controllers\Api\TrainingTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SportsmanController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;


Route::get('/trainingTypes', [TrainingTypeController::class, 'forEvent'])->name('trainingTypes.event');


