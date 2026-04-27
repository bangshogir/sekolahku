<div>
    <div class="mt-12 pt-8 border-t border-slate-100">
        <div class="text-center mb-6">
            <h3 class="text-lg font-bold text-slate-800">Bagaimana tanggapan Anda mengenai berita ini?</h3>
            <p class="text-sm text-slate-500 mt-1">Berikan umpan balik Anda secara anonim.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
            @php
                $emotes = [
                    'like' => ['icon' => '👍', 'label' => 'Bermanfaat', 'color' => 'hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600', 'active' => 'bg-blue-50 border-blue-400 text-blue-700 ring-2 ring-blue-100'],
                    'love' => ['icon' => '❤️', 'label' => 'Suka', 'color' => 'hover:bg-pink-50 hover:border-pink-200 hover:text-pink-600', 'active' => 'bg-pink-50 border-pink-400 text-pink-700 ring-2 ring-pink-100'],
                    'wow'  => ['icon' => '😲', 'label' => 'Menakjubkan', 'color' => 'hover:bg-amber-50 hover:border-amber-200 hover:text-amber-600', 'active' => 'bg-amber-50 border-amber-400 text-amber-700 ring-2 ring-amber-100'],
                    'sad'  => ['icon' => '😢', 'label' => 'Sedih', 'color' => 'hover:bg-slate-100 hover:border-slate-300 hover:text-slate-700', 'active' => 'bg-slate-100 border-slate-400 text-slate-800 ring-2 ring-slate-200'],
                ];
            @endphp

            @foreach($emotes as $type => $data)
            <button 
                wire:click="toggleReaction('{{ $type }}')"
                class="relative flex flex-col items-center justify-center p-4 sm:p-5 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-md transition-all duration-300 {{ $userReaction === $type ? $data['active'] : $data['color'] }} group"
                style="min-width: 80px;"
            >
                <!-- CSS Tooltip -->
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1.5 bg-slate-800 text-white text-[11px] font-medium rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-20">
                    {{ $data['label'] }}
                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                </div>

                <div class="text-3xl sm:text-4xl mb-2 group-hover:scale-110 group-hover:-translate-y-1 transition-all duration-300 drop-shadow-sm {{ $userReaction === $type ? 'scale-110 -translate-y-1' : '' }}">
                    {{ $data['icon'] }}
                </div>
                
                <span class="text-sm font-bold {{ $userReaction === $type ? '' : 'text-slate-700' }} tracking-wide mt-1">
                    {{ $reactions[$type] ?? 0 }}
                </span>

                @if($userReaction === $type)
                    <div class="absolute -top-1 -right-1 bg-white rounded-full shadow-sm z-10">
                        <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>
