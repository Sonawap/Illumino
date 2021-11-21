<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'name',
        'description',
        'school_id',

    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

}
