<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssistant extends Model
{
    use HasFactory;
    protected $fillable=['assistant_id', 'subject_id', 'year_id', 'subject_code', 'assign'];
    public function assistants()
    {
    	return $this->belongsTo('App\Models\Assistant', 'assistant_id');
    }
    public function bcms()
    {
        return $this->hasMany('App\Models\BCMS', 'subject_assistant_id');
    }
    public function years()
    {
        return $this->hasMany('App\Models\Year', 'id');
    }
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'id');
    }
}
