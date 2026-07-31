<x-guest-layout>
    <div class="mb-6 text-center">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Buat Akun Baru</h3>
        <p class="text-xs text-slate-500 mt-1">Bergabunglah dan bagikan momen menarik kamu</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Nama Lengkap') }}
            </label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" placeholder="John Doe"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Email') }}
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="nama@email.com"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                placeholder="••••••••"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation"
                class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                {{ __('Konfirmasi Password') }}
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="••••••••"
                class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-rose-500 via-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-sm rounded-2xl shadow-md shadow-purple-500/20 transition active:scale-98">
                {{ __('Register') }}
            </button>
        </div>

        <!-- Footer / Login Link -->
        <div class="text-center pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-purple-600 hover:text-purple-800 transition">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
