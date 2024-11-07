<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetKritis extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'name',
    ];

    public function riskCategories()
    {
        return $this->belongsTo(RiskCategories::class, 'kategori_id'); // Ensure the foreign key is 'kategori_id'
    }

    public function kelemahanAsets()
    {
        return $this->hasMany(KelemahanAsets::class);
    }
}
