<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'aset_id',
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

    public function asetKritis()
    {
        return $this->belongsTo(AsetKritis::class, 'aset_id');
    }
}
