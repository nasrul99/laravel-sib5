<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'asset';
    protected $fillable = ['nama','kategori_id','thn_beli','harga',
                           'masa_umur','kondisi','lokasi','foto','barcode'];
    
    public $timestamps = false;

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function mutasi(): HasMany
    {
        return $this->hasMany(Mutasi::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
