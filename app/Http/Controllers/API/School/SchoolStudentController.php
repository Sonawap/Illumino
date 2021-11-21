<?php

namespace App\Http\Controllers\API\School;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Models\Question;
use App\Models\Student;

class SchoolStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $key = $request->bearerToken();
        $this->school = School::where('access_key', '=', $key)->first();
    }

    public function index()
    {
        $students = $this->school->students()->paginate(10);
        return response()->json([
            'status' => 'success',
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        $checkMail = Student::where('school_id', $this->school->id)->where('email', $request->email)->exists();
        if($checkMail){
            return response()->json([
                'status' => 'error',
                'message' => 'Email has been registered before'
            ],422);
        }
        $student = new Student();
        $student->course_id = $request->course_id;
        $student->school_id = $this->school->id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->middle_name = $request->middle_name;
        $student->utme_reg_no = $request->utme_reg_no;
        $student->email = $request->email;
        $student->uuid = uniqid();
        $student->save();
        return response()->json([
            'status' => 'success',
            'student' => $student
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->school->students()->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = $this->school->students()->findOrFail($id);
        $question->update($request->all());
        return response()->json([
            'status' => 'success',
            'question' => $question
        ],200);
    }

      /**
     * Update the specified resource in storage.
     * @param  str  $SchoolName
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->school->students()->findOrFail($id);
        $question->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'question has been deleted'
        ],200);
    }
}
