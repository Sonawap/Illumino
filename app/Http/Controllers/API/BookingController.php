<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function booking(BookingRequest $request)
    {

        $driver = [
            'driver_name' => "Paul Sola Moses",
            'cab_type' => "Toyota",
            'driver_image' => "https://via.placeholder.com/150"
        ];
        
        return response()->json([
            'status' => true,
            'data' => $driver
        ],200);
    }

}
