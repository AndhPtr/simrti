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

    public function asetKritis()
    {
        return $this->hasMany(AsetKritis::class);
    }
}
