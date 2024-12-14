{{-- @if (session('success') || session('successRed'))
<div id="notification" class="fixed top-4 left-1/2 transform -translate-x-1/2 {{ session('success') ? 'bg-green-500' : 'bg-red-500' }} text-white px-4 py-2 rounded shadow-lg" style="animation: fadeOut 5s forwards; display: none;">
    <p>{{ session('success') ? session('success') : session('successRed') }}</p>
</div>

<style>
    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
</style>

<script>
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.display = 'block';
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
</script>
@endif --}}

@if(session('success'))
<div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
    <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif