<div class="w-full max-w-md animate-fade-in">

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

        {{-- Header --}}
        <div class="px-8 pt-8 pb-6 text-center" style="background: linear-gradient(135deg, #006227, #007a7a);">
            @if(\App\Models\SchoolSetting::get('school_logo'))
                <img src="{{ asset('storage/' . \App\Models\SchoolSetting::get('school_logo')) }}" alt="Logo Madrasah" class="w-16 h-16 object-contain rounded-2xl mx-auto mb-4 bg-white p-1">
            @else
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background-color:rgba(255,215,0,0.2);">
                    <svg class="w-8 h-8" fill="#FFD700" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            @endif
            <h1 class="text-white text-xl font-bold">{{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}</h1>
            <p class="text-sm mt-1" style="color:rgba(255,255,255,0.7);">Panel Administrasi</p>
        </div>

        {{-- Form --}}
        <div class="p-8">
            <h2 class="text-slate-800 text-lg font-bold mb-1">Selamat Datang!</h2>
            <p class="text-slate-500 text-sm mb-6">Silakan masuk dengan akun admin Anda.</p>

            <form wire:submit="login" class="space-y-4">

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input
                            id="email"
                            type="email"
                            wire:model="email"
                            class="form-input @error('email') border-red-400 @enderror"
                            style="padding-left: 2.5rem;"
                            placeholder="admin@madrasah.sch.id"
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group" x-data="{ showPwd: false }">
                    <label for="password" class="form-label">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            id="password"
                            :type="showPwd ? 'text' : 'password'"
                            wire:model="password"
                            class="form-input @error('password') border-red-400 @enderror"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                        <button type="button" @click="showPwd = !showPwd" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                            <svg x-show="!showPwd" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPwd" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" wire:model="remember" class="w-4 h-4 rounded" style="accent-color:#006227;">
                        <span class="text-sm text-slate-600">Ingat saya</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="btn-primary w-full justify-center py-3 text-base mt-2"
                >
                    <svg wire:loading wire:target="login" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="login">Masuk</span>
                    <span wire:loading wire:target="login">Memproses...</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Back to home --}}
    <p class="text-center mt-6 text-sm" style="color:rgba(255,255,255,0.7);">
        <a href="{{ route('home') }}" class="text-white hover:underline font-medium">
            ← Kembali ke Website
        </a>
    </p>
</div>
