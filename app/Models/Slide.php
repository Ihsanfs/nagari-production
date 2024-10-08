<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';
     protected $fillable = ['judul_slide','link','video_slide','is_active'];
    protected $hidden = [];

}
