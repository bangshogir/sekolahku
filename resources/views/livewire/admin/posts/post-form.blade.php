<x-slot name="page-title">{{ $isEditing ? 'Edit Berita' : 'Tambah Berita' }}</x-slot>

<div class="animate-fade-in max-w-5xl">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $isEditing ? 'Edit Berita' : 'Tambah Berita' }}</h1>
            <p class="page-subtitle">{{ $isEditing ? 'Perbarui konten berita yang ada' : 'Tulis berita atau pengumuman baru' }}</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn-ghost">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Judul --}}
                <div class="card p-5">
                    <div class="form-group">
                        <label class="form-label">Judul Berita <span class="text-red-500">*</span></label>
                        <input wire:model.live="title" type="text" class="form-input @error('title') border-red-400 @enderror"
                            placeholder="Masukkan judul berita...">
                        @error('title') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-group mb-0">
                        <label class="form-label">Slug URL</label>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-400 flex-shrink-0">/berita/</span>
                            <input wire:model="slug" type="text" class="form-input text-sm @error('slug') border-red-400 @enderror"
                                placeholder="judul-berita-anda">
                        </div>
                        @error('slug') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Excerpt --}}
                <div class="card p-5">
                    <div class="form-group mb-0">
                        <label class="form-label">Ringkasan (Excerpt)</label>
                        <textarea wire:model="excerpt" rows="3" class="form-input @error('excerpt') border-red-400 @enderror"
                            placeholder="Deskripsi singkat berita untuk pratinjau..."></textarea>
                        @error('excerpt') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Content (Quill) --}}
                <div class="card p-5">
                    <label class="form-label mb-3 block">Konten Berita <span class="text-red-500">*</span></label>
                    @error('content') <p class="form-error mb-2">{{ $message }}</p> @enderror

                    {{-- Quill Editor --}}
                    <div
                        wire:ignore
                        x-data="{
                            quill: null,
                            init() {
                                this.quill = new Quill(this.$refs.editor, {
                                    theme: 'snow',
                                    placeholder: 'Tulis konten berita di sini...',
                                    modules: {
                                        toolbar: [
                                            [{ header: [1, 2, 3, false] }],
                                            ['bold', 'italic', 'underline'],
                                            ['link', 'blockquote'],
                                            [{ list: 'ordered' }, { list: 'bullet' }],
                                            ['clean']
                                        ]
                                    }
                                });

                                // Set initial content saat edit
                                @if($isEditing)
                                    this.quill.root.innerHTML = @js($content);
                                @endif

                                // Sync ke Livewire saat berubah
                                this.quill.on('text-change', () => {
                                    $wire.updateContent(this.quill.root.innerHTML);
                                });
                            }
                        }"
                    >
                        <div x-ref="editor" style="min-height:250px;"></div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">

                {{-- Publish Options --}}
                <div class="card p-5">
                    <h3 class="font-semibold text-slate-800 mb-4">Pengaturan Publikasi</h3>

                    {{-- Status --}}
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <label class="flex items-center gap-3 cursor-pointer p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div class="relative">
                                <input type="checkbox" wire:model="is_published" class="sr-only peer">
                                <div class="w-10 h-6 rounded-full transition-colors peer-checked:bg-green-600 bg-slate-200"></div>
                                <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
                            </div>
                            <span class="text-sm font-medium text-slate-700">
                                {{ $is_published ? 'Dipublish' : 'Simpan sebagai Draft' }}
                            </span>
                        </label>
                    </div>

                    {{-- Category --}}
                    <div class="form-group mb-0">
                        <label class="form-label">Kategori</label>
                        <select wire:model="category" class="form-select">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="card p-5">
                    <h3 class="font-semibold text-slate-800 mb-4">Foto Utama</h3>

                    {{-- Preview --}}
                    @if($featured_image)
                        <img src="{{ $featured_image->temporaryUrl() }}" class="image-preview mb-3">
                    @elseif($existingImage)
                        <img src="{{ asset('storage/' . $existingImage) }}" class="image-preview mb-3">
                    @endif

                    <label for="featured_image" class="drop-zone cursor-pointer">
                        <input id="featured_image" type="file" wire:model="featured_image" class="sr-only" accept="image/*">
                        <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                        </svg>
                        <p class="text-sm font-medium text-slate-600">Klik untuk upload foto</p>
                        <p class="text-xs text-slate-400 mt-1">PNG, JPG, GIF (maks. 2MB)</p>
                    </label>

                    <div wire:loading wire:target="featured_image" class="text-center mt-2 text-sm text-slate-500">
                        <span class="animate-pulse">Mengupload...</span>
                    </div>
                    @error('featured_image') <p class="form-error mt-2">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" wire:loading.attr="disabled" class="btn-primary w-full justify-center py-3">
                    <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="save">
                        {{ $isEditing ? 'Perbarui Berita' : 'Simpan Berita' }}
                    </span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Quill.js CDN --}}
@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
@endpush
