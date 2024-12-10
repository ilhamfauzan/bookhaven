<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book: ') . $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menandakan ini adalah request PUT untuk update -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                        <!-- Card Image (left side) -->
                        <div class="border rounded-lg p-8 shadow-sm">
                            <!-- Image Preview -->
                            <label for="image_url" class=" justify-center flex block text-lg font-medium text-gray-700 mb-5">Book Cover</label>
                            <div class="sm:w-3/3 flex justify-center mb-8 sm:mb-0">
                                <!-- Jika sudah ada gambar, tampilkan gambar yang ada -->
                                <img src="{{ asset('storage/' . $book->image_url) }}" alt="Cover image of {{ $book->title }}" class="w-[380px] h-[400px] sm:w-64 object-cover rounded-lg shadow-md">
                            </div>
                            <input type="file" name="image_url" id="image_url" class="mt-5 mx-auto justify-center flex block w-2/3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" accept="image/*" onchange="previewImage(event)" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; background-color: #f9fafb; color: #6b7280; transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform; transition-duration: 150ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);" required>
                        </div>

                        <!-- Input Fields (right side) -->
                        <div class="grid-cols-1 md:col-span-2">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Book Title</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('title', $book->title) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                                <input type="text" name="author" id="author" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('author', $book->author) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $book->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <input type="text" name="category" id="category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('category', $book->category) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('price', $book->price) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" id="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('stock', $book->stock) }}" required>
                            </div>
                            
                            <div>
                                <button type="submit" class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700">
                                    Update Book
                                </button>
                            </form>
                                <form action="{{ route('books.destroy', $book->slug) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full mt-3 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-500">
                                        Delete
                                    </button>
                                </form>
                                
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image_preview');
            
            if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
            } else {
            preview.src = '{{ $book->image_url ? asset('storage/' . $book->image_url) : 'https://placehold.co/170x320' }}';
            preview.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const preview = document.getElementById('image_preview');
            if (!preview.src) {
                preview.src = '{{ $book->image_url ? asset('storage/' . $book->image_url) : 'https://placehold.co/170x320' }}';
            preview.classList.remove('hidden');
            }
        });

</script>
</x-app-layout>
