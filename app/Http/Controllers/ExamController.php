<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Exam::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'SchoolName' => 'required|string',
            'SchoolLogo' => 'required|image|mimes:jpg,png,jpeg,svg|max:200',
            'Exam_Briefing' => 'required|string',
            'Exam_Intructions' => 'required|string',
            'Exam_Questions' => 'required|string',
            'Option_A' => 'required|string',
            'Option_B' => 'required|string',
            'Option_C' => 'required|string',
            'Option_D' => 'required|string',
            'Correct_Option' => 'required|string',
            'Exam_Start' => 'required|string',
            'Exam_Stop' => 'required|string',
            'exam_status' => 'required|string',
        ]);
       $create_exam =  Exam::create($request->all());
        $response = [
            'msg'=>'Exam created',
            'create_exam' => $create_exam,
        ];
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        return Exam::find($id);
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
        $exam = Exam::find($id);
        $exam -> update($request->all());
        return $exam;
    }

      /**
     * Update the specified resource in storage.
     * @param  str  $SchoolName
     * @return \Illuminate\Http\Response
     */
    public function search($SchoolName)
    {return Exam::where('SchoolName', 'like', '%'.$SchoolName.'%')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Exam::destroy($id);
    }
}
