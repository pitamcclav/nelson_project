<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'category', 'description', 'unit', 'quantity', 'price', 'status','image'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
