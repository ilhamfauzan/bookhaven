<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateTransactionBookDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = \App\Models\Transaction::all();
        
        foreach ($transactions as $transaction) {
            $book = \App\Models\Book::withTrashed()->find($transaction->book_id);
            if ($book) {
                $transaction->update([
                    'book_title' => $book->title,
                    'book_image_url' => $book->image_url,
                ]);
            }
        }
    }
}
