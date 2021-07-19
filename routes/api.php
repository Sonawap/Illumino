<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//public router
// register

Route::get('/exams/search/{SchoolName}', [ExamController::class, 'search']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']],  function () {

    Route::post('/exams/create',[ExamController::class, 'store']);

    Route::get('/exams/all', [ExamController::class, 'index']);

    Route::get('/exams/info/{id}', [ExamController::class, 'show']);

    Route::put('/exams/update/{id}', [ExamController::class, 'update']);

    Route::delete('/exams/delete/{id}', [ExamController::class, 'destroy']);
    
    Route::post('/exams/logout',  [AuthController::class, 'logout']);
});





