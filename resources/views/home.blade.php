<x-app-layout>

    <div class="#">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-100 via-white to-indigo-50">
                {{-- <div class="max-w-7xl mx-auto"> --}}
                    <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
                        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8 xl:mt-20">
                            <div class="text-center">
                                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                    <x-application-logo class="h-20 w-50 mx-auto" />
                                    <span class="block">Welcome to</span>
                                    <span class="block text-indigo-600">Book Haven</span>
                                </h1>
                                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl">
                                    Your one-stop destination for all your literary needs. Discover new worlds, one page at a time.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('catalog') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out transform hover:scale-105">
                                            Explore Books
                                        </a>
                                    </div>
                                    @guest
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out transform hover:scale-105">
                                            Join Now
                                        </a>
                                    </div>
                                    @endguest
                                </div>
                            </div>
                        </main>
                    </div>
                {{-- </div> --}}
            </div>
            
            <!-- Featured Books Section -->
            <div class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                            Featured Books
                        </h2>
                        <p class="mt-4 text-lg text-gray-500">
                            Discover our handpicked selection of must-read books
                        </p>
                    </div>
                    
                    <div class="mt-12 grid gap-8 md:grid-cols-3 lg:grid-cols-4">
                        <!-- Featured Book Cards will be dynamically populated -->
                        @foreach($books->take(4) as $book)
                        <div class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <div class="relative h-[435px] w-full overflow-hidden">
                                <a href="{{ route('books.detail', $book->slug) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    <img src="{{ asset('storage/' . $book->image_url) }}" alt="{{ $book->title }}" class="w-full h-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                                </a>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $book->title }}</h3>
                                <p class="mt-2 text-sm text-gray-500">{{ Str::limit($book->description, 100) }}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-indigo-600 font-medium">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('books.detail', $book->slug) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        View Details &raquo;
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="py-16 bg-gradient-to-b from-white to-indigo-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900">
                            Why Choose Book Haven?
                        </h2>
                    </div>

                    <div class="mt-12 grid gap-8 md:grid-cols-3">
                        <!-- Feature 1: Wide Selection -->
                        <div class="text-center">
                            <div class="flex justify-center">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100">
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mt-6 text-xl font-medium text-gray-900">Extensive Collection</h3>
                            <p class="mt-2 text-base text-gray-500">
                                From bestsellers to rare finds, we have books for every reader
                            </p>
                        </div>

                        <!-- Feature 2: Fast Delivery -->
                        <div class="text-center">
                            <div class="flex justify-center">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100">
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mt-6 text-xl font-medium text-gray-900">Quick Delivery</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Fast and reliable shipping right to your doorstep or pick up at our store
                            </p>
                        </div>

                        <!-- Feature 3: Secure Payment -->
                        <div class="text-center">
                            <div class="flex justify-center">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100">
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mt-6 text-xl font-medium text-gray-900">Secure Payments</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Safe and secure payment methods for worry-free shopping
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-indigo-700">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        <span class="block">Ready to start reading?</span>
                        <span class="block text-indigo-200">Join our community today.</span>
                    </h2>
                    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 transition duration-150 ease-in-out transform hover:scale-105">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
