<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'name',
        'email',
        'utme_reg_no',
        'password',
        'photo',
        'uuid',
        'payment_status',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function course(){
        return $this->hasMany(Course::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function score(){
        return $this->hasMany(Score::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
