<section>
    <header class="mb-6 border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">
                {{ __('Informasi Profil') }}
            </h3>
            <p class="text-xs text-slate-500 mt-1">
                {{ __('Informasi identitas akun dan alamat email kamu.') }}
            </p>
        </div>

        <!-- Tombol untuk membuka Modal Popup Edit -->
        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-profile-info')"
            class="px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold text-xs rounded-xl transition flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            {{ __('Edit Profil') }}
        </button>
    </header>

    <!-- Tampilan Informasi Profil (Read-Only) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-100">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ __('Nama') }}</p>
            <p class="text-sm font-extrabold text-slate-800 mt-0.5">{{ $user->name }}</p>
        </div>

        <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-100">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ __('Email') }}</p>
            <p class="text-sm font-extrabold text-slate-800 mt-0.5">{{ $user->email }}</p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="mt-4 p-3 rounded-2xl bg-emerald-50 border border-emerald-100 text-xs font-bold text-emerald-600 flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
            {{ __('Informasi profil berhasil diperbarui.') }}
        </div>
    @endif

    <!-- Form Tersembunyi untuk Verifikasi Email -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
</section>
