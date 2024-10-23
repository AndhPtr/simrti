<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'aset_kritis',
        'risiko',
        'penyebab',
        'dampak',
        'severity',
        'occurence',
        'detection',
        'rpn',
        'rpn_level'
    ];

    public function mitigations()
    {
        return $this->hasMany(Mitigation::class);
    }

    public function riskCategories()
{
    return $this->belongsTo(RiskCategories::class, 'kategori_id'); // Ensure the foreign key is 'kategori_id'
}

}
