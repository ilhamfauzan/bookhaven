<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-8">
                <!-- Menampilkan Gambar Buku -->
                <div class="sm:w-1/3 flex justify-center mb-8 sm:mb-0">
                    <img src="{{ asset('storage/' . $book->image_url) }}" alt="Cover image of {{ $book->title }}" class="w-[380px] h-[400px] sm:w-64 object-cover rounded-lg shadow-md">
                </div>

                <!-- Informasi Buku -->
                <div class="sm:w-2/3">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $book->title }}</h1>
                    <p class="text-lg text-gray-600">{{ $book->author }}</p>
                    <p class="mt-1 mb-2 text-m text-gray-600 underline">{{ $book->category }}</p>

                    <div class="mt-4 text-gray-800 text-justify">
                        <p><strong>Description:</strong></p>
                        <span class="mt-2 text-sm text-gray-600">{!! nl2br(e($book->description)) !!}</span>
                    </div>
                    
                    <br><hr>
                    {{-- <div class="mt-4">
                        <span class="text-lg font-semibold text-gray-900">Rp{{ number_format($book->price, 0, ',', '.') }}</span>
                        <p class="mt-2 text-sm text-gray-600">Stock: {{ $book->stock }}</p>
                    </div> --}}

                    
                </div>

                <div class="sm:w-1/3">
                    <!-- Tombol Beli -->
                    <div class="mt-8 bg-gray-50 p-4 rounded-lg shadow-lg">
                        <div class="flex flex-col space-y-2 mb-5">
                            <span class="text-2xl font-bold text-gray-800">Rp{{ number_format($book->price, 0, ',', '.') }},-</span>
                            <p class="text-base text-gray-500">Stock: {{ $book->stock }}</p>
                        </div>
                        <form action="{{ route('books.checkout', $book->slug) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <a href="{{ route('books.checkout', $book->slug) }}">
                                    <button type="submit" class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">
                                        Buy
                                    </button>
                                </a>
                            @auth
                                @if (Auth::user()->is_admin)
                                <a href="{{ route('books.edit', $book->slug) }}" class="block mt-4 w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 text-center focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">
                                    Edit Book
                                </a>
                                </a>
                                @endif
                            @endauth
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                {{-- <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-500 font-semibold"> --}}
                <a href="{{ route('catalog') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">
                    &laquo; Back to Catalog
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

