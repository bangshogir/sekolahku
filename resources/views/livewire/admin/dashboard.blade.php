<x-slot name="page-title">Dashboard</x-slot>

<div class="animate-fade-in">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Berita
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        @foreach($stats as $stat)
        <a href="{{ $stat['link'] }}" class="stat-card">
            <div class="stat-icon" style="background-color:{{ $stat['bg_color'] }};">
                @if($stat['icon'] === 'document')
                    <svg class="w-6 h-6" fill="none" stroke="{{ $stat['icon_color'] }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                @elseif($stat['icon'] === 'users')
                    <svg class="w-6 h-6" fill="none" stroke="{{ $stat['icon_color'] }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                @elseif($stat['icon'] === 'star')
                    <svg class="w-6 h-6" fill="none" stroke="{{ $stat['icon_color'] }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                @else
                    <svg class="w-6 h-6" fill="none" stroke="{{ $stat['icon_color'] }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                @endif
            </div>
            <div class="min-w-0">
                <div class="stat-value">{{ $stat['value'] }}</div>
                <div class="stat-label">{{ $stat['label'] }}</div>
                <div class="text-xs mt-1" style="color:#009494;">{{ $stat['published'] }}</div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Visitor Tracking Chart (Left / 2 Cols) --}}
        <div class="card lg:col-span-2">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-slate-800">Grafik Pengunjung Web</h2>
                    <p class="text-xs text-slate-500 mt-1">Statistik unik visit per hari (7 hari terakhir)</p>
                </div>
            </div>
            <div class="p-5">
                <div id="visitorChart" style="min-height: 300px;"></div>
            </div>
        </div>

        {{-- Reader Interaction Widget (Right / 1 Col) --}}
        <div class="flex flex-col gap-6">
            {{-- Total Feedback Mini Card --}}
            <div class="card p-6 flex items-center gap-4" style="background: linear-gradient(135deg, #006227, #007a7a); color: white;">
                <div class="p-3 bg-white/20 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-green-100 font-medium">Total Respons Pembaca</p>
                    <p class="text-3xl font-bold mt-1">{{ number_format($totalReactions) }} <span class="text-xs font-normal text-green-100">emotikon</span></p>
                </div>
            </div>

            {{-- Top 3 Articles Card --}}
            <div class="card flex-1">
                <div class="p-5 border-b border-slate-100">
                    <h2 class="font-bold text-slate-800">Top 3 Berita Disorot</h2>
                    <p class="text-xs text-slate-500 mt-1">Artikel dengan feedback terbanyak</p>
                </div>
                <div class="p-2">
                    @forelse($popularPosts as $index => $post)
                        <a href="{{ route('admin.posts.edit', $post) }}" class="flex gap-4 p-3 hover:bg-slate-50 rounded-xl transition-colors group">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-slate-100 flex items-center justify-center font-bold text-slate-400 group-hover:text-green-600 transition-colors">
                                #{{ $index + 1 }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-slate-800 truncate">{{ $post->title }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-slate-500">{{ $post->created_at->format('d M') }}</span>
                                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                    <span class="text-xs font-bold text-green-600 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                        {{ $post->reactions_count }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-6 text-center text-sm text-slate-500">
                            Belum ada berita yang menerima feedback.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        var options = {
            series: [{
                name: 'Pengunjung',
                data: {!! json_encode($data) !!}
            }],
            chart: {
                height: 320,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'inherit',
                zoom: { enabled: false }
            },
            colors: ['#006227'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            xaxis: {
                categories: {!! json_encode($labels) !!},
                tooltip: { enabled: false },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return Math.floor(val);
                    }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " IP Unik";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#visitorChart"), options);
        chart.render();
    });
</script>
@endpush
