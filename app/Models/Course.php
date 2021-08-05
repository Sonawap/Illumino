<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'code',
        'subject_id',
        'school_id',
    ];

    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
