<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crash extends Model
{
    use HasFactory;
    protected $fillable=['crash_name', 'crash_image', 'description', 'assign', 'publish'];
    public function courses()
    {
    	return $this->hasMany(Course::class, 'crash_id');
    }
}
