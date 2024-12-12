<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // use HasFactory;

    protected $fillable = [
        'user_id', 
        'book_id', 
        'quantity', 
        'total_price', 
        'payment_status', 
        'transaction_status', 
        'transaction_date', 
        'address', 
        'shipping_status', 
        'payment_method',
        'payment_reference',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
