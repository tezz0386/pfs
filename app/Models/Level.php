<?php

namespace App\Models;

use App\Models\Assistant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable=['level_name', 'level_code'];
}
