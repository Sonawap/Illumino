<?php

namespace App\Http\Controllers\API\School;

use App\Models\Exam;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectStoreRequest;
use App\Models\Subject;

class SchoolSubjectController extends Controller
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
        $subjects = $this->school->subjects()->paginate(10);
        return response()->json([
            'status' => 'success',
            'subjects' => $subjects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request)
    {
        $subject =  new Subject();
        $subject->school_id = $this->school->id;
        $subject->course_id = $request->course_id;
        $subject->name = $request->name;
        $subject->code = $request->code;

        $subject->save();
        return response()->json([
            'status' => 'success',
            'subject' => $subject
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

        $subject = $this->school->subjects()->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'subject' => $subject
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
        $subject = $this->school->subjects()->findOrFail($id);
        $subject-> update($request->all());
        return response()->json([
            'status' => 'success',
            'subject' => $subject
        ],200);
    }

      /**
     * Update the specified resource in storage.
     * @param  str  $SchoolName
     * @return \Illuminate\Http\Response
     */
    public function search($subjectName)
    {
        $subject = $this->school->subjects()->where('SchoolName', 'like', '%'.$subjectName.'%')->get();
        return response()->json([
            'status' => 'success',
            'subject' => $subject
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
        $subject = $this->school->subjects()->findOrFail($id);
        $subject->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Subject has been deleted'
        ],200);
    }
}
