<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable=[
        'SchoolName',
        'Exam_Briefing',
        'Exam_Intructions',
        'Exam_Questions',
        'Option_A',
        'Option_B',
        'Option_C',
        'Option_D',
        'Correct_Option',
        'Exam_Start',
        'Exam_Stop',
        'exam_status',
    ];
}
