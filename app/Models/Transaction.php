<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'book_id', 
        'book_title',
        'book_image_url',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if ($book = Book::withTrashed()->find($transaction->book_id)) {
                $transaction->book_title = $book->title;
                $transaction->book_image_url = $book->image_url;
            }
        });
    }

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
