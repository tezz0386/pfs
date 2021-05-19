<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable=['faculty_code', 'faculty_name', 'faculty_description'];
    protected $hidden=['faculty_code'];
	public function assistants(){
    	return $this->belongsTo('App\Models\Assistant', 'faculty_id');
    }
}
