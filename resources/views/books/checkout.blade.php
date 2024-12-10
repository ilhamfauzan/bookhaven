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
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-3">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ Auth::user()->name }}" required>

                                <label for="no_hp" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="no_hp" id="no_hp" class=" block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>

                                <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>

                                <label for="kode_pos" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" name="kode_pos" id="kode_pos" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>

                                <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">-- Choose Payment Method --</option>
                                    <option value="" disabled>-- Digital Payment --</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Card">Debit / Credit Card</option>
                                    <option value="VA">Virtual Account</option>
                                    <option value="" disabled>-- Cash Payment --</option>
                                    <option value="Cash">Cash (Pay in Store)</option>
                                </select>

                                <label for="tempat_pengambilan" class="block text-sm font-medium text-gray-700">Pickup Location</label>
                                <select name="tempat_pengambilan" id="tempat_pengambilan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">-- Select Pickup Location --</option>
                                    <option value="jakarta">Jakarta Store (Grand Indonesia, Jl. M.H. Thamrin No.1, Kb. Sirih, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10310)</option>
                                    <option value="bandung">Bandung (Paris Van Java Mall, Jl. Sukajadi No.137-139, Sukajadi, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162)</option>
                                    <option value="surabaya">Surabaya (Tunjungan Plaza, Jl. Basuki Rahmat No.8, Gubeng, Kec. Gubeng, Kota SBY, Jawa Timur 60272)</option>
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

