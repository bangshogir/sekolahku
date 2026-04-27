<x-slot name="page-title">Visi & Misi</x-slot>

<div class="animate-fade-in max-w-4xl mx-auto">
    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Visi & Misi Madrasah</h1>
            <p class="page-subtitle">Kelola penjabaran visi, misi, dan tujuan madrasah</p>
        </div>
    </div>

    <form wire:submit="save">
        <div class="card p-5 shadow-sm space-y-5">

            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-semibold text-slate-800">Konten Halaman</h3>
                <a href="{{ route('vision-mission') }}" target="_blank" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center gap-1">
                    Lihat Publikasinya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>

            {{-- Content (Quill) --}}
            <div>
                @error('visionMissionContent') <p class="form-error mb-2">{{ $message }}</p> @enderror

                {{-- Quill Editor --}}
                <div
                    wire:ignore
                    class="rounded-xl border border-slate-200 overflow-hidden"
                    x-data="{
                        quill: null,
                        init() {
                            this.quill = new Quill(this.$refs.editor, {
                                theme: 'snow',
                                placeholder: 'Tuliskan daftar Visi dan Misi madrasah di sini...',
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

                            // Set initial content
                            this.quill.root.innerHTML = @js($visionMissionContent);

                            // Sync ke Livewire saat berubah
                            this.quill.on('text-change', () => {
                                $wire.set('visionMissionContent', this.quill.root.innerHTML);
                            });
                        }
                    }"
                >
                    <div x-ref="editor" style="min-height:400px; border:none; font-family:'Plus Jakarta Sans', sans-serif;"></div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" wire:loading.attr="disabled" class="btn-primary py-2.5 px-6">
                    <svg wire:loading wire:target="save" class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
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
    <style>
        .ql-toolbar.ql-snow { border: none !important; border-bottom: 1px solid #e2e8f0 !important; background-color: #f8fafc; }
        .ql-container.ql-snow { border: none !important; }
        .ql-editor { font-size: 15px; color: #334155; line-height: 1.7; padding: 20px; }
    </style>
@endpush
