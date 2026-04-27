<x-layouts.app title="Ekstrakurikuler">
    
    {{-- Page Header --}}
    <section class="relative pt-24 pb-16 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 98, 39, 0.9), rgba(0, 148, 148, 0.9)), url('https://www.transparenttextures.com/patterns/arabesque.png');">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">Ekstrakurikuler</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto text-lg">Wadah pengembangan minat, bakat, dan potensi peserta didik di luar jam pelajaran kurikuler.</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($extracurriculars as $ekskul)
            <div class="card p-6 flex gap-5 hover:-translate-y-1 transition-transform border border-slate-100 shadow-sm hover:shadow-md bg-white rounded-2xl items-start">
                @if($ekskul->photo)
                    <img src="{{ asset('storage/' . $ekskul->photo) }}" class="w-20 h-20 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                @else
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm" style="background:linear-gradient(135deg,#006227,#009494);">
                        <svg class="w-10 h-10 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-slate-800 text-xl leading-tight mb-2 truncate">{{ $ekskul->name }}</h3>
                    <p class="text-sm text-slate-500 flex items-center gap-2 mb-1.5 truncate">
                        <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span class="truncate">{{ $ekskul->supervisor }}</span>
                    </p>
                    <p class="text-sm font-medium flex items-center gap-2 truncate" style="color:#009494;">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="truncate">{{ $ekskul->schedule }}</span>
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-slate-500 text-lg">Belum ada data ekstrakurikuler.</p>
            </div>
            @endforelse
        </div>

        @if($extracurriculars->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $extracurriculars->links('pagination::tailwind') }}
        </div>
        @endif
    </section>
</x-layouts.app>
