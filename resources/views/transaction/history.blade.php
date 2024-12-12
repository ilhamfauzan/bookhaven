<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($transactions->isEmpty())
            <div class="text-center p-12">
                <h2 class="text-2xl font-bold text-gray-900">You have no transaction history</h2>
                <p class="mt-4 text-xl text-gray-600">You don't have any transaction history yet.</p>
            </div>
            @else
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4 text-left">TID</th>
                            @if(auth()->user()->is_admin)
                                <th class="py-2 px-4 text-left">Buyer Name</th>
                            @endif
                            <th class="py-2 px-4 text-left">Book Title</th>
                            <th class="py-2 px-4 text-left">Quantity</th>
                            <th class="py-2 px-4 text-left">Total Price</th>
                            <th class="py-2 px-4 text-left">Payment Status</th>
                            <th class="py-2 px-4 text-left">Transaction Status</th>
                            <th class="py-2 px-4 text-left">Shipping Status</th>

                            <th class="py-2 px-4 text-left">Date</th>
                            @if(auth()->user()->is_admin)
                                <th class="py-2 px-4 text-left">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $transaction->id }}</td>
                                @if(auth()->user()->is_admin)
                                    <td class="py-2 px-4">{{ $transaction->user->name }}</td>
                                @endif
                                <td class="py-2 px-4 flex items-center">
                                    <img src="{{ asset('storage/' . $transaction->book->image_url) }}" class="h-15 w-10 mr-2" alt="">
                                    {{ $transaction->book->title }}
                                </td>
                                <td class="py-2 px-4">{{ $transaction->quantity }}</td>
                                <td class="py-2 px-4">Rp.{{ number_format($transaction->total_price, 2) }}</td>
                                <td class="py-2 px-4 text-center">
                                    @if($transaction->payment_status === 'Pending')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($transaction->payment_status === 'Paid')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                    @elseif($transaction->payment_status === 'Failed')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Failed
                                        </span>
                                    @elseif($transaction->payment_status === 'Cancelled')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Cancelled
                                        </span>
                                    @elseif($transaction->payment_status === 'Refunded')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Refunded
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Failed
                                        </span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-center">
                                    @if($transaction->transaction_status === 'Processing')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Processing
                                        </span>
                                    @elseif($transaction->transaction_status === 'Cancelled')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Shipped
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Completed
                                        </span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-center">
                                    @if($transaction->shipping_status === 'Processing')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Processing
                                        </span>
                                    @elseif($transaction->shipping_status === 'Shipping')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Shipping
                                        </span>
                                    @elseif($transaction->shipping_status === 'Delivered')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Delivered
                                        </span>
                                    @elseif($transaction->shipping_status === 'Received')
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Received
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Failed
                                        </span>
                                    @endif
                                </td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                                @if(auth()->user()->is_admin)
                                <td class="py-2 px-4">
                                        {{-- <a href="#" class="text-blue-500 hover:underline">edit</a> --}}
                                        <a href="{{ route('transaction.edit', $transaction->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            </div>
        </div>
    </div>
</x-app-layout>

