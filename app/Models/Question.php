<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'question',
        'option_A',
        'option_B',
        'option_C',
        'option_D',
        'correct_option',
        'subject_id',
        'student_id',
        'year',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function student_id(){
        return $this->belongsTo(Student::class);
    }
}
