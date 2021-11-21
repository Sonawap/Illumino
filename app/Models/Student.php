<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Student as Authenticatable;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable=[
        'first_name',
        'middle_name',
        'last_name',
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
