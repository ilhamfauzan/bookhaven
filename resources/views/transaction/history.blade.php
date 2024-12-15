<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.notifier')
            @if($transactions->isEmpty())
            <div class="text-center p-12">
                <h2 class="text-2xl font-bold text-gray-900">You have no transaction history</h2>
                <p class="mt-4 text-xl text-gray-600">You don't have any transaction history yet.</p>
            </div>
            @else
            <div class="bg-white shadow-md rounded-lg px-4 py-6 mx-auto">
                <div class="overflow-x-auto">
                    <table class="max-w-auto mx-auto divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    TID
                                </th>
                                @if(auth()->user()->is_admin)
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Buyer Name
                                    </th>
                                @endif
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Book Title
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Qty
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Price
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Status
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Shipping Status
                                </th>
                                {{-- @if(!auth()->user()->is_admin) --}}
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Transaction Status
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                {{-- @endif --}}
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                                 
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $cancelledTransactions = $transactions->where('transaction_status', 'Cancelled');
                                $transactions = $transactions->where('transaction_status', '!=', 'Cancelled')->sortByDesc('created_at');
                                $transactions = $transactions->merge($cancelledTransactions);
                            @endphp
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="px-2 py-4 whitespace-nowrap">
                                        {{ $transaction->id }}
                                    </td>
                                    @if(auth()->user()->is_admin)
                                        <td class="px-3 py-4 whitespace-nowrap">
                                            {{ $transaction->user->name }}
                                        </td>
                                    @endif
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($transaction->book_image_url)
                                                    <img class="h-10 w-10" src="{{ asset('storage/' . $transaction->book_image_url) }}" alt="">
                                                @else
                                                    <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded">
                                                        <span class="text-gray-500 text-xs">No image</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{  Str::limit($transaction->book_title ?? 'Unknown Book', 30) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        {{ $transaction->quantity }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        Rp.{{ number_format($transaction->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($transaction->payment_status)
                                            @case('Pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                                @break

                                            @case('Paid')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Paid
                                                </span>
                                                @break

                                            @case('Failed')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Failed
                                                </span>
                                                @break

                                            @case('Cancelled')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Cancelled
                                                </span>
                                                @break

                                            @case('Refunded')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Refunded
                                                </span>
                                                @break

                                            @default
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Failed
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        @if($transaction->shipping_status === 'Processing')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Processing
                                            </span>
                                        @elseif($transaction->shipping_status === 'Shipped')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Shipped
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Delivered
                                            </span>
                                        @endif
                                    </td>
                                    {{-- @if(!auth()->user()->is_admin) --}}
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        @if($transaction->transaction_status === 'Processing')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Processing
                                            </span>
                                        @elseif($transaction->transaction_status === 'Cancelled')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        @endif
                                    </td>
                                    {{-- @endif --}}
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                                    </td>
                                    @if(auth()->user()->is_admin)
                                        <td class="px-3 py-4 whitespace-nowrap">
                                            <a href="{{ route('transaction.edit', $transaction->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-md hover:bg-blue-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                        </td>
                                    @else
                                        <td class="px-3 py-4 whitespace-nowrap">
                                            @if($transaction->transaction_status === 'Processing')
                                                <form action="{{ route('transaction.cancel', $transaction->id) }}" method="post" onsubmit="return confirm('Are you sure you want to cancel this transaction?');">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
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
    </div>
</x-app-layout>
