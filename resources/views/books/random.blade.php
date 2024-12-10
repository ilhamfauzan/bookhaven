<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">Latest Books</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books->shuffle() as $book)
            <a href="{{ route('books.detail', $book->slug) }}" class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all hover:scale-105 hover:shadow-lg">
                <!-- Gambar diperbesar sedikit dan dikurangi tingginya -->
                <img src="{{ $book->image_url }}" alt="Cover image of {{ $book->title }}" class="w-full object-cover">

                <div class="p-4 space-y-3">
                    <h3 class="text-base font-semibold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $book->author }}</p>
                    <p class="text-sm text-gray-600">{{ \Str::limit($book->description, 80) }} <span class="text-indigo-600 hover:text-indigo-500 font-semibold text-sm">more &raquo;</span></p>

                    <div class="flex items-center justify-between">
                        <span class="text-base font-medium text-gray-900">Rp{{ number_format($book->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500">Stock: {{ $book->stock }}</span>
                    </div>
                    
                    <div class="mt-2">
                        
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
