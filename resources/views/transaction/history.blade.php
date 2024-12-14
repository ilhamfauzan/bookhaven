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
            <div class="bg-white shadow-md rounded-lg px-4 py-6 mx-auto">
                <div class="overflow-x-auto">
                    <table class="max-w-7xl mx-auto divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    TID
                                </th>
                                @if(auth()->user()->is_admin)
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Buyer Name
                                    </th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Book Title
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Price
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Status
                                </th>
                                {{-- <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Transaction Status
                                </th> --}}
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Shipping Status
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                @if(auth()->user()->is_admin)
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        {{ $transaction->id }}
                                    </td>
                                    @if(auth()->user()->is_admin)
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $transaction->user->name }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10" src="{{ asset('storage/' . $transaction->book->image_url) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ Str::limit($transaction->book->title, 30) }}
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
                                    {{-- <td class="px-3 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            @if($transaction->transaction_status === 'Processing')
                                                Processing
                                            @elseif($transaction->transaction_status === 'Cancelled')
                                                Shipped
                                            @else
                                                Completed
                                            @endif
                                        </span>
                                    </td> --}}
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            @if($transaction->shipping_status === 'Processing')
                                                Processing
                                            @elseif($transaction->shipping_status === 'Shipping')
                                                Shipping
                                            @elseif($transaction->shipping_status === 'Delivered')
                                                Delivered
                                            @elseif($transaction->shipping_status === 'Received')
                                                Received
                                            @else
                                                Failed
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                                    </td>
                                    @if(auth()->user()->is_admin)
                                        <td class="px-3 py-4 whitespace-nowrap">
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
    </div>
</x-app-layout>

