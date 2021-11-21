<?php

namespace App\Http\Controllers\API\School;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;

class SchoolExamController extends Controller
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
        $exams = $this->school->exams()->paginate(10);
        return response()->json([
            'status' => 'success',
            'exams' => $exams
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamStoreRequest $request)
    {
        $exam =  new Exam();
        $exam->course_id = $request->course_id;
        $exam->exam_intructions = $request->exam_intructions;
        $exam->exam_end_intructions = $request->exam_end_intructions;
        $exam->total_subjects = $request->total_subjects;
        $exam->questions_per_subject = $request->questions_per_subject;
        $exam->exam_date = Carbon::createFromFormat('d-m-Y', $request->exam_date);
        $exam->student_delay_time = $request->student_delay_time;
        $exam->randomize_questions = $request->randomize_questions;
        $exam->randomize_answers = $request->randomize_answers;
        $exam->school_id = $this->school->id;
        $exam->save();
        return response()->json([
            'status' => 'success',
            'exam' => $exam
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

        $exam = $this->school->exams()->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'exam' => $exam
        ],200);
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
        if($request->has('exam_date')){
            $request->merge(['exame_date', Carbon::createFromFormat('d-m-Y', $request->exam_date)]);
        }
        $exam = $this->school->exams()->findOrFail($id);
        $exam->update($request->all());
        return response()->json([
            'status' => 'success',
            'exam' => $exam
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
        $exam = $this->school->exams()->findOrFail($id);
        $exam->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Exam has been deleted'
        ],200);
    }
}
