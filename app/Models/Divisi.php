<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = ['nama'];

    public $timestamps = false;

    public function mutasi(): HasMany
    {
        return $this->hasMany(Mutasi::class);
    }
}
