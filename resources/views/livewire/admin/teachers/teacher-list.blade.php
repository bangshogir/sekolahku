<x-slot name="page-title">Data Guru</x-slot>

<div class="animate-fade-in" x-data="{ deleteId: null, showModal: false }">

    {{-- Delete Modal --}}
    <div x-show="showModal" class="modal-overlay" style="display:none;" x-transition>
        <div class="modal-box" @click.stop>
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Data Guru?</h3>
                <p class="text-slate-500 text-sm mb-6">Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="showModal = false" class="btn-ghost px-6">Batal</button>
                    <button wire:click="delete(deleteId)" @click="showModal = false" class="btn-danger px-6">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Import Modal --}}
    @if($showImportModal)
    <div class="modal-overlay" x-transition>
        <div class="modal-box max-w-lg" @click.stop>
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Import Data Guru</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Unggah file CSV atau Excel berisi daftar guru</p>
                </div>
                <button wire:click="closeImportModal" class="p-1.5 rounded-lg text-slate-400 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Download Template --}}
            <div class="flex items-center gap-3 p-3 bg-green-50 rounded-xl border border-green-100 mb-4">
                <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-green-800">Unduh template terlebih dahulu</p>
                    <p class="text-xs text-green-600 mt-0.5">Isi sesuai format kolom yang tersedia</p>
                </div>
                <a href="{{ route('templates.teachers') }}" class="btn-outline text-xs px-3 py-1.5">Unduh</a>
            </div>

            <form wire:submit="importCsv">
                {{-- Drop Zone --}}
                <div class="mb-4">
                    <label for="importFile" class="drop-zone cursor-pointer">
                        <input id="importFile" type="file" wire:model="importFile" class="sr-only" accept=".csv,.xlsx,.xls">
                        <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        @if($importFile)
                            <p class="text-sm font-semibold text-green-700">{{ $importFile->getClientOriginalName() }}</p>
                            <p class="text-xs text-slate-400 mt-1">Klik untuk ganti file</p>
                        @else
                            <p class="text-sm font-medium text-slate-600">Klik atau drag file ke sini</p>
                            <p class="text-xs text-slate-400 mt-1">Format: CSV, XLSX, XLS (maks. 5 MB)</p>
                        @endif
                    </label>
                    <div wire:loading wire:target="importFile" class="text-center mt-2 text-sm text-slate-500">
                        <span class="animate-pulse">Memuat file...</span>
                    </div>
                    @error('importFile') <p class="form-error mt-2">{{ $message }}</p> @enderror
                </div>

                {{-- Kolom Panduan --}}
                <div class="bg-slate-50 rounded-xl p-3 mb-5 text-xs text-slate-500 space-y-1">
                    <p class="font-semibold text-slate-700 mb-1.5">Kolom yang dikenali:</p>
                    <div class="grid grid-cols-2 gap-1">
                        <span>• <code class="bg-white px-1 rounded">nama</code> <span class="text-red-500">*wajib</span></span>
                        <span>• <code class="bg-white px-1 rounded">nip</code></span>
                        <span>• <code class="bg-white px-1 rounded">jabatan</code></span>
                        <span>• <code class="bg-white px-1 rounded">mata_pelajaran</code></span>
                        <span>• <code class="bg-white px-1 rounded">bio</code></span>
                        <span>• <code class="bg-white px-1 rounded">status</code> (aktif/nonaktif)</span>
                    </div>
                </div>

                <div class="flex gap-3 justify-end">
                    <button type="button" wire:click="closeImportModal" class="btn-ghost">Batal</button>
                    <button type="submit" wire:loading.attr="disabled" class="btn-primary">
                        <svg wire:loading wire:target="importCsv" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="importCsv">Proses Import</span>
                        <span wire:loading wire:target="importCsv">Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Import Errors --}}
    @if(!empty($importErrors))
    <div class="mb-5 p-4 bg-amber-50 border border-amber-200 rounded-xl">
        <p class="font-semibold text-amber-800 text-sm mb-2">⚠️ Beberapa baris tidak berhasil diimport:</p>
        <ul class="text-xs text-amber-700 space-y-1 list-disc list-inside">
            @foreach($importErrors as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Flash --}}
    @if(session('success'))
    <div class="flash-success mb-5">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="page-header">
        <div>
            <h1 class="page-title">Data Guru</h1>
            <p class="page-subtitle">Kelola data tenaga pendidik madrasah</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            {{-- Import Button --}}
            <button wire:click="openImportModal" class="btn-ghost flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Import CSV/Excel
            </button>
            <a href="{{ route('admin.teachers.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Guru
            </a>
        </div>
    </div>

    {{-- Filter --}}
    <div class="card p-4 mb-5 flex flex-col sm:flex-row gap-3">
        <div class="search-bar flex-1">
            <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama, NIP, atau mapel..." class="form-input">
        </div>
        <select wire:model.live="status" class="form-select" style="width:auto;min-width:150px;">
            <option value="">Semua Status</option>
            <option value="active">Aktif</option>
            <option value="inactive">Tidak Aktif</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Guru</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Mata Pelajaran</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                    <tr wire:key="teacher-{{ $teacher->id }}">
                        <td>
                            <div class="flex items-center gap-3">
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0" style="background:linear-gradient(135deg,#006227,#009494);">
                                        {{ strtoupper(substr($teacher->name, 0, 2)) }}
                                    </div>
                                @endif
                                <p class="font-medium text-slate-800">{{ $teacher->name }}</p>
                            </div>
                        </td>
                        <td class="text-slate-500 text-sm font-mono">{{ $teacher->nip ?? '—' }}</td>
                        <td class="text-slate-600 text-sm">{{ $teacher->position }}</td>
                        <td class="text-slate-500 text-sm">{{ $teacher->subject ?? '—' }}</td>
                        <td>
                            @if($teacher->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-gray">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                <button @click="deleteId = {{ $teacher->id }}; showModal = true" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-12 text-slate-400">Tidak ada data guru ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $teachers->firstItem() ?? 0 }}–{{ $teachers->lastItem() ?? 0 }}
                dari <span class="font-medium text-slate-600">{{ $teachers->total() }}</span> data
            </p>
            @if($teachers->hasPages())
                <div>{{ $teachers->links() }}</div>
            @endif
        </div>
    </div>
</div>
