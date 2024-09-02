<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class sosmedinstansi extends Model
{
    use HasFactory;

    protected $table = 'medsos_instansi';
    protected $guarded = [];

    public function sosmed(): BelongsTo
    {
        return $this->belongsTo(Sosialmedia::class, 'sosial_media_id', 'id');
    }
}
