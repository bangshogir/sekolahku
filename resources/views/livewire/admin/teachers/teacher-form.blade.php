<x-slot name="page-title">{{ $isEditing ? 'Edit Guru' : 'Tambah Guru' }}</x-slot>

<div class="animate-fade-in max-w-3xl">
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $isEditing ? 'Edit Data Guru' : 'Tambah Guru Baru' }}</h1>
        </div>
        <a href="{{ route('admin.teachers.index') }}" class="btn-ghost">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- Foto Guru --}}
            <div class="md:col-span-1">
                <div class="card p-5 text-center">
                    <h3 class="font-semibold text-slate-800 mb-4">Foto Guru</h3>
                    <div class="mb-4">
                        @if($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-32 rounded-full object-cover mx-auto">
                        @elseif($existingPhoto)
                            <img src="{{ asset('storage/' . $existingPhoto) }}" class="w-32 h-32 rounded-full object-cover mx-auto">
                        @else
                            <div class="w-32 h-32 rounded-full mx-auto flex items-center justify-center text-white text-3xl font-bold" style="background:linear-gradient(135deg,#006227,#009494);">
                                {{ $name ? strtoupper(substr($name, 0, 2)) : '?' }}
                            </div>
                        @endif
                    </div>
                    <label for="photo" class="btn-ghost cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pilih Foto
                    </label>
                    <input id="photo" type="file" wire:model="photo" class="sr-only" accept="image/*">
                    <div wire:loading wire:target="photo" class="text-xs text-slate-500 mt-2 animate-pulse">Mengupload...</div>
                    @error('photo') <p class="form-error mt-2">{{ $message }}</p> @enderror

                    {{-- Status Toggle --}}
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <label class="flex items-center justify-center gap-3 cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" wire:model="is_active" class="sr-only peer">
                                <div class="w-10 h-6 rounded-full transition-colors peer-checked:bg-green-600 bg-slate-200"></div>
                                <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
                            </div>
                            <span class="text-sm font-medium text-slate-700">{{ $is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Form Fields --}}
            <div class="md:col-span-2 space-y-4">
                <div class="card p-5 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="form-group mb-0">
                            <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input wire:model.live="name" type="text" class="form-input @error('name') border-red-400 @enderror" placeholder="Nama lengkap guru">
                            @error('name') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">NIP</label>
                            <input wire:model="nip" type="text" class="form-input @error('nip') border-red-400 @enderror" placeholder="Nomor Induk Pegawai">
                            @error('nip') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="form-group mb-0">
                            <label class="form-label">Jabatan <span class="text-red-500">*</span></label>
                            <select wire:model="position" class="form-select @error('position') border-red-400 @enderror">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos }}">{{ $pos }}</option>
                                @endforeach
                            </select>
                            @error('position') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">Mata Pelajaran</label>
                            <input wire:model="subject" type="text" class="form-input" placeholder="Contoh: Matematika, IPA">
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-label">Urutan Tampil</label>
                        <input wire:model="sort_order" type="number" min="0" class="form-input" placeholder="0">
                        <p class="text-xs text-slate-400 mt-1">Angka lebih kecil = tampil lebih awal</p>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-label">Bio / Tentang Guru</label>
                        <textarea wire:model="bio" rows="4" class="form-input" placeholder="Deskripsi singkat tentang guru..."></textarea>
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3">
                    <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Perbarui Data Guru' : 'Simpan Data Guru' }}</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>
        </div>
    </form>
</div>
