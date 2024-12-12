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
        // $transactions = Transaction::where('user_id', auth()->user()->id)->get();

        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        dd($transactions);
        return view('transaction.history', compact('transactions'));
    }
}
