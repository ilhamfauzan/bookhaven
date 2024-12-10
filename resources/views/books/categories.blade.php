<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">Book Category</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        @foreach($books->unique('category') as $book)
        <button 
    class="bg-white text-grey py-2 px-6 rounded-full shadow-lg transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    onclick="scrollToCategory('{{ $book->category }}')">
    {{ Str::limit($book->category, 13) }}
</button>
        @endforeach
    </div>
</div>

<script>
    function scrollToCategory(category) {
        const element = document.getElementById(category);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
</script>