<x-slot name="page-title">{{ $isEditing ? 'Edit Infrastruktur' : 'Tambah Infrastruktur' }}</x-slot>

<div class="animate-fade-in max-w-2xl">
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $isEditing ? 'Edit Data Infrastruktur' : 'Tambah Infrastruktur' }}</h1>
        </div>
        <a href="{{ route('admin.infrastructures.index') }}" class="btn-ghost">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="save" class="space-y-5">
        <div class="card p-5 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="form-group mb-0">
                    <label class="form-label">Nama Fasilitas <span class="text-red-500">*</span></label>
                    <input wire:model="name" type="text" class="form-input @error('name') border-red-400 @enderror" placeholder="Contoh: Laboratorium IPA">
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group mb-0">
                    <label class="form-label">Jumlah Unit <span class="text-red-500">*</span></label>
                    <input wire:model="quantity" type="number" min="1" class="form-input @error('quantity') border-red-400 @enderror">
                    @error('quantity') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Kondisi <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-3 gap-3 mt-1">
                    @foreach(['baik' => ['label' => 'Baik', 'color' => '#15803d', 'bg' => '#dcfce7'], 'rusak_ringan' => ['label' => 'Rusak Ringan', 'color' => '#a16207', 'bg' => '#fef9c3'], 'rusak_berat' => ['label' => 'Rusak Berat', 'color' => '#dc2626', 'bg' => '#fee2e2']] as $val => $opt)
                    <label class="relative cursor-pointer">
                        <input type="radio" wire:model="condition" value="{{ $val }}" class="sr-only peer">
                        <div class="p-3 rounded-xl border-2 text-center text-sm font-semibold transition-all peer-checked:border-current"
                             style="border-color:#e2e8f0; color:{{ $opt['color'] }};"
                             :style="'{{ $condition === $val ? 'background-color:' . $opt['bg'] . '; border-color:' . $opt['color'] : '' }}'">
                            {{ $opt['label'] }}
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('condition') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Deskripsi</label>
                <textarea wire:model="description" rows="3" class="form-input" placeholder="Deskripsi singkat fasilitas..."></textarea>
            </div>
        </div>

        <div class="card p-5">
            <h3 class="font-semibold text-slate-800 mb-4">Foto Fasilitas</h3>
            @if($photo)
                <img src="{{ $photo->temporaryUrl() }}" class="image-preview mb-3">
            @elseif($existingPhoto)
                <img src="{{ asset('storage/' . $existingPhoto) }}" class="image-preview mb-3">
            @endif
            <label for="infra_photo" class="drop-zone cursor-pointer">
                <input id="infra_photo" type="file" wire:model="photo" class="sr-only" accept="image/*">
                <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                <p class="text-sm font-medium text-slate-600">Klik untuk upload foto</p>
                <p class="text-xs text-slate-400 mt-1">PNG, JPG (maks. 2MB)</p>
            </label>
            <div wire:loading wire:target="photo" class="text-center mt-2 text-sm text-slate-500 animate-pulse">Mengupload...</div>
            @error('photo') <p class="form-error mt-2">{{ $message }}</p> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3">
            <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
            <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui Data' : 'Simpan Data' }}</span>
            <span wire:loading wire:target="save">Menyimpan...</span>
        </button>
    </form>
</div>
