<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Post</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ route('posts.update', $post) }}" method="POST" class="bg-white p-4 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Caption</label>
                <textarea name="caption" rows="3" class="w-full border rounded p-2">{{ old('caption', $post->caption) }}</textarea>
                @error('caption')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
