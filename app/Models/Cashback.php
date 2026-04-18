<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cashback extends Model
{
    use HasUuids;

    protected $fillable = [
        'amount',
    ];

    protected function casts()
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public $timestamps = false;

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
