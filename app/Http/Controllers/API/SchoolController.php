<?php

namespace App\Http\Controllers\API;

use App\Models\school;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\SchoolStoreRequest;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::latest()->paginate(10);
        return response()->json([
            'status' => 'success',
            'schools' => $schools
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolStoreRequest $request)
    {
        $school =  new School();
        $school->name = $request->name;
        $school->account_type = $request->account_type;
        $school->website = $request->website;
        $school->access_key = uniqid();
        $school->description = $request->description;
        $school->email = $request->email;
        $school->phone = $request->phone;
        $school->password = bcrypt($request->password);
        $school->school_id = uniqid();

        $school->save();
        return response()->json([
            'status' => 'success',
            'school' => $school
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
        $school = School::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'school' => $school
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
        $school = School::findOrFail($id);
        $school-> update($request->all());
        return response()->json([
            'status' => 'success',
            'school' => $school
        ],200);
    }

      /**
     * Update the specified resource in storage.
     * @param  str  $schoolName
     * @return \Illuminate\Http\Response
     */
    public function search($schoolName)
    {
        $school = School::where('schoolName', 'like', '%'.$schoolName.'%')->get();
        return response()->json([
            'status' => 'success',
            'school' => $school
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
        $school = School::findOrFail($id);
        $school->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'school has been deleted'
        ],200);
    }

    public function login(LoginUserRequest $request){
        if(auth('school')->attempt(['email' => $request->email, 'password' => $request->password])){
            $school = auth('school')->user();
            $token =  $school->createToken($school->email .' Personal Access Token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'token' => $token,
                'school' => $school,
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorised'
            ], 401);
        }
    }

    public function logout() {
        auth('school')->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged Out'
        ], 200);
    }
}
