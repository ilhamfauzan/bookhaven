<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Transaction</h1>

                    <form method="POST" action="{{ route('transaction.update', $transaction->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                            <select id="payment_status" name="payment_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Pending" @if($transaction->payment_status == 'Pending') selected @endif>Pending</option>
                                <option value="Paid" @if($transaction->payment_status == 'Paid') selected @endif>Paid</option>
                                <option value="Failed" @if($transaction->payment_status == 'Failed') selected @endif>Failed</option>
                                <option value="Cancelled" @if($transaction->payment_status == 'Cancelled') selected @endif>Cancelled</option>
                                <option value="Refunded" @if($transaction->payment_status == 'Refunded') selected @endif>Refunded</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="transaction_status" class="block text-sm font-medium text-gray-700">Transaction Status</label>
                            <select id="transaction_status" name="transaction_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Processing" @if($transaction->transaction_status == 'Processing') selected @endif>Processing</option>
                                <option value="Shipped" @if($transaction->transaction_status == 'Shipped') selected @endif>Shipped</option>
                                <option value="Completed" @if($transaction->transaction_status == 'Completed') selected @endif>Completed</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="shipping_status" class="block text-sm font-medium text-gray-700">Shipping Status</label>
                            <select id="shipping_status" name="shipping_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Processing" @if($transaction->shipping_status == 'Processing') selected @endif>Processing</option>
                                <option value="Shipping" @if($transaction->shipping_status == 'Shipping') selected @endif>Shipping</option>
                                <option value="Delivered" @if($transaction->shipping_status == 'Delivered') selected @endif>Delivered</option>
                            </select>
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Transaction
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('transaction.history') }}" class="text-indigo-600 hover:text-indigo-500">Back to Transaction History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
