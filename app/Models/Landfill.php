<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Landfill extends Model
{
    /** @use HasFactory<\Database\Factories\LandfillFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        // 'id',
        'name',
        'address',
        'capacity',
        'latitude',
        'longitude',
    ];

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
