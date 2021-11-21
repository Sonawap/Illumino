<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ExamStoreRequest extends FormRequest
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
            'course_id' => 'required|integer',
            'exam_intructions' => 'required|string',
            'exam_end_intructions' => 'required|string',
            'total_subjects' => 'required|integer',
            'questions_per_subject' => 'required|integer',
            'exam_date' => 'required|date_format:d-m-Y',
            'student_delay_time' => 'required|integer',
            'randomize_questions' => 'required|boolean',
            'randomize_answers' => 'required|boolean',
        ];
    }
}
