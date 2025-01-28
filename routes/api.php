<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CourseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/courses', [CourseController::class, 'index']); // Retrieve all courses
Route::get('/courses/{id}', [CourseController::class, 'show']); // Retrieve a specific course by ID
Route::post('/courses', [CourseController::class, 'store']); // Add a new course
Route::put('/courses/{id}', [CourseController::class, 'update']); // Update a course
Route::delete('/courses/{id}', [CourseController::class, 'destroy']); // Delete a course
