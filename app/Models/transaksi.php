<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $guarded = [];

    /**
     * Get the dana associated with the transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dana(): HasOne
    {
        return $this->hasOne(sumberdana::class, 'id', 'id_dana');
    }
}
