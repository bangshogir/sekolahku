<x-layouts.app :title="'Berita & Pengumuman | ' . \App\Models\SchoolSetting::get('school_name', 'Madrasah')">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Informasi Terkini</div>
        <h1 class="text-3xl font-extrabold text-slate-900">Berita & Pengumuman</h1>
        <p class="text-slate-500 mt-2">Ikuti perkembangan terbaru dari {{ \App\Models\SchoolSetting::get('school_name', 'madrasah kami') }}</p>
    </div>

    {{-- Posts Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
        <a href="{{ route('posts.show', $post) }}" class="card card-hover group block overflow-hidden">
            <div class="overflow-hidden" style="height:196px;">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <svg class="w-14 h-14 opacity-30" fill="none" stroke="#006227" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/></svg>
                    </div>
                @endif
            </div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="badge badge-primary">{{ $post->category }}</span>
                    <span class="text-xs text-slate-400">{{ $post->published_at?->format('d M Y') }}</span>
                </div>
                <h2 class="font-bold text-slate-800 leading-snug group-hover:text-green-700 transition-colors line-clamp-2 text-base">{{ $post->title }}</h2>
                @if($post->excerpt)
                    <p class="text-sm text-slate-500 mt-2 line-clamp-2">{{ $post->excerpt }}</p>
                @endif
                <div class="mt-4 flex items-center gap-1 text-sm font-semibold" style="color:#006227;">
                    Baca selengkapnya
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p class="font-medium">Belum ada berita yang dipublish.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
    <div class="mt-10">{{ $posts->links() }}</div>
    @endif
</div>

</x-layouts.app>
