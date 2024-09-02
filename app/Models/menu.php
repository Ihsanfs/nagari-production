<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $guarded = [];


    public function author_menu()
    {
     return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function menu_nama()
    {
     return $this->hasMany(halaman::class, 'menu_id', 'id');

    }
}
