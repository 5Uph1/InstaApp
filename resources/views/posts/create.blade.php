<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Buat Post Baru</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto px-4">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white/90 backdrop-blur-sm p-6 sm:p-8 rounded-3xl border border-purple-100/80 shadow-xl shadow-purple-500/5 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Caption</label>
                <textarea name="caption" rows="4" placeholder="Apa yang ingin kamu bagikan hari ini?"
                    class="w-full border-slate-200 bg-slate-50/50 rounded-2xl p-3.5 text-sm focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">{{ old('caption') }}</textarea>
                @error('caption')
                    <p class="text-rose-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Gambar <span
                        class="text-slate-400 font-normal">(opsional)</span></label>
                <div
                    class="p-3 bg-slate-50/50 border border-dashed border-slate-300 rounded-2xl hover:border-purple-400 transition">
                    <input type="file" name="image" accept="image/jpeg,image/png"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 cursor-pointer">
                </div>
                <p class="text-[11px] text-slate-400 mt-2">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</p>
                @error('image')
                    <p class="text-rose-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2 flex items-center justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('posts.index') }}"
                    class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 transition">Batal</a>
                <button type="submit"
                    class="bg-gradient-to-r from-rose-500 via-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-sm px-6 py-2.5 rounded-xl shadow-md shadow-purple-500/20 transition active:scale-95">
                    Publikasikan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
