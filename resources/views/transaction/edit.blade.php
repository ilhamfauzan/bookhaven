<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex">
                    <div class="w-1/2 p-6 bg-white border-b border-gray-200">
                        <h1 class="text-2xl font-bold text-gray-900">Transaction Data</h1>

                        <div class="mt-8 space-y-6">
                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Order ID:</strong></p>
                                <p>{{ $transaction->id }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Book Cover:</strong></p>
                                @if($transaction->book_image_url)
                                    <img src="{{ asset('storage/' . $transaction->book_image_url) }}" alt="Cover image of {{ $transaction->book_title }}" class="w-24 h-auto object-cover rounded-lg shadow-md">
                                @else
                                    <div class="w-24 h-32 bg-gray-200 flex items-center justify-center rounded-lg shadow-md">
                                        <span class="text-gray-500 text-xs">No image</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>User Name:</strong></p>
                                <p>{{ $transaction->user->name }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Book Title:</strong></p>
                                <p>{{ $transaction->book_title }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Book Price:</strong></p>
                                <p>Rp{{ number_format($transaction->total_price / $transaction->quantity, 0, ',', '.') }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Quantity:</strong></p>
                                <p>{{ $transaction->quantity }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Total Price:</strong></p>
                                <p>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Payment Method:</strong></p>
                                <p>{{ $transaction->payment_method }}</p>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <p><strong>Delivery Address:</strong></p>
                                <p>{{ $transaction->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2 p-6">
                        <h1 class="text-2xl font-bold text-gray-900">Update Transaction</h1>

                        @if($transaction->transaction_status == 'Cancelled')
                            <div class="mt-6 bg-yellow-50 border border-yellow-400 p-4 rounded-lg">
                                <p class="text-yellow-700">This transaction has been cancelled.</p>
                            </div>
                        @else
                            <form method="POST" action="{{ route('transaction.update', $transaction->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="space-y-6 mt-8">
                                    <div>
                                        <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                                        <select id="payment_status" name="payment_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="Pending" @if($transaction->payment_status == 'Pending') selected @endif>Pending</option>
                                            <option value="Paid" @if($transaction->payment_status == 'Paid') selected @endif>Paid</option>
                                            <option value="Failed" @if($transaction->payment_status == 'Failed') selected @endif>Failed</option>
                                            <option value="Cancelled" @if($transaction->payment_status == 'Cancelled') selected @endif>Cancelled</option>
                                            <option value="Refunded" @if($transaction->payment_status == 'Refunded') selected @endif>Refunded</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="transaction_status" class="block text-sm font-medium text-gray-700">Transaction Status</label>
                                        <select id="transaction_status" name="transaction_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="Processing" @if($transaction->transaction_status == 'Processing') selected @endif>Processing</option>
                                            <option value="Cancelled" @if($transaction->transaction_status == 'Cancelled') selected @endif>Cancelled</option>
                                            <option value="Completed" @if($transaction->transaction_status == 'Completed') selected @endif>Completed</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="shipping_status" class="block text-sm font-medium text-gray-700">Shipping Status</label>
                                        <select id="shipping_status" name="shipping_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="Processing" @if($transaction->shipping_status == 'Processing') selected @endif>Processing</option>
                                            <option value="Shipping" @if($transaction->shipping_status == 'Shipping') selected @endif>Shipping</option>
                                            <option value="Delivered" @if($transaction->shipping_status == 'Delivered') selected @endif>Delivered</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update Transaction
                                    </button>
                                </div>
                            </form>
                        @endif

                        <div class="mt-6">
                            <a href="{{ route('transaction.history') }}" class="text-indigo-600 hover:text-indigo-500"> &laquo; Back to Transaction History</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
