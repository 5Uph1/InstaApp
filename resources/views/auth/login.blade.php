<x-guest-layout>
    <div class="mb-6 text-center">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali!</h3>
        <p class="text-xs text-slate-500 mt-1">Masuk ke akun kamu untuk melihat pembaruan terbaru</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Email') }}
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" placeholder="nama@email.com"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                placeholder="••••••••"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded-md border-slate-300 text-purple-600 shadow-xs focus:ring-purple-500">
                <span class="ms-2 font-medium text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="font-semibold text-purple-600 hover:text-purple-800 transition"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-rose-500 via-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-sm rounded-2xl shadow-md shadow-purple-500/20 transition active:scale-98">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Footer / Register Link -->
        <div class="text-center pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-purple-600 hover:text-purple-800 transition">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
