<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'stock_product',
        'price',
        'category',
        'imagem',
        'user_id'
    ];

    public function user(){
    return $this->belongsTo(User::class, 'user_id');
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

public function products()
{
    return $this->belongsToMany(Checkout::class);
}

public function carts()
{
    return $this->belongsToMany(CartItem::class);
}


}
