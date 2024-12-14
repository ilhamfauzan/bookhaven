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
                    <div class="flex items-center justify-center">
                        <svg class="h-20 w-20 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="mt-4">
                        <p class="text-lg text-gray-600 mt-4 flex items-center justify-center mb-5">You have placed an order for:</p>
                        <p class="list-disc pl-4 flex items-center justify-center text-2xl">{{ $book->title }}</p>

                        <p class="text-lg text-gray-600 flex items-center justify-center">Rp{{ number_format($transaction->total_price, 0, ',', '.') }} via {{ $transaction->payment_method }}</p>
                        <a href="{{ route('transaction.history') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold  flex items-center justify-center mt-5"> View Order History </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
