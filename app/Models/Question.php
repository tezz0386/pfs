<?php

namespace App\Models;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=['question_category', 'question', 'uid', 'title'];
    protected $hidden = ['uid'];
    public function answers()
    {
    	return $this->hasMany(Answer::class, 'question_id');
    }
}
