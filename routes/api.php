<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    AuthController,
    ExamController,
    SchoolController,
    QuestionController,
    StudentController
};
use App\Http\Controllers\API\School\{
    SchoolSubjectController,
    SchoolExamController,
    SchoolCourseController,
    SchoolQuestionController,
    SchoolStudentController
};

Route::group(['prefix' => 'auth'], function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::group(['prefix' => 'school'], function() {
        Route::post('/login', [SchoolController::class, 'login']);
        Route::post('/logout', [SchoolController::class, 'logout']);
    });

    Route::group(['prefix' => 'student'], function() {
        Route::post('login', [StudentController::class, 'login']);
        Route::post('/logout', [StudentController::class, 'logout']);
    });

});

Route::group(['middleware' => 'auth:sanctum'], function() {

    Route::apiResources([
        'exams' => ExamController::class,
        'schools' => SchoolController::class,
    ]);


    Route::group(['prefix' => 'student'], function() {
        Route::get('exam/questions/', [StudentController::class, 'examQuestions']);
    });

});

Route::group(['middleware' => 'school', 'prefix' => 'client'], function() {

    Route::apiResources([
        'exams' => SchoolExamController::class,
        'subjects' => SchoolSubjectController::class,
        'courses' => SchoolCourseController::class,
        'questions' => SchoolQuestionController::class,
        'students' => SchoolStudentController::class,
    ]);

});




