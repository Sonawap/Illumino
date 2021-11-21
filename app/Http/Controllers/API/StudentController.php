<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamQuestionRequest;
use App\Http\Requests\StudentLoginUserRequest;
use App\Models\School;

class StudentController extends Controller
{
    public function login(StudentLoginUserRequest $request){
        $student = Student::where('first_name', $request->first_name)->where('utme_reg_no', $request->utme_reg_no)->first();
        if(auth('student')->loginUsingId($student->id)){
            $student = auth('student')->user();
            $token =  $student->createToken($student->email .' Personal Access Token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'token' => $token,
                'student' => $student,
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorised'
            ], 401);
        }
    }

    public function logout() {
        auth('student')->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged Out'
        ], 200);
    }

    public function examQuestions(ExamQuestionRequest $request){
        $school = School::where('id', $request->user()->school_id)->first();
        $question = Question::where('subject_id', $request->subject_id)->where('exam_id', $request->exam_id)->where('school_id', $school->id)->paginate(1);
        return response()->json([
            'status' => 'success',
            'question' => $question
        ], 200);
    }
}
