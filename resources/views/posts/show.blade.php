<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Post</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto bg-white p-4 rounded shadow">
        <div class="text-sm text-gray-500">
            {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
        </div>

        @if ($post->image)
            <img src="{{ Storage::url($post->image) }}" alt="Post image" class="mt-2 rounded w-full">
        @endif

        <p class="mt-2">{{ $post->caption }}</p>

        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="comment" rows="2" class="w-full rounded-md border-gray-300" placeholder="Tulis komentar...">{{ old('comment') }}</textarea>
            @error('comment')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="mt-2 px-4 py-1 bg-indigo-600 text-white rounded-md text-sm">Kirim</button>
        </form>

        <div class="mt-4 space-y-3">
            @forelse ($post->comments()->latest()->with('user')->get() as $comment)
                <div class="flex justify-between items-start border-b pb-2">
                    <div>
                        <p class="text-sm font-semibold">{{ $comment->user->name }}</p>
                        <p class="text-sm text-gray-700">{{ $comment->comment }}</p>
                    </div>
                    @if ($comment->user_id === request()->user()->id)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600">Hapus</button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="text-sm text-gray-400">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>

</x-app-layout>
