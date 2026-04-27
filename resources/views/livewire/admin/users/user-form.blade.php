<x-slot name="page-title">{{ $isEditing ? 'Edit User' : 'Tambah User' }}</x-slot>

<div class="animate-fade-in max-w-lg">
    <div class="page-header">
        <div><h1 class="page-title">{{ $isEditing ? 'Edit User' : 'Tambah User Baru' }}</h1></div>
        <a href="{{ route('admin.users.index') }}" class="btn-ghost">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="save">
        <div class="card p-6 space-y-4">
            <div class="form-group mb-0">
                <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                <input wire:model="name" type="text" class="form-input @error('name') border-red-400 @enderror" placeholder="Nama lengkap">
                @error('name') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Email <span class="text-red-500">*</span></label>
                <input wire:model="email" type="email" class="form-input @error('email') border-red-400 @enderror" placeholder="email@contoh.com">
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">
                    Password {{ $isEditing ? '(kosongkan jika tidak ingin diubah)' : '' }}
                    @if(!$isEditing)<span class="text-red-500">*</span>@endif
                </label>
                <input wire:model="password" type="password" class="form-input @error('password') border-red-400 @enderror" placeholder="{{ $isEditing ? '••••••••' : 'Min. 8 karakter' }}">
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Role</label>
                <select wire:model="role" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3 mt-2">
                <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui User' : 'Tambah User' }}</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>
