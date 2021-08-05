<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'name',
        'date_of_birth',
        'gender',
        'department',
        'phone',
        'photo',
        'status',
        'email',
        'school_id',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }
}
