<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
class artikel extends Model
{
    use HasFactory;
    protected $table = 'artikels';
//     protected $fillable = [
//      'judul',
//      'slug',
//      'kategori_id',
//      'user_id',
//      'gambar_artikel',
//      'body',
//      'is_active',
//      'views'


//  ];

 protected $guarded = [];



//  public function kategori()
//  {
//      return $this->belongsTo(Kategori_tag::class, 'kategori_id');
//  }

public function users()
{
    return $this->belongsTo(User::class, 'user_id', 'id')->limit('1');
}


public function getRouteKeyName()
{
    return 'slug';
}
}




