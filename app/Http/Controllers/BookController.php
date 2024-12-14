<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan data buku
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|nullable|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan buku ke database
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->category = $request->input('category');
        $book->price = $request->input('price');
        $book->stock = $request->input('stock');
        $book->slug = Str::slug($request->input('title'));
        
        // Menyimpan gambar jika ada
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('books', 'public');
            $book->image_url = $imagePath;
        }

        $book->save();

        // Redirect ke halaman daftar buku atau halaman detail buku
        return redirect()->route('catalog')->with('success', 'Book successfully added!');
    }

    public function showLatestBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->take(5)->get();

        return view('books.latest', compact('books'));
    }

    public function showBooks()
    {
        $books = Book::latest()->get();

        return view('catalog', compact('books'));
    }

    public function showDetails($slug)
    {
        // Menemukan buku berdasarkan slug yang diterima di URL
        $book = Book::where('slug', $slug)->firstOrFail();
 
        // Menampilkan view detail dengan data buku
        return view('books.detail', compact('book'));
    }

    public function edit($slug)
    {
        // $book = Book::findOrFail($slug);
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $slug)
    {
    $book = Book::findOrFail($slug);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|nullable|string',
        'category' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->has('title')) {
        $validated['slug'] = Str::slug($request->input('title'));
    }

    if ($request->hasFile('image_url')) {
        // Hapus gambar lama jika ada
        if ($book->image_url) {
            Storage::delete('public/' . $book->image_url);
        }

        // Simpan gambar baru
        $imagePath = $request->file('image_url')->store('book_covers', 'public');
        $validated['image_url'] = $imagePath;
    }

    // Update data buku
    $book->update($validated);

    return redirect()->route('catalog')->with('success', 'Book updated successfully!');
    }

    

    public function destroy($slug)
{
    $book = Book::where('slug', $slug)->firstOrFail(); // Cari buku berdasarkan slug

    // Hapus gambar jika ada
    // if ($book->image_url) {
    //     $image_path = storage_path('app/public/' . $book->image_url);
    //     if (File::exists($image_path)) {
    //         File::delete($image_path);
    //     }
    // }

    $book->delete(); // Hapus buku dari database

    return redirect()->route('catalog')->with('successRed', 'Book deleted successfully!');
}


    
}
