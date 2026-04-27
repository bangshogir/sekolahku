<x-slot name="page-title">Manajemen User</x-slot>

<div class="animate-fade-in" x-data="{ deleteId: null, showModal: false }">
    <div x-show="showModal" class="modal-overlay" style="display:none;" x-transition>
        <div class="modal-box" @click.stop>
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus User?</h3>
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
            <h1 class="page-title">Manajemen User</h1>
            <p class="page-subtitle">Kelola akun admin yang dapat mengakses panel</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah User
        </a>
    </div>

    <div class="card p-4 mb-5">
        <div class="search-bar">
            <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email..." class="form-input">
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr wire:key="user-{{ $user->id }}">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0" style="background:linear-gradient(135deg,#006227,#009494);">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $user->name }}</p>
                                    @if($user->id === auth()->id())
                                        <span class="text-xs" style="color:#009494;">(Anda)</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="text-slate-500 text-sm">{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge badge-primary">Admin</span>
                            @else
                                <span class="badge badge-gray">User</span>
                            @endif
                        </td>
                        <td class="text-slate-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                @if($user->id !== auth()->id())
                                    <button @click="deleteId = {{ $user->id }}; showModal = true" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-12 text-slate-400">Tidak ada user ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
                dari <span class="font-medium text-slate-600">{{ $users->total() }}</span> data
            </p>
            @if($users->hasPages())
                <div>{{ $users->links() }}</div>
            @endif
        </div>
    </div>
</div>
