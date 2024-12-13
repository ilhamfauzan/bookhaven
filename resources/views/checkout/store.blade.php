<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900">Order Summary</h1>

                    <div class="mt-4">
                        <p class="text-lg text-gray-600">You have placed an order for:</p>
                        <ul class="list-disc pl-4">
                            <li>{{ $book->title }}</li>
                        </ul>

                        <p class="text-lg text-gray-600 mt-4">Total Price: Rp{{ number_format($book->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="mt-8">
                        {{-- <a href="{{ route('transaction.history') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold"> --}}
                        <a href="#" class="text-indigo-600 hover:text-indigo-500 font-semibold">
                            View Order History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


