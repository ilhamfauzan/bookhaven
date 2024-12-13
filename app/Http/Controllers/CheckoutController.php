<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    //
    // checkout
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        // $book->decrement('stock');

        // return redirect()->route('catalog')->with('success', 'Book checked out successfully!');
        return view('checkout.index', compact('book'));
    }

    public function store(Request $request, $slug)
    {
        // Validasi inputan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
        ]);

        // Ambil data buku berdasarkan slug
        $book = Book::where('slug', $slug)->firstOrFail();

        $quantity = 1; 

        // Jika buku tidak ditemukan, beri pesan error
        if (!$book) {
            return redirect()->route('checkout.index', $slug)
                            ->with('error', 'Buku tidak ditemukan');
        }

        // Hitung total harga
        $totalPrice = $book->price;

        // Simpan transaksi ke database
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'quantity' => 1,
            'total_price' => $totalPrice,
            'payment_status' => 'Pending',
            'transaction_status' => 'Processing',
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
            'shipping_status' => 'Processing',     
        ]);

        // Kurangi jumlah stok buku dengan quantity
        $book->decrement('stock', $quantity);

        // Redirect ke halaman success dengan data buku
        return redirect()->route('checkout.success', ['slug' => $slug])
                        ->with(['book' => $book, 'transaction' => $transaction]);
    }

    public function success($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('checkout.store', ['book' => $book]);
    }
}
