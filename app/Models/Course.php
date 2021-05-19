<?php

namespace App\Models;

use App\Models\Crash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['title', 'description', 'admin_id', 'crash_id', 'link'];
    public function crash()
    {
    	return $this->belongsTo(Crash::class, 'crash_id');
    }
}
