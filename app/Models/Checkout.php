<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'paymentMethod',
        'address_id',
        'cart_id',
        'user_id'

    ];

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }


}
