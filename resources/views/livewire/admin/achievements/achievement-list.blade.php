<x-slot name="page-title">Data Prestasi</x-slot>

<div class="animate-fade-in" x-data="{ deleteId: null, showModal: false }">
    <div x-show="showModal" class="modal-overlay" style="display:none;" x-transition>
        <div class="modal-box" @click.stop>
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Data Prestasi?</h3>
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
            <h1 class="page-title">Data Prestasi</h1>
            <p class="page-subtitle">Dokumentasi pencapaian dan penghargaan madrasah</p>
        </div>
        <a href="{{ route('admin.achievements.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Prestasi
        </a>
    </div>

    <div class="card p-4 mb-5 flex flex-col sm:flex-row gap-3">
        <div class="search-bar flex-1">
            <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari prestasi atau jenis lomba..." class="form-input">
        </div>
        <select wire:model.live="level" class="form-select" style="width:auto;min-width:180px;">
            <option value="">Semua Tingkat</option>
            @foreach(\App\Models\Achievement::LEVELS as $val => $label)
                <option value="{{ $val }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Prestasi</th>
                        <th>Jenis Lomba</th>
                        <th>Tingkat</th>
                        <th>Tahun</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($achievements as $item)
                    <tr wire:key="achievement-{{ $item->id }}">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:#fef9c3;">
                                    <svg class="w-5 h-5" fill="#d97706" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                                <p class="font-bold text-slate-800">{{ $item->name }}</p>
                            </div>
                        </td>
                        <td class="text-slate-600 text-sm">{{ $item->competition_type }}</td>
                        <td><span class="badge {{ $item->level_badge }}">{{ $item->level_label }}</span></td>
                        <td class="font-semibold text-slate-700">{{ $item->year }}</td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.achievements.edit', $item) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                <button @click="deleteId = {{ $item->id }}; showModal = true" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-12 text-slate-400">Belum ada data prestasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $achievements->firstItem() ?? 0 }}–{{ $achievements->lastItem() ?? 0 }}
                dari <span class="font-medium text-slate-600">{{ $achievements->total() }}</span> data
            </p>
            @if($achievements->hasPages())
                <div>{{ $achievements->links() }}</div>
            @endif
        </div>
    </div>
</div>
