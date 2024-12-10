<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    @foreach($books->unique('category') as $category)
        {{-- <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $category->category }}</h3> --}}
        <h3 id="{{ $category->category }}" class="text-xl font-semibold text-gray-800 mb-4">{{ $category->category }}</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
            @foreach($books->where('category', $category->category) as $book)
            <a href="{{ route('books.detail', $book->slug) }}" class="bg-white rounded-lg w-full shadow-md overflow-hidden transform transition-all hover:scale-105 hover:shadow-lg">
                <!-- Gambar diperbesar sedikit dan dikurangi tingginya -->
                <img src="{{ asset('storage/' . $book->image_url) }}" alt="Cover image of {{ $book->title }}" class="w-full h-[280px] object-cover">

                <div class="p-4 space-y-3">
                    <h3 class="text-base font-semibold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $book->author }}</p>
                    <p class="text-sm text-gray-600">{{ \Str::limit($book->description, 50) }} <span class="text-indigo-600 hover:text-indigo-500 font-semibold text-sm">more &raquo;</span></p>

                    <div class="flex items-center justify-between">
                        <span class="text-base text-gray-900">Rp{{ number_format($book->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500 text-right">Stock: <br>{{ $book->stock }}</span>
                    </div>
                    
                </div>
            </a>
            @endforeach
        </div>
    @endforeach
</div>
