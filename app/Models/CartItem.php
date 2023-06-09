<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'user_id',
        'product_id',
    ];

    public function myProducts() {
        return $this->hasMany(Product::class, 'user_id' );
    }
}
