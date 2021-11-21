<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'question',
        'optionA',
        'optionB',
        'optionC',
        'optionD',
        'correct_option',
        'subject_id',
        'school_id',
    ];

    protected $hidden = [
        'correct_option'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }


    public function school(){
        return $this->belongsTo(School::class);
    }
    public function student_id(){
        return $this->belongsTo(Student::class);
    }
}
