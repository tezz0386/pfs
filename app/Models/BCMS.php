<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BCMS extends Model
{
    use HasFactory;
     protected $fillable=['mode', 'year', 'subject_assistant_id', 'edition', 'publication', 'file_name', 'medium'];
     public function subjectAssistants()
     {
     	return $this->belongsTo('App\Models\SubjectAssistant', 'subject_assistant_id');
     }
}
