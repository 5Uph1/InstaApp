<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Feed Utama</h2>
                <p class="text-xs text-slate-500">Lihat kabar dan cerita terbaru</p>
            </div>
            <a href="{{ route('posts.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 via-purple-600 to-indigo-600 hover:opacity-95 text-white text-sm font-bold px-4 py-2.5 rounded-xl shadow-md shadow-purple-500/20 transition active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Buat Post
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 space-y-6">

        @if (session('success'))
            <div
                class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200/80 text-emerald-800 text-sm px-4 py-3 rounded-2xl flex items-center gap-2.5 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @forelse ($posts as $post)
            <!-- Wrapper Post dengan Alpine State untuk Modal -->
            <div x-data="{ showDeleteModal: false }"
                class="bg-white/90 backdrop-blur-sm border border-purple-100/70 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-purple-500/5 transition duration-200 overflow-hidden relative">

                <!-- Header Card -->
                <div class="flex items-center justify-between p-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="p-0.5 rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 shadow-sm">
                            <div class="w-9 h-9 rounded-full bg-white p-0.5">
                                <div
                                    class="w-full h-full rounded-full bg-slate-800 text-white flex items-center justify-center font-bold text-xs uppercase">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 leading-none">{{ $post->user->name }}</p>
                            <p class="text-[11px] font-medium text-slate-400 mt-1">
                                {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @if ($post->user_id === auth()->id())
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('posts.edit', $post) }}"
                                class="text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200/60 px-3 py-1 rounded-lg transition">Edit</a>

                            <!-- Tombol Pemicu Modal -->
                            <button @click="showDeleteModal = true" type="button"
                                class="text-xs font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200/60 px-3 py-1 rounded-lg transition">
                                Hapus
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Gambar -->
                @if ($post->image)
                    <div class="bg-slate-900/5 relative overflow-hidden group">
                        <img src="{{ Storage::url($post->image) }}" alt="Post image"
                            class="max-h-[500px] w-full object-cover group-hover:scale-[1.01] transition duration-300">
                    </div>
                @endif

                <!-- Section Konten & Aksi -->
                <div class="p-5 space-y-3">

                    <!-- 1. Caption Postingan (Di Atas) -->
                    @if ($post->caption)
                        <p class="text-sm text-slate-800 leading-relaxed">
                            <span class="font-extrabold text-slate-900 me-1.5">{{ $post->user->name }}</span>
                            {{ $post->caption }}
                        </p>
                    @endif

                    <!-- 2. Tombol Aksi / Icon Like & Comment (Di Bawah) -->
                    <div class="flex items-center gap-5 text-sm font-semibold pt-1">
                        @if ($post->likes->contains('user_id', auth()->id()))
                            <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-2 text-rose-600 hover:opacity-80 transition group">
                                    <div class="p-2 rounded-full bg-rose-50 group-hover:scale-110 transition">
                                        <svg class="w-5 h-5 fill-current text-rose-600" viewBox="0 0 24 24">
                                            <path
                                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                        </svg>
                                    </div>
                                    <span>{{ $post->likes_count }}</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 text-slate-600 hover:text-rose-600 transition group">
                                    <div
                                        class="p-2 rounded-full bg-slate-100 group-hover:bg-rose-50 group-hover:text-rose-600 transition group-hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <span>{{ $post->likes_count }}</span>
                                </button>
                            </form>
                        @endif

                        <!-- Icon Komentar -->
                        <a href="{{ route('posts.show', $post) }}"
                            class="flex items-center gap-2 text-slate-600 hover:text-indigo-600 transition group">
                            <div
                                class="p-2 rounded-full bg-slate-100 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <span>{{ $post->comments_count }}</span>
                        </a>
                    </div>

                </div>

                <!-- MODAL KONFIRMASI HAPUS -->
                <template x-teleport="body">
                    <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs"
                        x-cloak>

                        <div @click.away="showDeleteModal = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="bg-white rounded-3xl p-6 max-w-sm w-full shadow-2xl border border-slate-100 text-center space-y-4">

                            <!-- Icon Peringatan -->
                            <div
                                class="w-14 h-14 rounded-2xl bg-rose-50 border border-rose-100 text-rose-500 mx-auto flex items-center justify-center">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900">Hapus Postingan?</h3>
                                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                                    Tindakan ini tidak dapat dibatalkan. Postingan akan dihapus secara permanen.
                                </p>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex items-center justify-center gap-3 pt-2">
                                <button @click="showDeleteModal = false" type="button"
                                    class="w-1/2 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition">
                                    Batal
                                </button>

                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="w-1/2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full py-2.5 px-4 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-md shadow-rose-500/20 transition active:scale-95">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        @empty
            <div class="bg-white/80 border border-purple-100 rounded-3xl p-10 text-center shadow-sm">
                <div
                    class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-rose-100 to-purple-100 text-purple-600 mx-auto flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-extrabold text-slate-800">Belum Ada Postingan</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-xs mx-auto">Jadilah pengguna pertama yang membagikan foto
                    atau cerita di platform ini!</p>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
