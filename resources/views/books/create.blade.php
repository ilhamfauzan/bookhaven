<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                        <!-- Card Image (left side) -->
                        <div class="border rounded-lg p-8 shadow-sm">
                            <!-- Image Preview -->
                            <label for="image_url" class="block text-sm font-medium text-gray-700">Book Cover</label>
                            <div class="flex items-center justify-center w-2/3 mb-8">
                                <img id="image_preview" class="hidden w-full h-80 object-cover rounded-md border border-gray-300 shadow-sm" alt="Image Preview"s>
                            </div>
                            <input type="file" name="image_url" id="image_url" class="mt-1 block w-2/3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" accept="image/*" onchange="previewImage(event)" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; background-color: #f9fafb; color: #6b7280; transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform; transition-duration: 150ms; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);" required>
                        </div>

                        <!-- Input Fields (right side) -->
                        <div class="grid-cols-1 md:col-span-2">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Book Title</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                                <input type="text" name="author" id="author" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <input type="text" name="category" id="category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" id="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div>
                                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-500">
                                    Add Book
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
                // preview.src = 'https://placehold.co/300x450';
                preview.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const preview = document.getElementById('image_preview');
            preview.src = 'https://placehold.co/170x320';
            preview.classList.remove('hidden');
        });
    </script>
</x-app-layout>
