<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
     /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'full_name', 'username', 'email',
        'password', 'current_points',
        'total_amount_spent', 'total_purchase_count',
    ];
   
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password'             => 'hashed',
            'current_points'       => 'integer',
            'total_amount_spent'   => 'decimal:2',
            'total_purchase_count' => 'integer',
        ];
    }

    // Add these to handle the UUID properly
    protected $keyType = 'string';
    public $incrementing = false;

    // Relationships

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
                   ->withPivot('unlocked_at');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                   ->withPivot('unlocked_at');
    }

    public function cashbacks()
    {
        return $this->hasMany(Cashback::class);
    }
}
