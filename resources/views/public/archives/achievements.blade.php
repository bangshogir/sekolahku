<x-layouts.app title="Prestasi Madrasah">
    
    {{-- Page Header --}}
    <section class="relative pt-24 pb-16 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 98, 39, 0.9), rgba(0, 148, 148, 0.9)), url('https://www.transparenttextures.com/patterns/arabesque.png');">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">Prestasi Madrasah</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto text-lg">Daftar pencapaian dan penghargaan gemilang yang diraih oleh peserta didik madrasah tercinta.</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            @forelse($achievements as $item)
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 md:items-center relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
                
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-amber-200 to-amber-500 shadow-sm border-2 border-white">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-wrap gap-2 mb-2 items-center">
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
                        <span class="inline-block font-semibold px-3 py-1 rounded-full text-xs uppercase tracking-wider {{ $color }}">
                            Tingkat {{ $label }}
                        </span>
                    </div>
                    
                    <h3 class="font-bold text-slate-800 text-xl leading-tight mb-1">{{ $item->name }}</h3>
                    <p class="text-slate-500">{{ $item->competition_type }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-100 border-dashed">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                <p class="text-slate-500 text-lg">Belum ada data prestasi.</p>
            </div>
            @endforelse
        </div>

        @if($achievements->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $achievements->links('pagination::tailwind') }}
        </div>
        @endif
    </section>
</x-layouts.app>
