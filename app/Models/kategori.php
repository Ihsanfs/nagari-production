<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\artikel;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $guarded =[];
    protected $fillable = [

        'nama_kategori',
        'slug'


    ];



    public function artikel()
    {
        return $this->hasMany(artikel::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }


}
