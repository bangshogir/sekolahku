<x-slot name="page-title">Profil Sekolah</x-slot>

<div class="animate-fade-in max-w-4xl">
    <div class="page-header">
        <div>
            <h1 class="page-title">Profil Sekolah</h1>
            <p class="page-subtitle">Kelola informasi dan identitas madrasah yang tampil di website</p>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Identitas Utama --}}
            <div class="lg:col-span-2 space-y-5">
                <div class="card p-5">
                    <h3 class="font-bold text-slate-800 mb-4 pb-3 border-b border-slate-100">Identitas Madrasah</h3>
                    <div class="space-y-4">
                        <div class="form-group mb-0">
                            <label class="form-label">Nama Madrasah <span class="text-red-500">*</span></label>
                            <input wire:model="school_name" type="text" class="form-input @error('school_name') border-red-400 @enderror" placeholder="Contoh: MTsN 1 Kota Bandung">
                            @error('school_name') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">Tagline / Motto</label>
                            <input wire:model="school_tagline" type="text" class="form-input" placeholder="Contoh: Berilmu, Berakhlak, Berprestasi">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group mb-0">
                                <label class="form-label">Akreditasi</label>
                                <input wire:model="accreditation" type="text" class="form-input" placeholder="A / B / C">
                            </div>
                            <div class="form-group mb-0">
                                <label class="form-label">Tahun Berdiri</label>
                                <input wire:model="established_year" type="number" class="form-input" placeholder="1985">
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">Tentang Madrasah</label>
                            <textarea wire:model="about_text" rows="4" class="form-input" placeholder="Deskripsi singkat tentang madrasah untuk ditampilkan di halaman publik..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="card p-5">
                    <h3 class="font-bold text-slate-800 mb-4 pb-3 border-b border-slate-100">Kontak & Lokasi</h3>
                    <div class="space-y-4">
                        <div class="form-group mb-0">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea wire:model="school_address" rows="2" class="form-input" placeholder="Jl. Nama Jalan No. X, Kecamatan, Kab/Kota"></textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-group mb-0">
                                <label class="form-label">Nomor Telepon</label>
                                <input wire:model="school_phone" type="text" class="form-input" placeholder="(0xxx) xxx-xxxx">
                            </div>
                            <div class="form-group mb-0">
                                <label class="form-label">Email Resmi</label>
                                <input wire:model="school_email" type="email" class="form-input @error('school_email') border-red-400 @enderror" placeholder="info@madrasah.sch.id">
                                @error('school_email') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">Website</label>
                            <input wire:model="school_website" type="text" class="form-input" placeholder="www.madrasah.sch.id">
                        </div>
                    </div>
                </div>

                <div class="card p-5">
                    <h3 class="font-bold text-slate-800 mb-4 pb-3 border-b border-slate-100">Media Sosial</h3>
                    <div class="space-y-4">
                        <div class="form-group mb-0">
                            <label class="form-label">Facebook URL</label>
                            <input wire:model="facebook_url" type="url" class="form-input @error('facebook_url') border-red-400 @enderror" placeholder="https://facebook.com/namahalaman">
                            @error('facebook_url') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">Instagram URL</label>
                            <input wire:model="instagram_url" type="url" class="form-input @error('instagram_url') border-red-400 @enderror" placeholder="https://instagram.com/namaakun">
                            @error('instagram_url') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label">YouTube URL</label>
                            <input wire:model="youtube_url" type="url" class="form-input @error('youtube_url') border-red-400 @enderror" placeholder="https://youtube.com/@channel">
                            @error('youtube_url') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Kepala Madrasah --}}
                <div class="card p-5">
                    <h3 class="font-bold text-slate-800 mb-4 pb-3 border-b border-slate-100">Profil Kepala Madrasah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2 space-y-4">
                            <div class="form-group mb-0">
                                <label class="form-label">Nama Kepala Madrasah</label>
                                <input wire:model="principal_name" type="text" class="form-input" placeholder="Nama lengkap + gelar">
                            </div>
                            <div class="form-group mb-0">
                                <label class="form-label">Pesan / Sambutan</label>
                                <textarea wire:model="principal_message" rows="5" class="form-input" placeholder="Assalamualaikum wr wb..."></textarea>
                            </div>
                        </div>
                        <div>
                            <label class="form-label mb-2 block text-center">Foto Kepala Madrasah</label>
                            <div class="text-center mb-3">
                                @if($principal_photo)
                                    <img src="{{ $principal_photo->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover mx-auto border-2 border-slate-200 p-0.5">
                                @elseif($existingPrincipalPhoto)
                                    <img src="{{ asset('storage/' . $existingPrincipalPhoto) }}" class="w-24 h-24 rounded-full object-cover mx-auto border-2 border-slate-200 p-0.5">
                                @else
                                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center text-white text-2xl font-bold" style="background:linear-gradient(135deg,#006227,#009494);">
                                        {{ strtoupper(substr($principal_name ?: 'KM', 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <label for="principal_upload" class="drop-zone cursor-pointer block !p-3">
                                <input id="principal_upload" type="file" wire:model="principal_photo" class="sr-only" accept="image/*">
                                <p class="text-xs font-medium text-slate-600">Ganti Foto</p>
                            </label>
                            <div wire:loading wire:target="principal_photo" class="text-center mt-2 text-xs text-slate-500 animate-pulse w-full">Mengupload...</div>
                            @error('principal_photo') <p class="form-error mt-2 text-center">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logo Upload --}}
            <div class="space-y-5">
                <div class="card p-5">
                    <h3 class="font-bold text-slate-800 mb-4">Logo Madrasah</h3>
                    <div class="text-center mb-4">
                        @if($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="w-28 h-28 rounded-2xl object-contain mx-auto border border-slate-200 p-2 bg-white">
                        @elseif($existingLogo)
                            <img src="{{ asset('storage/' . $existingLogo) }}" class="w-28 h-28 rounded-2xl object-contain mx-auto border border-slate-200 p-2 bg-white">
                        @else
                            <div class="w-28 h-28 rounded-2xl mx-auto flex items-center justify-center" style="background:linear-gradient(135deg,#006227,#009494);">
                                <svg class="w-12 h-12" fill="#FFD700" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            </div>
                        @endif
                    </div>
                    <label for="logo_upload" class="drop-zone cursor-pointer block">
                        <input id="logo_upload" type="file" wire:model="logo" class="sr-only" accept="image/*">
                        <svg class="w-6 h-6 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        <p class="text-xs font-medium text-slate-600">Klik untuk Ganti Logo</p>
                        <p class="text-xs text-slate-400 mt-1">PNG (maks. 1MB)</p>
                    </label>
                    <div wire:loading wire:target="logo" class="text-center mt-2 text-xs text-slate-500 animate-pulse w-full">Mengupload...</div>
                    @error('logo') <p class="form-error mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                {{-- Hero Background Upload --}}
                <div class="card p-5">
                    <h3 class="font-bold text-slate-800 mb-4">Background Hero</h3>
                    <div class="text-center mb-4">
                        @if($hero_background)
                            <img src="{{ $hero_background->temporaryUrl() }}" class="w-full h-24 rounded-2xl object-cover mx-auto border border-slate-200 p-1 bg-white">
                        @elseif($existingHeroBackground)
                            <img src="{{ asset('storage/' . $existingHeroBackground) }}" class="w-full h-24 rounded-2xl object-cover mx-auto border border-slate-200 p-1 bg-white">
                        @else
                            <div class="w-full h-24 rounded-2xl mx-auto flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                                <svg class="w-8 h-8 opacity-40" stroke="#006227" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <label for="hero_upload" class="drop-zone cursor-pointer block">
                        <input id="hero_upload" type="file" wire:model="hero_background" class="sr-only" accept="image/*">
                        <svg class="w-6 h-6 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        <p class="text-xs font-medium text-slate-600">Klik untuk Ganti Foto</p>
                        <p class="text-xs text-slate-400 mt-1">JPG/PNG (maks. 2MB)</p>
                    </label>
                    <div wire:loading wire:target="hero_background" class="text-center mt-2 text-xs text-slate-500 animate-pulse w-full">Mengupload...</div>
                    @error('hero_background') <p class="form-error mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3">
                    <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>
        </div>
    </form>
</div>
