<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'user_id',
        'student_id',
        'total_score',
        'subject1_score',
        'subject2_score',
        'subject3_score',
        'subject4_score',
    ];
}
