<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'account_type',
        'website',
        'logo',
        'account_status',
        'description',
        'email',
        'phone',
    ];

    protected $hidden = [

        'access_key'
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
}
