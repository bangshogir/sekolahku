<x-layouts.app title="Fasilitas Sekolah">
    
    {{-- Page Header --}}
    <section class="relative pt-24 pb-16 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 98, 39, 0.9), rgba(0, 148, 148, 0.9)), url('https://www.transparenttextures.com/patterns/arabesque.png');">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">Fasilitas Sekolah</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto text-lg">Daftar sarana dan prasarana yang menunjang kegiatan belajar mengajar di madrasah.</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($infrastructures as $item)
            <div class="card overflow-hidden hover:-translate-y-1 transition-transform border border-slate-100 shadow-sm hover:shadow-md bg-white rounded-2xl flex flex-col">
                @if($item->photo)
                    <img src="{{ asset('storage/' . $item->photo) }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-slate-50">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                @endif
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-bold text-slate-800 text-lg mb-1">{{ $item->name }}</h3>
                    <p class="text-sm text-slate-500 mb-3 line-clamp-2 flex-1">{{ $item->description ?? 'Tidak ada deskripsi.' }}</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-slate-50">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-slate-100 text-slate-600">Jumlah: {{ $item->quantity }}</span>
                        @php
                            $conditionColors = [
                                'baik' => 'bg-emerald-50 text-emerald-700',
                                'rusak_ringan' => 'bg-amber-50 text-amber-700',
                                'rusak_berat' => 'bg-rose-50 text-rose-700',
                            ];
                            $color = $conditionColors[$item->condition] ?? 'bg-slate-50 text-slate-700';
                            $label = str_replace('_', ' ', $item->condition);
                        @endphp
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-md uppercase tracking-wider {{ $color }}">
                            {{ $label }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                <p class="text-slate-500 text-lg">Belum ada data fasilitas.</p>
            </div>
            @endforelse
        </div>

        @if($infrastructures->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $infrastructures->links('pagination::tailwind') }}
        </div>
        @endif
    </section>
</x-layouts.app>
