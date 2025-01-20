<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Courier extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\CourierFactory> */
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'image',
        'name',
        'gender',
        'birthdate',
        'email',
        'phone',
        'address',
        'city',
        'plate_number',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
