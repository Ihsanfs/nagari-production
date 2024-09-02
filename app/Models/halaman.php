<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class halaman extends Model
{
    use HasFactory;

    protected $table = 'halaman';
    // protected $fillable = ['nama', 'slug', 'user_id', 'deskripsi', 'gambar_h','view'];
    protected $guarded = [];

    public function author_halaman()
    {
     return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function menu_nama()
    {
     return $this->belongsTo(menu::class, 'menu_id', 'id');

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the user associated with the halaman
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_halaman(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
