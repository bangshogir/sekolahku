<x-layouts.app title="Tenaga Pendidik">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Profil Pendidik</div>
        <h1 class="text-3xl font-extrabold text-slate-900">Tenaga Pendidik</h1>
        <p class="text-slate-500 mt-2">Mengenal lebih dekat para pendidik berdedikasi di madrasah kami.</p>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($teachers as $teacher)
        <div class="card card-hover group block overflow-hidden bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
            <div class="overflow-hidden bg-slate-100" style="height:250px;">
                @if($teacher->photo)
                    <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $teacher->name }}">
                @else
                    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <div class="text-5xl font-bold text-slate-300 opacity-50">{{ strtoupper(substr($teacher->name, 0, 2)) }}</div>
                    </div>
                @endif
            </div>
            <div class="p-5 text-center">
                <h2 class="font-bold text-slate-800 leading-snug group-hover:text-green-700 transition-colors line-clamp-2 text-base">{{ $teacher->name }}</h2>
                <p class="text-sm text-slate-500 mt-1">{{ $teacher->position }}</p>
                @if($teacher->subject)
                    <div class="mt-3">
                        <span class="inline-block bg-emerald-50 text-emerald-700 font-semibold px-3 py-1 rounded-full text-xs">
                            {{ $teacher->subject }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            <p class="font-medium">Belum ada data tenaga pendidik.</p>
        </div>
        @endforelse
    </div>

    @if($teachers->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $teachers->links('pagination::tailwind') }}
    </div>
    @endif
</div>
</x-layouts.app>
