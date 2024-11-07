<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelemahanAsets extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'aset_id',
        'kelemahan',
        'kebutuhan_keamanan',
        'praktik_keamanan',
    ];

    public function asetKritis()
    {
        return $this->belongsTo(AsetKritis::class, 'aset_id');
    }

    public function risk()
    {
        return $this->hasMany(Risk::class);
    }
}
