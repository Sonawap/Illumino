<?php

namespace App\Http\Controllers\API\School;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Question;

class SchoolQuestionController extends Controller
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
        $questions = $this->school->questions()->paginate(10);
        return response()->json([
            'status' => 'success',
            'questions' => $questions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        $question = new Question();
        $question->exam_id = $request->exam_id;
        $question->subject_id = $request->subject_id;
        $question->school_id = $this->school->id;
        $question->question = $request->question;
        $question->optionA = $request->optionA;
        $question->optionB = $request->optionB;
        $question->optionC = $request->optionC;
        $question->optionD = $request->optionD;
        $question->correct_option = $request->correct_option;
        $question->save();
        return response()->json([
            'status' => 'success',
            'question' => $question
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
        $question = $this->school->questions()->findOrFail($id);
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
        $question = $this->school->questions()->findOrFail($id);
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
        $question = $this->school->questions()->findOrFail($id);
        $question->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'question has been deleted'
        ],200);
    }
}
