<x-slot name="page-title">Ekstrakurikuler</x-slot>

<div class="animate-fade-in" x-data="{ deleteId: null, showModal: false }">
    <div x-show="showModal" class="modal-overlay" style="display:none;" x-transition>
        <div class="modal-box" @click.stop>
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Data Ekskul?</h3>
                <p class="text-slate-500 text-sm mb-6">Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="showModal = false" class="btn-ghost px-6">Batal</button>
                    <button wire:click="delete(deleteId)" @click="showModal = false" class="btn-danger px-6">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <div>
            <h1 class="page-title">Ekstrakurikuler</h1>
            <p class="page-subtitle">Kelola kegiatan ekstrakurikuler madrasah</p>
        </div>
        <a href="{{ route('admin.extracurriculars.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Ekskul
        </a>
    </div>

    <div class="card p-4 mb-5">
        <div class="search-bar">
            <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama ekskul atau pembina..." class="form-input">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($extracurriculars as $item)
        <div class="card card-hover p-5" wire:key="ekskul-{{ $item->id }}">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    @if($item->photo)
                        <img src="{{ asset('storage/' . $item->photo) }}" class="w-12 h-12 rounded-xl object-cover flex-shrink-0">
                    @else
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,#006227,#009494);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-slate-800">{{ $item->name }}</h3>
                        <span class="{{ $item->is_active ? 'badge-success' : 'badge-gray' }} badge text-xs">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                </div>
            </div>
            <div class="space-y-1.5 text-sm text-slate-500 mb-4">
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>{{ $item->supervisor }}</span>
                </p>
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $item->schedule }}</span>
                </p>
            </div>
            <div class="flex gap-2 pt-3 border-t border-slate-100">
                <a href="{{ route('admin.extracurriculars.edit', $item) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                <button @click="deleteId = {{ $item->id }}; showModal = true" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-slate-400">Belum ada data ekskul.</div>
        @endforelse
    </div>
    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white rounded-xl p-3 border border-slate-100">
        <p class="text-xs text-slate-400">
            Menampilkan {{ $extracurriculars->firstItem() ?? 0 }}–{{ $extracurriculars->lastItem() ?? 0 }}
            dari <span class="font-medium text-slate-600">{{ $extracurriculars->total() }}</span> data
        </p>
        @if($extracurriculars->hasPages())
            <div>{{ $extracurriculars->links() }}</div>
        @endif
    </div>
</div>
