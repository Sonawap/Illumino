<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Question;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\School as Authenticatable;


class School extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable=[
        'name',
        'account_type',
        'website',
        'access_key',
        'logo',
        'account_status',
        'description',
        'email',
        'phone',
        'password',

    ];

     /*
    *   relationships
    */
    public function exams(){
        return $this->hasMany(Exam::class);
    }

    public function admins(){
        return $this->hasMany(Admin::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    // public function setPasswordAttribute($value){
    //     $this->attributes['password'] = bcrypt($value);
    // }
}
