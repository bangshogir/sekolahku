<x-slot name="page-title">{{ $isEditing ? 'Edit Prestasi' : 'Tambah Prestasi' }}</x-slot>

<div class="animate-fade-in max-w-2xl">
    <div class="page-header">
        <div><h1 class="page-title">{{ $isEditing ? 'Edit Data Prestasi' : 'Tambah Prestasi Baru' }}</h1></div>
        <a href="{{ route('admin.achievements.index') }}" class="btn-ghost">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="save" class="space-y-5">
        <div class="card p-5 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="form-group mb-0">
                    <label class="form-label">Nama Prestasi <span class="text-red-500">*</span></label>
                    <input wire:model="name" type="text" class="form-input @error('name') border-red-400 @enderror" placeholder="Contoh: Juara 1, Juara Harapan 2">
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group mb-0">
                    <label class="form-label">Tahun <span class="text-red-500">*</span></label>
                    <input wire:model="year" type="number" min="2000" max="{{ date('Y') + 1 }}" class="form-input @error('year') border-red-400 @enderror">
                    @error('year') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Jenis Lomba / Kompetisi <span class="text-red-500">*</span></label>
                <input wire:model="competition_type" type="text" class="form-input @error('competition_type') border-red-400 @enderror" placeholder="Contoh: Olimpiade Matematika, MTQ Tilawah">
                @error('competition_type') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Tingkat Kompetisi <span class="text-red-500">*</span></label>
                <select wire:model="level" class="form-select @error('level') border-red-400 @enderror">
                    @foreach($levels as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('level') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Deskripsi Tambahan</label>
                <textarea wire:model="description" rows="3" class="form-input" placeholder="Keterangan tambahan tentang prestasi ini..."></textarea>
            </div>
        </div>

        <div class="card p-5">
            <h3 class="font-semibold text-slate-800 mb-4">Foto / Sertifikat</h3>
            @if($certificate_photo) <img src="{{ $certificate_photo->temporaryUrl() }}" class="image-preview mb-3"> @elseif($existingPhoto) <img src="{{ asset('storage/' . $existingPhoto) }}" class="image-preview mb-3"> @endif
            <label for="cert_photo" class="drop-zone cursor-pointer">
                <input id="cert_photo" type="file" wire:model="certificate_photo" class="sr-only" accept="image/*">
                <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                <p class="text-sm font-medium text-slate-600">Upload foto piala / sertifikat</p>
                <p class="text-xs text-slate-400 mt-1">PNG, JPG (maks. 3MB)</p>
            </label>
            @error('certificate_photo') <p class="form-error mt-2">{{ $message }}</p> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3">
            <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui Prestasi' : 'Simpan Prestasi' }}</span>
            <span wire:loading wire:target="save">Menyimpan...</span>
        </button>
    </form>
</div>
