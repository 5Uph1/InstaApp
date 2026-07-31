<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('posts.index') }}"
                class="p-2 rounded-xl bg-white border border-slate-200/80 text-slate-600 hover:text-purple-600 hover:border-purple-200 transition shadow-xs">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Detail Post</h2>
                <p class="text-xs text-slate-500">Lihat percakapan dan komentar</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto px-4">
        <div
            class="bg-white/90 backdrop-blur-sm border border-purple-100/80 rounded-3xl shadow-xl shadow-purple-500/5 overflow-hidden">

            <!-- User Header -->
            <div class="p-4 border-b border-slate-100 flex items-center gap-3">
                <div class="p-0.5 rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 shadow-sm">
                    <div class="w-9 h-9 rounded-full bg-white p-0.5">
                        <div
                            class="w-full h-full rounded-full bg-slate-800 text-white flex items-center justify-center font-bold text-xs uppercase">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900 leading-none">{{ $post->user->name }}</p>
                    <p class="text-[11px] font-medium text-slate-400 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Gambar -->
            @if ($post->image)
                <div class="bg-slate-900/5">
                    <img src="{{ Storage::url($post->image) }}" alt="Post image"
                        class="w-full max-h-[500px] object-cover">
                </div>
            @endif

            <!-- Section 1: Caption/Konten Post -->
            @if ($post->caption)
                <div class="p-5">
                    <p class="text-sm text-slate-800 leading-relaxed">
                        <span class="font-extrabold text-slate-900 me-1.5">{{ $post->user->name }}</span>
                        {{ $post->caption }}
                    </p>
                </div>
            @endif

            <!-- Section 2: Area Komentar (Dipisah dengan latar belakang & border) -->
            <div class="border-t border-slate-100 bg-slate-50/50 p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Komentar</h4>
                    <span class="text-xs font-semibold text-slate-500 bg-slate-200/60 px-2.5 py-0.5 rounded-full">
                        {{ $post->comments->count() }}
                    </span>
                </div>

                <!-- Daftar Komentar -->
                <div class="space-y-3 max-h-[400px] overflow-y-auto pr-1">
                    @forelse ($post->comments()->latest()->with('user')->get() as $comment)
                        <div
                            class="flex justify-between items-start bg-white border border-purple-100/60 p-3.5 rounded-2xl gap-3 shadow-2xs">
                            <div class="flex gap-2.5">
                                <div
                                    class="w-7 h-7 rounded-full bg-gradient-to-tr from-purple-600 to-indigo-600 text-white flex items-center justify-center font-bold text-xs uppercase shrink-0 shadow-xs">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                                <div class="text-sm">
                                    <p class="font-bold text-slate-900 leading-none mb-1">{{ $comment->user->name }}</p>
                                    <p class="text-slate-700 leading-snug">{{ $comment->comment }}</p>
                                </div>
                            </div>

                            @if ($comment->user_id === request()->user()->id)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-[11px] font-bold text-rose-500 hover:text-rose-700 bg-rose-50 px-2 py-0.5 rounded-md transition">Hapus</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-xs text-slate-400 italic">Belum ada komentar. Jadi yang pertama berkomentar!
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Section 3: Form Input Komentar (Nempel Paling Bawah) -->
            <div class="p-4 bg-white border-t border-slate-100">
                <form action="{{ route('comments.store', $post) }}" method="POST" class="space-y-2.5">
                    @csrf
                    <textarea name="comment" rows="2" placeholder="Tulis komentar kamu di sini..."
                        class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150 resize-none">{{ old('comment') }}</textarea>

                    @error('comment')
                        <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-xs rounded-xl shadow-md shadow-purple-500/20 transition active:scale-95">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
