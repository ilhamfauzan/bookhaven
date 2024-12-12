<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-8">
                <!-- Menampilkan Gambar Buku -->
                <div class="sm:w-[420px] h-[390px] flex justify-center mb-8 sm:mb-0">
                    <img src="{{ asset('storage/' . $book->image_url) }}" alt="Cover image of {{ $book->title }}" class="w-full sm:w-64 h-auto object-cover rounded-lg shadow-md">
                </div>

                <!-- Informasi Buku -->
                <div class="sm:w-2/3">
                    <p class="mt-1 mb-2 text-m text-gray-600">You're about to buy: </p>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h1>
                    <p class="text-lg text-gray-600">{{ $book->author }}</p>
                    {{-- <p class="mt-1 mb-2 text-m text-gray-600 underline">{{ $book->category }}</p> --}}


                    <h1 class="text-2xl font-extrabold text-gray-900 mt-10">Shipping Information</h1>
                    <div class="mt-4 text-gray-800 text-justify">
                        <form action="{{ route('checkout.store', $book->slug) }}" method="POST">
                            @csrf <!-- Token CSRF untuk keamanan -->
                            <div class="grid grid-cols-1 gap-3">
                                <!-- Input Fields -->
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full border bg-gray-200 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm" value="{{ Auth::user()->name }}" required readonly>
                                
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone" class=" block w-full border bg-gray-200 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm" value="{{ Auth::user()->phone }}" required readonly>
                                
                                <label for="address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                                <textarea name="address" id="address" rows="3" class="mt-1 block w-full border bg-gray-200 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm" required readonly>{{ Auth::user()->address }}</textarea>
                                <div class="mb-4 text-gray-600 text-sm">
                                    <p>
                                        If you want to change this detail, please go to <a href="{{ route('profile.edit') }}" class="text-indigo-500 hover:text-indigo-600 underline">Profile Settings</a>
                                    </p>
                                </div>
                                
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">-- Choose Payment Method --</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Card">Debit / Credit Card</option>
                                    <option value="VA">Virtual Account</option>
                                    <option value="Cash">Cash (Pay in Store)</option>
                                </select>
                        
                                <label for="delivery_method" class="block text-sm font-medium text-gray-700">Delivery Method</label>
                                <select name="delivery_method" id="delivery_method" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="{{ Auth::user()->address }}">Delivered to your address</option>
                                    <option value="" disabled>-- Pick up at Store --</option>
                                    <option value="jakarta">Jakarta | Grand Indonesia</option>
                                    <option value="bandung">Bandung | Paris Van Java Mall</option>
                                    <option value="surabaya">Surabaya | Tunjungan Plaza</option>
                                </select>
                            </div>
                        
                            <button type="submit" class="mt-4 w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">
                                Buy
                            </button>
                        </form>
                        
                    </div>

                    
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">
                {{-- <a href="{{ route('catalog') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold"> --}}
                    &laquo; Back to book details
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('delivery_method').addEventListener('change', function() {
        var selectedOption = this.value;
        var addressInput = document.getElementById('address');
        
        switch(selectedOption) {
            case 'jakarta':
                addressInput.value = 'Grand Indonesia, Jl. M.H. Thamrin No.1, Kb. Sirih, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10310';
                break;
            case 'bandung':
                addressInput.value = 'Paris Van Java Mall, Jl. Sukajadi No.137-139, Sukajadi, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162';
                break;
            case 'surabaya':
                addressInput.value = 'Tunjungan Plaza, Jl. Basuki Rahmat No.8, Gubeng, Kec. Gubeng, Kota SBY, Jawa Timur 60272';
                break;
            default:
                addressInput.value = '{{ Auth::user()->address }}';
                break;
        }
    });
</script>

<input type="hidden" id="address_input" name="address" value="{{ Auth::user()->address }}">
