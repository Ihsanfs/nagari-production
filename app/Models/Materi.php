<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Playlist;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materis';
    protected $fillable = [
        'judul_materi',
    'slug',
    'link',
    'playlist_id',
    'deskripsi',
    'gambar_materi',
    'is_active',

];

protected $hidden =[];


protected $guard =[];

public function playlist()
{
    return $this->belongsTo(playlist::class, 'playlist_id', 'id');
}
}
