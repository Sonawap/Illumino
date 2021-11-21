<?php

namespace App\Http\Controllers\API;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
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
        $exam =  Exam::create($request->validated());
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

        $exam = Exam::findOrFail($id);
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
        $exam = Exam::findOrFail($id);
        $exam-> update($request->all());
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
    public function search($SchoolName)
    {
        $exam = Exam::where('SchoolName', 'like', '%'.$SchoolName.'%')->get();
        return response()->json([
            'status' => 'success',
            'exam' => $exam
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Exam has been deleted'
        ],200);
    }
}
