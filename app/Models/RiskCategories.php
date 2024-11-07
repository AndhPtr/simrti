<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_risiko',
        'keterangan',
    ];

    public function risk()
    {
        return $this->hasMany(Risk::class);
    }

    public function asetKritis()
    {
        return $this->hasMany(AsetKritis::class);
    }
}
