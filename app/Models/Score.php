<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable=[
        'SchoolName',
        'name',
        'utme_reg_no',
        'course',
        'score',
        'user_image',
    ];
}
