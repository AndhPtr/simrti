<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'risk_id',          // Add the foreign key field
        'tindakan_mitigasi',
    ];

    /**
     * Define the relationship with the Risk model.
     * Each mitigation belongs to a specific risk.
     */
    public function risk()
    {
        return $this->belongsTo(Risk::class);
    }
}
