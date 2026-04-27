<x-layouts.app title="Ekstrakurikuler">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Kegiatan Siswa</div>
        <h1 class="text-3xl font-extrabold text-slate-900">Ekstrakurikuler</h1>
        <p class="text-slate-500 mt-2">Wadah pengembangan minat bakat di luar jam pelajaran.</p>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($extracurriculars as $ekskul)
        <div class="card card-hover group block overflow-hidden bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
            <div class="overflow-hidden bg-slate-100" style="height:196px;">
                @if($ekskul->photo)
                    <img src="{{ asset('storage/' . $ekskul->photo) }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <svg class="w-14 h-14 opacity-30" fill="none" stroke="#006227" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                @endif
            </div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-block bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-xs font-semibold">Terdapat Pembina</span>
                </div>
                <h2 class="font-bold text-slate-800 leading-snug group-hover:text-green-700 transition-colors line-clamp-2 text-base">{{ $ekskul->name }}</h2>
                
                <div class="mt-4 space-y-2">
                    <p class="text-sm text-slate-500 flex items-center gap-2 truncate">
                        <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span class="truncate">Pembina: {{ $ekskul->supervisor }}</span>
                    </p>
                    <p class="text-sm font-medium flex items-center gap-2 truncate text-teal-700">
                        <svg class="w-4 h-4 flex-shrink-0 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="truncate">{{ $ekskul->schedule }}</span>
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="font-medium">Belum ada data ekstrakurikuler.</p>
        </div>
        @endforelse
    </div>

    @if($extracurriculars->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $extracurriculars->links('pagination::tailwind') }}
    </div>
    @endif
</div>
</x-layouts.app>
