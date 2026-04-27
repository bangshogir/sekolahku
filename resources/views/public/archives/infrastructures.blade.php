<x-layouts.app title="Fasilitas Sekolah">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Sarana Prasarana</div>
        <h1 class="text-3xl font-extrabold text-slate-900">Fasilitas Sekolah</h1>
        <p class="text-slate-500 mt-2">Daftar sarana penunjang kegiatan belajar mengajar di madrasah kami.</p>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($infrastructures as $item)
        <div class="card card-hover group block overflow-hidden bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
            <div class="overflow-hidden bg-slate-100" style="height:196px;">
                @if($item->photo)
                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <svg class="w-14 h-14 opacity-30" fill="none" stroke="#006227" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                @endif
            </div>
            <div class="p-5 flex flex-col h-full">
                <div class="flex items-center gap-2 mb-3">
                    @php
                        $conditionColors = [
                            'baik' => 'bg-emerald-50 text-emerald-700',
                            'rusak_ringan' => 'bg-amber-50 text-amber-700',
                            'rusak_berat' => 'bg-rose-50 text-rose-700',
                        ];
                        $color = $conditionColors[$item->condition] ?? 'bg-slate-50 text-slate-700';
                        $label = str_replace('_', ' ', $item->condition);
                    @endphp
                    <span class="inline-block {{ $color }} px-2 py-0.5 rounded text-xs font-semibold uppercase tracking-wide">{{ $label }}</span>
                    <span class="text-xs text-slate-400 font-medium">Jumlah: {{ $item->quantity }}</span>
                </div>
                <h2 class="font-bold text-slate-800 leading-snug group-hover:text-green-700 transition-colors line-clamp-2 text-base">{{ $item->name }}</h2>
                <p class="text-sm text-slate-500 mt-2 line-clamp-2 flex-grow">{{ $item->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            <p class="font-medium">Belum ada data fasilitas.</p>
        </div>
        @endforelse
    </div>

    @if($infrastructures->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $infrastructures->links('pagination.public') }}
    </div>
    @endif
</div>
</x-layouts.app>
