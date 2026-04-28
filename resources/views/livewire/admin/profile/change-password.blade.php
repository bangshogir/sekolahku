<x-slot name="page-title">Ganti Password</x-slot>

<div class="animate-fade-in max-w-xl">
    <div class="page-header">
        <div>
            <h1 class="page-title">Ganti Password</h1>
            <p class="page-subtitle">Perbarui kata sandi akun profil Anda secara berkala untuk menjaga keamanan.</p>
        </div>
    </div>

    <form wire:submit="updatePassword">
        <div class="card p-6 space-y-5">
            {{-- Current Password --}}
            <div class="form-group mb-0">
                <label class="form-label">Password Saat Ini <span class="text-red-500">*</span></label>
                <input wire:model="current_password" type="password" class="form-input @error('current_password') border-red-400 @enderror" placeholder="Masukkan password lama Anda">
                @error('current_password') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <hr class="border-slate-100 my-2">

            {{-- New Password --}}
            <div class="form-group mb-0">
                <label class="form-label">Password Baru <span class="text-red-500">*</span></label>
                <div class="space-y-1">
                    <input wire:model="password" type="password" class="form-input @error('password') border-red-400 @enderror" placeholder="Min. 8 karakter">
                    <p class="text-xs text-slate-400">Gunakan kombinasi angka, huruf, dan simbol untuk keamanan ekstra.</p>
                </div>
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Confirm New Password --}}
            <div class="form-group mb-0">
                <label class="form-label">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                <input wire:model="password_confirmation" type="password" class="form-input" placeholder="Ulangi password baru">
            </div>

            <div class="pt-2">
                <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-2.5">
                    <svg wire:loading wire:target="updatePassword" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    <span wire:loading.remove wire:target="updatePassword">Simpan Password Baru</span>
                    <span wire:loading wire:target="updatePassword">Memvalidasi...</span>
                </button>
            </div>
        </div>
    </form>
</div>
