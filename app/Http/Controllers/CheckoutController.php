<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        // return redirect()->route('catalog')->with('success', 'Book checked out successfully!');
        return view('checkout.index', compact('book'));
    }

    public function store(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'quantity' => 'required|integer',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',

        ]);

        $book = Book::where('slug', $slug)->firstOrFail();
        
        
        if (!$book) {
            return redirect()->route('checkout.index', $slug)
            ->with('error', 'Buku tidak ditemukan');
        }
        
        $quantity = $request->quantity;
        if ($book->stock < $quantity) {
            return redirect()->route('catalog')
                ->with('error', 'Insufficient stock for the requested quantity.');
        }
        $totalPrice = $book->price * $quantity;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_status' => 'Pending',
            'transaction_status' => 'Processing',
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
            'shipping_status' => 'Processing',     
        ]);

        $book->decrement('stock', $quantity);

        return view('checkout.store', compact('book', 'transaction'));
    }

    public function success($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('checkout.store', ['book' => $book]);
    }
}
