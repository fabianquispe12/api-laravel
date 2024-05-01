<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\studentController;



Route::get('/students', [studentController::class, 'index']);

Route::get('/students/{id}', [studentController::class, 'show']);

Route::post('/students', [studentController::class, 'store']);

Route::put('/students/{id}', [studentController::class, 'update']);

Route::delete('/students/{id}', [studentController::class, 'destroy']);

Route::patch('/students/{id}', [studentController::class, 'updatepartial']);
