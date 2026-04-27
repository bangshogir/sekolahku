@if ($paginator->hasPages())
<nav class="flex items-center gap-1" aria-label="Pagination">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
        <span class="px-2.5 py-1.5 text-slate-300 rounded-lg text-sm cursor-not-allowed select-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </span>
    @else
        <button wire:click="previousPage" wire:loading.attr="disabled"
            class="px-2.5 py-1.5 text-slate-500 hover:bg-slate-100 rounded-lg text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-2.5 py-1.5 text-slate-400 text-sm">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-1.5 rounded-lg text-sm font-semibold text-white" style="background:linear-gradient(135deg,#006227,#009494);">
                        {{ $page }}
                    </span>
                @else
                    <button wire:click="gotoPage({{ $page }})"
                        class="px-3 py-1.5 text-slate-600 hover:bg-slate-100 rounded-lg text-sm transition-colors">
                        {{ $page }}
                    </button>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <button wire:click="nextPage" wire:loading.attr="disabled"
            class="px-2.5 py-1.5 text-slate-500 hover:bg-slate-100 rounded-lg text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    @else
        <span class="px-2.5 py-1.5 text-slate-300 rounded-lg text-sm cursor-not-allowed select-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </span>
    @endif
</nav>
@endif
