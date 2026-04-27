<x-slot name="page-title">Kelola Berita</x-slot>

<div class="animate-fade-in" x-data="{ deleteId: null, showModal: false }">

    {{-- Delete Confirmation Modal --}}
    <div x-show="showModal" class="modal-overlay" style="display:none;" x-transition>
        <div class="modal-box" @click.stop>
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Berita?</h3>
                <p class="text-slate-500 text-sm mb-6">Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="showModal = false" class="btn-ghost px-6">Batal</button>
                    <button wire:click="delete(deleteId)" @click="showModal = false" class="btn-danger px-6">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Kelola Berita</h1>
            <p class="page-subtitle">Buat dan kelola konten berita madrasah</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Berita
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="card p-4 mb-5 flex flex-col sm:flex-row gap-3">
        {{-- Search --}}
        <div class="search-bar flex-1">
            <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul berita..." class="form-input">
        </div>
        {{-- Category Filter --}}
        <select wire:model.live="category" class="form-select" style="width:auto; min-width:160px;">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>
        {{-- Status Filter --}}
        <select wire:model.live="status" class="form-select" style="width:auto; min-width:140px;">
            <option value="">Semua Status</option>
            <option value="published">Dipublish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th style="width:40%">Berita</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr wire:key="post-{{ $post->id }}">
                        <td>
                            <div class="flex items-center gap-3">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center" style="background-color:#e6f4ec;">
                                        <svg class="w-5 h-5" fill="none" stroke="#006227" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-medium text-slate-800 truncate" style="max-width:240px;">{{ $post->title }}</p>
                                    <p class="text-xs text-slate-400 truncate">/berita/{{ $post->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-info">{{ $post->category }}</span></td>
                        <td>
                            @if($post->is_published)
                                <span class="badge badge-success">Dipublish</span>
                            @else
                                <span class="badge badge-gray">Draft</span>
                            @endif
                        </td>
                        <td class="text-slate-500 text-sm">{{ $post->user->name ?? '-' }}</td>
                        <td class="text-slate-400 text-xs">{{ $post->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                <button
                                    @click="deleteId = {{ $post->id }}; showModal = true"
                                    class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12">
                            <div class="flex flex-col items-center gap-2 text-slate-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="font-medium">Tidak ada berita ditemukan</p>
                                <a href="{{ route('admin.posts.create') }}" class="text-sm" style="color:#006227;">Tambah berita baru</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }}
                dari <span class="font-medium text-slate-600">{{ $posts->total() }}</span> data
            </p>
            @if($posts->hasPages())
                <div>{{ $posts->links() }}</div>
            @endif
        </div>
    </div>

</div>
