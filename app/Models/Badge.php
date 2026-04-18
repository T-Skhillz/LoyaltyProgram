<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'name', 'points_required',
    ];

    protected function casts() 
    {
        return [
            'points_required' => 'integer',
        ];
    }

    // Relationships
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
                    ->withPivot('unlocked_at');
    }
}
