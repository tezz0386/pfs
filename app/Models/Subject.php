<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable=['subject_name', 'subject_description'];
    public function subjectAssistants()
    {
    	return $this->belongsTo('App\Models\SubjectAssistant', 'subject_id');
    }
}
