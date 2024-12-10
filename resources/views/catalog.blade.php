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
        @include('books.latest')

        @include('books.categories')

        @include('books.books-per-category')
     
    </div>

</x-app-layout>
