<x-layouts.app title="Prestasi Madrasah">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Prestasi Madrasah</div>
        <h1 class="text-3xl font-extrabold text-slate-900">Kebanggaan Kami</h1>
        <p class="text-slate-500 mt-2">Daftar pencapaian dan penghargaan gemilang yang diraih oleh peserta didik madrasah tercinta.</p>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($achievements as $item)
        <div class="card card-hover group block overflow-hidden bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
            <div class="overflow-hidden bg-slate-100" style="height:196px;">
                @if($item->certificate_photo)
                    <img src="{{ asset('storage/' . $item->certificate_photo) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <svg class="w-16 h-16 opacity-30 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                @endif
            </div>
            <div class="p-5 flex flex-col h-full">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-block bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-full text-xs border border-slate-200">
                        Tahun {{ $item->year }}
                    </span>
                    @php
                        $levelColors = [
                            'sekolah' => 'bg-slate-100 text-slate-700',
                            'kecamatan' => 'bg-emerald-100 text-emerald-700',
                            'kabupaten' => 'bg-blue-100 text-blue-700',
                            'provinsi' => 'bg-purple-100 text-purple-700',
                            'nasional' => 'bg-amber-100 text-amber-700',
                            'internasional' => 'bg-rose-100 text-rose-700',
                        ];
                        $color = $levelColors[$item->level] ?? 'bg-slate-100 text-slate-700';
                        $label = str_replace('_', ' ', $item->level);
                    @endphp
                    <span class="inline-block font-semibold px-2 py-1 rounded text-xs uppercase tracking-wider {{ $color }}">
                        {{ $label }}
                    </span>
                </div>
                
                <h2 class="font-bold text-slate-800 leading-snug group-hover:text-green-700 transition-colors line-clamp-2 text-base">{{ $item->name }}</h2>
                <p class="text-sm text-slate-500 mt-2 line-clamp-2 flex-grow">{{ $item->competition_type }}</p>
                @if($item->description)
                <p class="text-xs text-slate-400 mt-2 line-clamp-2 italic border-t border-slate-50 pt-2">{{ $item->description }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
            <p class="font-medium">Belum ada data prestasi.</p>
        </div>
        @endforelse
    </div>

    @if($achievements->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $achievements->links('pagination.public') }}
    </div>
    @endif
</div>
</x-layouts.app>
