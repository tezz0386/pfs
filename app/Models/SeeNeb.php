<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeeNeb extends Model
{
    use HasFactory;
    protected $fillable=['mode', 'year', 'is_regular', 'seeneb_id', 'edition', 'publication', 'file_name', 'medium'];
}
