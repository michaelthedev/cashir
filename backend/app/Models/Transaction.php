<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'trans_id',
        'reference',
        'type',
        'fee',
        'flow',
        'details',
        'status',
    ];

    protected $casts = [
        'fee' => 'float',
        'amount' => 'float',
        'details' => 'array',
        'trans_id' => 'integer',
    ];

    protected $hidden = [
        'user_id',
        'details',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        // 'date'
    ];

    public static function new(array $data): self
    {
        $data += [
            'trans_id' => date('ymdHis') . rand(10, 99)
        ];

        return Transaction::create($data);
    }

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    public function getDateAttribute(): string
    {
        return $this->created_at
            ->setTimezone(config('app.timezone'))
            ->format('Y-m-d h:ia');
    }
}
