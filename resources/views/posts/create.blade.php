<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buat Post</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Caption</label>
                <textarea name="caption" rows="3" class="w-full border rounded p-2">{{ old('caption') }}</textarea>
                @error('caption')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Gambar (opsional)</label>
                <input type="file" name="image" accept="image/jpeg,image/png" class="w-full border rounded p-2">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                @error('image')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
