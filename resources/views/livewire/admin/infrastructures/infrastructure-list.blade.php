<x-slot name="page-title">Data Infrastruktur</x-slot>

<div class="animate-fade-in" x-data="{ deleteId: null, showModal: false }">
    <div x-show="showModal" class="modal-overlay" style="display:none;" x-transition>
        <div class="modal-box" @click.stop>
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Data Infrastruktur?</h3>
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
            <h1 class="page-title">Data Infrastruktur</h1>
            <p class="page-subtitle">Kelola data sarana dan prasarana madrasah</p>
        </div>
        <a href="{{ route('admin.infrastructures.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Fasilitas
        </a>
    </div>

    <div class="card p-4 mb-5 flex flex-col sm:flex-row gap-3">
        <div class="search-bar flex-1">
            <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama fasilitas..." class="form-input">
        </div>
        <select wire:model.live="condition" class="form-select" style="width:auto;min-width:160px;">
            <option value="">Semua Kondisi</option>
            <option value="baik">Baik</option>
            <option value="rusak_ringan">Rusak Ringan</option>
            <option value="rusak_berat">Rusak Berat</option>
        </select>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Fasilitas</th>
                        <th>Kondisi</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($infrastructures as $item)
                    <tr wire:key="infra-{{ $item->id }}">
                        <td>
                            <div class="flex items-center gap-3">
                                @if($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color:#e0f5f5;">
                                        <svg class="w-5 h-5" fill="none" stroke="#009494" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                @endif
                                <p class="font-medium text-slate-800">{{ $item->name }}</p>
                            </div>
                        </td>
                        <td><span class="badge {{ $item->condition_badge }}">{{ $item->condition_label }}</span></td>
                        <td class="text-slate-600 font-medium">{{ $item->quantity }} unit</td>
                        <td class="text-slate-500 text-sm truncate" style="max-width:200px;">{{ $item->description ?? '—' }}</td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.infrastructures.edit', $item) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                <button @click="deleteId = {{ $item->id }}; showModal = true" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-12 text-slate-400">Belum ada data infrastruktur.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $infrastructures->firstItem() ?? 0 }}–{{ $infrastructures->lastItem() ?? 0 }}
                dari <span class="font-medium text-slate-600">{{ $infrastructures->total() }}</span> data
            </p>
            @if($infrastructures->hasPages())
                <div>{{ $infrastructures->links() }}</div>
            @endif
        </div>
    </div>
</div>
