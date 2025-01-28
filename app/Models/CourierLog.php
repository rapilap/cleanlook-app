<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourierLog extends Model
{
    protected $fillable = [
        'courier_id',
        'email',
        'name',
        'gender',
        'birthdate',
        'phone',
        'address',
        'city',
        'plate_number',
    ];

    public function courier() {
        return $this->belongsTo(Courier::class);
    }
}
