<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Playlist extends Model
{
    use HasFactory;
    protected $table = 'playlists';
    protected $fillable = [
        'judul_playlist',
        'slug',
        'deskripsi',
        'user_id',
        'gambar_playlist',
        'is_active',



    ];


    protected $guard =[];



/**
 * Get the user that owns the Playlist
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function users()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}
