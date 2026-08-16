<div class="prose max-w-none p-4 bg-white dark:bg-gray-800 rounded-lg">
    <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $data['title'] ?? 'Untitled' }}</h1>
    <div class="text-gray-700 dark:text-gray-300">
        {!! $data['content'] ?? '' !!}
    </div>
</div>
