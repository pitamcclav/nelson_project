<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'delivery_status', 'tracking_code', 'delivery_amount', 'estimated_arrival'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
