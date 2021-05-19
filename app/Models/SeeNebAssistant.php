<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeeNebAssistant extends Model
{
    use HasFactory;
    protected $fillable=['subject_id', 'level_id', 'subject_code', 'class'];
}
