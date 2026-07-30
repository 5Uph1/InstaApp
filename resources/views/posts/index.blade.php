<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Feed</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto space-y-4">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('posts.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
            + Buat Post
        </a>

        @forelse ($posts as $post)
            <div class="bg-white shadow rounded p-4">
                <div class="text-sm text-gray-500">
                    {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                </div>

                @if ($post->image)
                    <img src="{{ Storage::url($post->image) }}" alt="Post image"
                        class="mt-2 rounded max-h-96 w-full object-cover">
                @endif

                <p class="mt-2">{{ $post->caption }}</p>

                <div class="mt-3 text-sm text-gray-600 flex gap-4">
                    @if ($post->likes->contains('user_id', auth()->id()))
                        <form action="{{ route('posts.unlike', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 font-medium">
                                ❤️ {{ $post->likes_count }} Batal Suka
                            </button>
                        </form>
                    @else
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600">
                                🤍 {{ $post->likes_count }} Suka
                            </button>
                        </form>
                    @endif
                    <span>{{ $post->comments_count }} Komentar</span>
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600">Detail</a>

                    @if ($post->user_id === auth()->id())
                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-600">Edit</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus post ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada post.</p>
        @endforelse

        {{ $posts->links() }}
    </div>
</x-app-layout>
