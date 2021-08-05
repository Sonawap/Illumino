<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'user_id',
        'reference',
        'payment_id',
        'student_id',
        'school_id',
        'amount',
        'status',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
