<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $fillable=['year_name'];
    public function subjectAssistants()
    {
    	return $this->belongsTo('App\Models\SubjectAssistant', 'id');
    }
}
