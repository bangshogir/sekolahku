<x-layouts.app :title="$post->title . ' | ' . \App\Models\SchoolSetting::get('school_name', 'Madrasah')">

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-green-700 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('posts.index') }}" class="hover:text-green-700 transition-colors">Berita</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-600 truncate max-w-xs">{{ $post->title }}</span>
    </nav>

    {{-- Article --}}
    <article class="card overflow-hidden">

        {{-- Featured Image --}}
        @if($post->featured_image)
        <div style="max-height:420px; overflow:hidden;">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full object-cover">
        </div>
        @endif

        <div class="p-6 sm:p-10">
            {{-- Meta --}}
            <div class="flex flex-wrap items-center gap-3 mb-5">
                <span class="badge badge-primary text-sm">{{ $post->category }}</span>
                <span class="text-sm text-slate-400">{{ $post->published_at?->translatedFormat('d F Y') }}</span>
                @if($post->user)
                    <span class="text-sm text-slate-400">· oleh <span class="font-medium text-slate-600">{{ $post->user->name }}</span></span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight mb-4">{{ $post->title }}</h1>

            @if($post->excerpt)
            <p class="text-lg text-slate-500 border-l-4 pl-4 mb-8 italic" style="border-color:#006227;">{{ $post->excerpt }}</p>
            @endif

            {{-- Content --}}
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed" style="font-size:1rem; line-height:1.8;">
                {!! $post->content !!}
            </div>

            {{-- Share --}}
            <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 py-6 border-t border-b border-slate-100">
                <div class="text-sm font-bold text-slate-700 uppercase tracking-wider">Bagikan Artikel Ini</div>
                <div class="flex items-center gap-3">
                    @php
                        $shareUrl = urlencode(request()->url());
                        $shareText = urlencode($post->title);
                    @endphp
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all hover:-translate-y-1" title="Bagikan ke Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    {{-- X / Twitter --}}
                    <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center bg-slate-50 text-slate-700 hover:bg-slate-800 hover:text-white transition-all hover:-translate-y-1" title="Bagikan ke X">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    {{-- WhatsApp --}}
                    <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center bg-green-50 text-green-600 hover:bg-green-500 hover:text-white transition-all hover:-translate-y-1" title="Bagikan ke WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    {{-- Telegram --}}
                    <a href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center bg-cyan-50 text-cyan-600 hover:bg-cyan-500 hover:text-white transition-all hover:-translate-y-1" title="Bagikan ke Telegram">
                        <svg class="w-4 h-4 -ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.665 3.717l-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Reactions --}}
            @livewire('public.post-reaction', ['post' => $post])
        </div>
    </article>

    {{-- Related Posts --}}
    @if($relatedPosts->count())
    <div class="mt-14">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Berita Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach($relatedPosts as $related)
            <a href="{{ route('posts.show', $related) }}" class="card card-hover group overflow-hidden block">
                <div style="height:140px; overflow:hidden;">
                    @if($related->featured_image)
                        <img src="{{ asset('storage/' . $related->featured_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);"></div>
                    @endif
                </div>
                <div class="p-4">
                    <span class="badge badge-primary text-xs mb-2">{{ $related->category }}</span>
                    <h3 class="text-sm font-bold text-slate-800 line-clamp-2 group-hover:text-green-700 transition-colors">{{ $related->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Back --}}
    <div class="mt-10">
        <a href="{{ route('posts.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Berita
        </a>
    </div>
</div>

</x-layouts.app>
