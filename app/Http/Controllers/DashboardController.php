<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
    public function home()
    {
        
        return view('home');
    }

    public function getRandomBooks()
    {
        $books = Book::inRandomOrder()->take(5)->get();

        return view('books.random', compact('books'));
    }
}