<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div
                class="p-2.5 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 text-white shadow-md shadow-purple-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Pengaturan Profil</h2>
                <p class="text-xs text-slate-500">Kelola informasi akun, kata sandi, dan keamanan kamu</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 space-y-6">
        <!-- Informasi Profil -->
        <div
            class="bg-white/90 backdrop-blur-sm border border-purple-100/80 rounded-3xl p-6 sm:p-8 shadow-xl shadow-purple-500/5">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Ubah Password -->
        <div
            class="bg-white/90 backdrop-blur-sm border border-purple-100/80 rounded-3xl p-6 sm:p-8 shadow-xl shadow-purple-500/5">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Hapus Akun -->
        <div
            class="bg-white/90 backdrop-blur-sm border border-rose-100/80 rounded-3xl p-6 sm:p-8 shadow-xl shadow-rose-500/5">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <!-- Modal Popup Edit Profil -->
    <x-modal name="edit-profile-info" :show="$errors->hasBag('default') && $errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.update') }}" class="p-6 space-y-4">
            @csrf
            @method('patch')

            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">
                    {{ __('Edit Informasi Profil') }}
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    {{ __('Ubah nama dan alamat email akun kamu di bawah ini.') }}
                </p>
            </div>

            <!-- Input Nama -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    {{ __('Nama') }}
                </label>
                <input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus
                    autocomplete="name"
                    class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
                <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
            </div>

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    {{ __('Email') }}
                </label>
                <input id="email" name="email" type="email" :value="old('email', $user->email)" required
                    autocomplete="username"
                    class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150" />
                <x-input-error class="mt-1.5" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs">
                        <p class="text-amber-800 font-medium">
                            {{ __('Alamat email kamu belum diverifikasi.') }}
                            <button form="send-verification"
                                class="underline font-bold hover:text-amber-900 ms-1 transition">
                                {{ __('Kirim ulang email verifikasi.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-bold text-emerald-600">
                                {{ __('Link verifikasi baru telah dikirimkan ke email kamu.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="pt-2 flex justify-end gap-2.5">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                    {{ __('Batal') }}
                </button>

                <button type="submit"
                    class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-95 text-white font-bold text-xs rounded-xl shadow-md shadow-purple-500/20 transition active:scale-95">
                    {{ __('Simpan Perubahan') }}
                </button>
            </div>
        </form>
    </x-modal>

    <!-- Modal Popup Hapus Akun -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h3>

            <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                {{ __('Setelah akun dihapus, seluruh data akan hilang secara permanen. Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun ini secara permanen.') }}
            </p>

            <div class="mt-4">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" placeholder="{{ __('Password Anda') }}"
                    class="w-full text-sm border-slate-200 bg-slate-50/50 rounded-2xl p-3 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition duration-150" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                    {{ __('Batal') }}
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-md shadow-rose-500/20 transition">
                    {{ __('Hapus Akun Permanen') }}
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
