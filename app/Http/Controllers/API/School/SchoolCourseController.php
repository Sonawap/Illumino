<?php

namespace App\Http\Controllers\API\School;

use App\Models\Exam;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\SubjectStoreRequest;
use App\Models\Course;

class SchoolCourseController extends Controller
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
        $courses = $this->school->courses()->paginate(10);
        return response()->json([
            'status' => 'success',
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        $subjects_id = [$request->first_subject_id,$request->second_subject_id,$request->third_subject_id,$request->fourth_subject_id,];
        $course = new Course();

        $course->name = $request->name;
        $course->code = $request->code;
        $course->school_id = $this->school->id;
        $course->subjects_id = json_encode($subjects_id);

        $course->save();
        return response()->json([
            'status' => 'success',
            'course' => $course
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
        $course = $this->school->courses()->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseStoreRequest $request, $id)
    {
        $course = $this->school->courses()->findOrFail($id);
        $subjects_id = [$request->first_subject_id,$request->second_subject_id,$request->third_subject_id,$request->fourth_subject_id,];
        $course->name = $request->name;
        $course->code = $request->code;
        $course->school_id = $this->school->id;
        $course->subjects_id = json_encode($subjects_id);

        $course->save();
        return response()->json([
            'status' => 'success',
            'course' => $course
        ],200);
    }

      /**
     * Update the specified resource in storage.
     * @param  str  $SchoolName
     * @return \Illuminate\Http\Response
     */
    public function search($courseName)
    {
        $course = $this->school->courses()->where('SchoolName', 'like', '%'.$courseName.'%')->get();
        return response()->json([
            'status' => 'success',
            'course' => $course
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
        $course = $this->school->courses()->findOrFail($id);
        $course->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Course has been deleted'
        ],200);
    }
}
