<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'category_id',
        'landfill_id',
        'date',
        'pickup_lat',
        'pickup_long',
        'address',
        'weight',
        'price',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function courier() {
        return $this->belongsTo(Courier::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function landfill() {
        return $this->belongsTo(Landfill::class);
    }
}
