<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable=[
    		'university_name',
    		'sm_form',
    		'university_code',
    ];
    protected $hidden=['university_code'];
}
