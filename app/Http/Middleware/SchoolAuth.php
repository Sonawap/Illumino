<?php

namespace App\Http\Middleware;

use App\Models\School;
use Closure;
use Illuminate\Http\Request;

class SchoolAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->bearerToken();
        $school = School::where('access_key', '=', $key)->first();
        if(!$school){
            return response()->json([
                'status' => false,
                'data'=> [
                    'message' => 'App Key is invailed'
                ]
            ]);
        }else{
            return $next($request);
        }
    }
}

