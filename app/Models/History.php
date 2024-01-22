<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = ['tgl','asset_id','nama_kegiatan','foto'];

    public $timestamps = false;

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
