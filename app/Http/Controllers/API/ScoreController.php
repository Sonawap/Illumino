<?php

namespace App\Http\Controllers\API;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreController extends Controller

{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'school_id'=> 'required',
            'subject_id'=> 'required',
            'student_id'=> 'required',
            'score'=> 'required',
            'date'=> 'required'
        ]);

        $score = new Score;
        $score->name = $request->name;
        $score->save();

    }

}
