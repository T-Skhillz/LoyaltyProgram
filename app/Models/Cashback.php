<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cashback extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id', 'badge_id', 'amount', //  Add user_id
    ];

    protected function casts()
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public $timestamps = true;

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
