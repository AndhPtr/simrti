<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelemahan_id',
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

    public function kelemahanAsets()
    {
        return $this->belongsTo(KelemahanAsets::class, 'kelemahan_id');
    }
}
