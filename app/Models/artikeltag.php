<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikeltag extends Model
{
    use HasFactory;
    protected $table = 'artikels_tag';
    protected $guarded = [];

    public function tag_artikel()
    {
        return $this->belongsToMany(tag::class);
    }
}
