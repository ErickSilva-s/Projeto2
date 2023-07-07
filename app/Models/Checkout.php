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
        'product_id',
        'user_id'

    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
