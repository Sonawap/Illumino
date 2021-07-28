<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'password',
        'account_type',
        'website',
        'logo',
        'account_status',
        'description',
        'email',
        'phone',
    ];

    protected $hidden = [
        'password',
        'special_key'
    ];
     /*
    *   relationships
    */
    public function Exams()
    {
        return $this->hasMany(Exam::class);
    }
}
