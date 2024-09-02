<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class kategori_tag extends Model
{
    use HasFactory;

    protected $table = 'kategori_tag';
    protected $guarded = [];

    /**
     * Get the artikel that owns the kategori_tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artikel(): BelongsTo
    {
        return $this->belongsTo(artikel::class, 'id', 'artikel_id');
    }
}
