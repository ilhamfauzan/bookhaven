<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div id="notification" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow-lg" style="animation: fadeOut 5s forwards; display: none;">
                    <p>{{ session('success') }}</p>
                </div>

                <style>
                    @keyframes fadeOut {
                        0% {
                            opacity: 1;
                        }
                        100% {
                            opacity: 0;
                        }
                    }
                </style>

                <script>
                    const notification = document.getElementById('notification');
                    if (notification) {
                        notification.style.display = 'block';
                        setTimeout(() => {
                            notification.remove();
                        }, 5000);
                    }
                </script>
            @endif
            
        @if (count($books) == 0)
            <div class="text-center p-12">
                <h2 class="text-2xl font-bold text-gray-900">No books found</h2>
                <p class="mt-4 text-xl text-gray-600">It looks like there are no books in the database.</p>
                @auth
                    @if (Auth::user()->is_admin)
                    <a href="{{ route('books.create') }}" class="mt-8 inline-block px-6 py-2 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add a book</a>
                    @endif
                @endauth
            </div>
        @else
            @include('books.latest')

            @include('books.categories')

            @include('books.books-per-category')
        @endif
     
    </div>

</x-app-layout>
