<section class="space-y-4">
    <header class="border-b border-rose-100 pb-4">
        <h3 class="text-lg font-extrabold text-rose-600 tracking-tight">
            {{ __('Hapus Akun') }}
        </h3>
        <p class="text-xs text-slate-500 mt-1">
            {{ __('Setelah akun dihapus, semua data dan sumber daya terkait akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data yang ingin Anda simpan.') }}
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-2.5 bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs rounded-xl shadow-md shadow-rose-500/20 transition active:scale-95">
        {{ __('Hapus Akun') }}
    </button>
</section>
