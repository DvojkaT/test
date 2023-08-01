<?php

namespace App\Models;

use App\Domain\Enums\TransferStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transfer extends Model
{

    protected static function boot() {
        parent::boot();

        static::creating(function ($transfer) {
            $transfer->status = TransferStatusEnum::IN_ORDER->name;
        });
    }


    /**
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'amount',
        'status',
        'sender_id',
        'receiver_id'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function sender(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function receiver(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }
}
