<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'cat_name', 
        'cat_price', 
    ];

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
