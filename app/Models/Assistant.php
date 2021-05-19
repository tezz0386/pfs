<?php

namespace App\Models;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;
    protected $fillable=['university_id', 'program_id', 'level_id', 'faculty_id', 'ways'];

    public function programs(){
        return $this->belongsTo('App\Models\Program');
    }
    public function subjectAssistants()
    {
        return $this->hasMany('App\Models\SubjectAssistant', 'assistant_id');
    }
 
}
