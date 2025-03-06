<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'buyer_id', 'guest_name', 'guest_email', 'guest_phone',
        'delivery_address', 'delivery_city', 'shipping_fee',
        'subtotal', 'total', 'payment_method', 'payment_status',
        'transaction_code', 'status', 'notes'
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
