<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- @if($transactions->isEmpty())
            <div class="text-center p-12">
                <h2 class="text-2xl font-bold text-gray-900">You have no transaction history</h2>
                <p class="mt-4 text-xl text-gray-600">You don't have any transaction history yet.</p>
            </div>
            @else
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4 text-left">Transaction ID</th>
                            <th class="py-2 px-4 text-left">Book Title</th>
                            <th class="py-2 px-4 text-left">Quantity</th>
                            <th class="py-2 px-4 text-left">Total Price</th>
                            <th class="py-2 px-4 text-left">Payment Status</th>
                            <th class="py-2 px-4 text-left">Transaction Status</th>
                            <th class="py-2 px-4 text-left">Date</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $transaction->id }}</td>
                                <td class="py-2 px-4">{{ $transaction->book->title }}</td>
                                <td class="py-2 px-4">{{ $transaction->quantity }}</td>
                                <td class="py-2 px-4">{{ number_format($transaction->total_price, 2) }}</td>
                                <td class="py-2 px-4">
                                    @if($transaction->payment_status === 'pending')
                                        <span class="text-yellow-500">Pending</span>
                                    @elseif($transaction->payment_status === 'completed')
                                        <span class="text-green-500">Completed</span>
                                    @else
                                        <span class="text-red-500">Failed</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4">
                                    @if($transaction->transaction_status === 'processing')
                                        <span class="text-blue-500">Processing</span>
                                    @elseif($transaction->transaction_status === 'shipped')
                                        <span class="text-green-500">Shipped</span>
                                    @else
                                        <span class="text-gray-500">Completed</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4">{{ $transaction->transaction_date->format('d M Y') }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="text-blue-500 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif --}}

            </div>
        </div>
    </div>
</x-app-layout>

