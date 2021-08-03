<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //function to get all subjects
    public function index(){
        return Subject::all();
    }

    //function to create new subject
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'school_id' => 'required'
            

        ]);
        $create_subject =  Subject::create($request->all());
        $response = [
            'message'=>'Subject created Successfully!',
            'create_subject' => $create_subject,
        ];
        return response($response, 200);
        
    }

    //function to display specific subject
    public function show($id){
        return Subject::find($id);
    }

  //function to update a specific subject
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        $subject -> update($request->all());
        return $subject;
    }

     //function to search for a subject
    public function search($name) {
        return Subject::where('name', 'like', '%'.$name.'%')->get();
    }

  //function to delete a subject
    public function destroy($id)
    {
        return Subject::destroy($id);
    }
}
