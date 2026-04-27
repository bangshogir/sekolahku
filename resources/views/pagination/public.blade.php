@if ($paginator->hasPages())
<nav class="flex items-center gap-2 justify-center" aria-label="Pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-400 cursor-not-allowed shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-green-700 hover:border-green-300 hover:bg-green-50 shadow-sm transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
    @endif

    {{-- Pagination Elements --}}
    <div class="hidden sm:flex items-center gap-1">
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 text-slate-500">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 rounded-lg bg-green-700 text-white font-bold shadow-sm" style="background-color:#006227;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-green-700 hover:border-green-300 hover:bg-green-50 shadow-sm transition-all font-medium">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-green-700 hover:border-green-300 hover:bg-green-50 shadow-sm transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    @else
        <span class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-400 cursor-not-allowed shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </span>
    @endif
</nav>
@endif
