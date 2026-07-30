<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Post</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Caption</label>
                <textarea name="caption" rows="3" class="w-full border rounded p-2">{{ old('caption', $post->caption) }}</textarea>
                @error('caption')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            @if ($post->image)
                <div>
                    <label class="block font-medium mb-1">Gambar saat ini</label>
                    <img src="{{ Storage::url($post->image) }}" alt="Post image" class="w-40 rounded border">
                </div>
            @endif

            <div>
                <label class="block font-medium">Ganti Gambar (opsional)</label>
                <input type="file" name="image" accept="image/jpeg,image/png" class="w-full border rounded p-2">
                <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak ingin mengganti gambar. Maksimal 2MB.</p>
                @error('image')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
