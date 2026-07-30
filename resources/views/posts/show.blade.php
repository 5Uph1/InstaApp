<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Post</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto bg-white p-4 rounded shadow">
        <div class="text-sm text-gray-500">
            {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
        </div>
        <p class="mt-2">{{ $post->caption }}</p>
    </div>
</x-app-layout>
