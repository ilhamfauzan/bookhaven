<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //
    // public function show()
    // {
    //     if (Auth::user()->is_admin) {
    //         $transactions = Transaction::all();
    //     } else {
    //         $transactions = Transaction::withTrashed()
    //             ->with(['book' => function ($query) {
    //                 $query->withTrashed();
    //             }])
    //             ->where('user_id', Auth::user()->id)
    //             ->get();
    //     }
    //     // dd($transactions);
    //     return view('transaction.history', compact('transactions'));
    // }

    public function show()
{
    if (Auth::user()->is_admin) {
        $transactions = Transaction::with('user')->get();
    } else {
        $transactions = Transaction::with('user')
            ->where('user_id', Auth::user()->id)
            ->get();
    }
    return view('transaction.history', compact('transactions'));
}

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Pastikan hanya admin yang bisa mengedit
        if (!Auth::user()->is_admin) {
            return redirect()->route('transaction.history');
        }

        return view('transaction.edit', compact('transaction'));
        }

        public function update(Request $request, $id)
        {
        $transaction = Transaction::findOrFail($id);
        // dd($transaction);

        // Validasi input
        $validated = $request->validate([
            'payment_status' => 'required|in:Pending,Paid,Failed,Cancelled,Refunded',
            'transaction_status' => 'required|in:Processing,Cancelled,Completed',
            'shipping_status' => 'required|in:Processing,Shipping,Delivered',
        ]);

        // Update transaksi
        $transaction->update([
            'payment_status' => $request->payment_status,
            'transaction_status' => $request->transaction_status,
            'shipping_status' => $request->shipping_status,
        ]);

        // dd($transaction);

        // Redirect ke halaman riwayat transaksi setelah update
        return redirect()->route('transaction.history')->with('success', 'Transaction updated successfully');
    }

    
    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Pastikan user hanya bisa membatalkan transaksi mereka sendiri
        if ($transaction->user_id !== Auth::user()->id) {
            return redirect()->route('transaction.history')
                ->with('error', 'You are not authorized to cancel this transaction');
        }

        // Pastikan transaksi masih dalam status Processing
        if ($transaction->transaction_status !== 'Processing') {
            return redirect()->route('transaction.history')
                ->with('error', 'Only transactions in Processing status can be cancelled');
        }

        try {
            DB::beginTransaction();

            // Update transaksi
            $transaction->update([
                'transaction_status' => 'Cancelled',
                'payment_status' => 'Cancelled',
                'shipping_status' => 'Processing'
            ]);

            // Kembalikan stok buku
            $book = Book::withTrashed()->find($transaction->book_id);
            if ($book) {
                $book->update([
                    'stock' => $book->stock + $transaction->quantity
                ]);
            }

            DB::commit();

            return redirect()->route('transaction.history')
                ->with('success', 'Transaction cancelled successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('transaction.history')
                ->with('error', 'Failed to cancel transaction. Please try again.');
        }
    }
}