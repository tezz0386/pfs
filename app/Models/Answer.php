<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable=['question_id', 'uid', 'answer'];
    protected $hidden =['question_id', 'uid'];


    public function question()
    {
    	return $this->belongsTo(Question::class, 'question_id');
    }
}
