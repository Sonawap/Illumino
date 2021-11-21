<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamQuestionRequest;

class QuestionController extends Controller
{
    public function examQuestions(ExamQuestionRequest $request){
        $question = Question::where();
    }
}
