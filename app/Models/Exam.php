<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'total_subjects',
        'questions_per_subject',
        'exam_intructions',
        'exam_date',
        'student_delay_time',
        'randomize_questions',
        'randomize_answers',
        'exam_end_intructions',
        'year',
        'school_id',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];
}
