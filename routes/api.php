<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\SyllabusController;

Route::apiResource('students', StudentController::class);
Route::apiResource('grades', GradeController::class);
Route::apiResource('lectures', LectureController::class);

Route::post('/grades/{grade}/syllabus', [SyllabusController::class, 'store']);
Route::put('/grades/{grade}/syllabus', [SyllabusController::class, 'update']);
