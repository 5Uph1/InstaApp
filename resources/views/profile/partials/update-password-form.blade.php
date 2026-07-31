<section>
    <header class="mb-6 border-b border-slate-100 pb-4">
        <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">
            {{ __('Pembaruan Password') }}
        </h3>
        <p class="text-xs text-slate-500 mt-1">
            {{ __('Pastikan akun kamu menggunakan password yang kuat dan acak untuk menjaga keamanan.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password"
                class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Password Saat Ini') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password" placeholder="••••••••"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password"
                class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Password Baru') }}
            </label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                placeholder="••••••••"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation"
                class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Konfirmasi Password Baru') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" placeholder="••••••••"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-xs rounded-xl shadow-md shadow-purple-500/20 transition active:scale-95">
                {{ __('Perbarui Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                    class="text-xs font-bold text-emerald-600 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Password berhasil diubah.') }}
                </p>
            @endif
        </div>
    </form>
</section>
