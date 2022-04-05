
## The request route can be found in Routes/api folder
## The booking controller can be found in app/http/controllers/api/BookingController.php
## The Validation can be found in app/Http/Request/BookingRequest.php


# Booking Route
```
Route::post('booking', [BookingController::class, 'booking']);

// accepts only post request
```


# Validation
```
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()->getMessages(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rider_name' => 'required|string',
            'rider_destination' => 'required|string',
            'rider_location' => 'required|string'
        ];
    }
    
    public function message()
    {
        return [
            'rider_name.required' => 'Rider Name is required',
            'rider_destination.required' => 'Rider Destination is required',
            'rider_location.required' => 'Rider Location is required',
        ];
    }
}

```

# Booking Controller
```
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
?>

```
