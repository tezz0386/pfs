<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable=['program_name', 'program_code', 'sm_form', 'program_description'];
    public function assistants(){
    	return $this->hasMany('App\Models\Assistant', 'program_id');
    }
}
