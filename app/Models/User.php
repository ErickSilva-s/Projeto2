<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function myAddress()
    {
        return $this->hasMany(Address::class, 'user_id');
    }
    public function myProducts()
    {
        return $this->hasMany(Product::class, 'user_id');
    }
    public function myCarts()
    {
        return $this->hasMany(CartItem::class, 'user_id');
    }

    public function myCheckouts()
    {
        return $this->hasMany(Checkout::class, 'user_id');
    }

    public function myReviews()
    {
        return $this->hasMany(Review::class);
    }

    public function myQuestions()
    {
        return $this->hasMany(Question::class);
    }
}
