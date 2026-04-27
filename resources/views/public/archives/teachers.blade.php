<x-layouts.app title="Tenaga Pendidik">
    
    {{-- Page Header --}}
    <section class="relative pt-24 pb-16 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 98, 39, 0.9), rgba(0, 148, 148, 0.9)), url('https://www.transparenttextures.com/patterns/arabesque.png');">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">Tenaga Pendidik</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto text-lg">Mengenal lebih dekat para pendidik berdedikasi tinggi yang siap membimbing dan mencerdaskan generasi penerus bangsa.</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($teachers as $teacher)
            <div class="card p-6 flex flex-col items-center text-center hover:-translate-y-1 transition-transform border border-slate-100 shadow-sm hover:shadow-md bg-white rounded-2xl">
                @if($teacher->photo)
                    <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-24 h-24 rounded-full object-cover mb-4 shadow-sm border-2 border-white">
                @else
                    <div class="w-24 h-24 rounded-full mb-4 flex items-center justify-center text-white text-2xl font-bold shadow-sm border-2 border-white" style="background:linear-gradient(135deg,#006227,#009494);">
                        {{ strtoupper(substr($teacher->name, 0, 2)) }}
                    </div>
                @endif
                <h3 class="font-bold text-slate-800 text-base leading-tight w-full truncate" title="{{ $teacher->name }}">{{ $teacher->name }}</h3>
                <p class="text-sm text-slate-500 mt-1 w-full truncate" title="{{ $teacher->position }}">{{ $teacher->position }}</p>
                @if($teacher->subject)
                    <span class="inline-block bg-emerald-50 text-emerald-700 font-semibold px-3 py-1 rounded-full text-xs mt-3 w-full truncate" title="{{ $teacher->subject }}">
                        {{ $teacher->subject }}
                    </span>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <p class="text-slate-500 text-lg">Belum ada data tenaga pendidik.</p>
            </div>
            @endforelse
        </div>

        @if($teachers->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $teachers->links('pagination::tailwind') }}
        </div>
        @endif
    </section>
</x-layouts.app>
