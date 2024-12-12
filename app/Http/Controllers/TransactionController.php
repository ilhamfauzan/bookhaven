<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function show()
    {
        if (Auth::user()->is_admin) {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        }
        // dd($transactions);
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
}
