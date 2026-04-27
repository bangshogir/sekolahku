<x-slot name="page-title">{{ $isEditing ? 'Edit Ekskul' : 'Tambah Ekskul' }}</x-slot>

<div class="animate-fade-in max-w-2xl">
    <div class="page-header">
        <div><h1 class="page-title">{{ $isEditing ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}</h1></div>
        <a href="{{ route('admin.extracurriculars.index') }}" class="btn-ghost">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="save" class="space-y-5">
        <div class="card p-5 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="form-group mb-0">
                    <label class="form-label">Nama Ekskul <span class="text-red-500">*</span></label>
                    <input wire:model="name" type="text" class="form-input @error('name') border-red-400 @enderror" placeholder="Contoh: Pramuka">
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group mb-0">
                    <label class="form-label">Pembina <span class="text-red-500">*</span></label>
                    <input wire:model="supervisor" type="text" class="form-input @error('supervisor') border-red-400 @enderror" placeholder="Nama pembina ekskul">
                    @error('supervisor') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Jadwal Kegiatan <span class="text-red-500">*</span></label>
                <input wire:model="schedule" type="text" class="form-input @error('schedule') border-red-400 @enderror" placeholder="Contoh: Sabtu, 14.00 - 16.00 WIB">
                @error('schedule') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Deskripsi</label>
                <textarea wire:model="description" rows="3" class="form-input" placeholder="Deskripsi singkat ekskul..."></textarea>
            </div>
            <div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" wire:model="is_active" class="sr-only peer">
                        <div class="w-10 h-6 rounded-full transition-colors peer-checked:bg-green-600 bg-slate-200"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
                    </div>
                    <span class="text-sm font-medium text-slate-700">{{ $is_active ? 'Ekskul Aktif' : 'Ekskul Nonaktif' }}</span>
                </label>
            </div>
        </div>

        <div class="card p-5">
            <h3 class="font-semibold text-slate-800 mb-4">Foto Ekskul</h3>
            @if($photo) <img src="{{ $photo->temporaryUrl() }}" class="image-preview mb-3"> @elseif($existingPhoto) <img src="{{ asset('storage/' . $existingPhoto) }}" class="image-preview mb-3"> @endif
            <label for="ekskul_photo" class="drop-zone cursor-pointer">
                <input id="ekskul_photo" type="file" wire:model="photo" class="sr-only" accept="image/*">
                <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                <p class="text-sm font-medium text-slate-600">Klik untuk upload foto</p>
            </label>
            @error('photo') <p class="form-error mt-2">{{ $message }}</p> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3">
            <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui Data' : 'Simpan Data' }}</span>
            <span wire:loading wire:target="save">Menyimpan...</span>
        </button>
    </form>
</div>
