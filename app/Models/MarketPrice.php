<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'average_price', 'recorded_at'];
}
