<x-guest-layout>
    <div class="mb-6 text-center">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Lupa Password?</h3>
        <p class="text-xs text-slate-500 mt-1 max-w-xs mx-auto">
            Masukkan email kamu dan kami akan mengirimkan link untuk mereset password.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Email') }}
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                placeholder="nama@email.com"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-sm rounded-2xl shadow-md shadow-purple-500/20 transition active:scale-98">
                {{ __('Kirim Link Reset Password') }}
            </button>
        </div>

        <div class="text-center pt-4 border-t border-slate-100">
            <a href="{{ route('login') }}" class="text-xs font-bold text-slate-600 hover:text-purple-600 transition">
                &larr; Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
