<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landfill extends Model
{
    /** @use HasFactory<\Database\Factories\LandfillFactory> */
    use HasFactory;

    protected $fillable = [
        // 'id',
        'name',
        'address',
        'capacity',
        'latitude',
        'longitude',
    ];
}
