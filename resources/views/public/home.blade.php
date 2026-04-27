<x-layouts.app>

{{-- ============================================================
     HERO SECTION
     ============================================================ --}}
@php
    $heroBg = \App\Models\SchoolSetting::get('hero_background');
    $heroBgUrl = $heroBg 
        ? asset('storage/' . $heroBg) 
        : 'https://images.unsplash.com/photo-1564121211835-e88c852648ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
@endphp
<section class="relative overflow-hidden bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 77, 31, 0.85), rgba(0, 98, 39, 0.85)), url('{{ $heroBgUrl }}'); min-height: 90vh; background-attachment: fixed;">

    {{-- Decorative shapes --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #FFD700, transparent);"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full opacity-10" style="background: radial-gradient(circle, #009494, transparent);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] opacity-5 rounded-full border-2 border-white"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col items-center text-center">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6 text-sm font-semibold" style="background:rgba(255,215,0,0.15); color:#FFD700; border:1px solid rgba(255,215,0,0.3);">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            Di Bawah Naungan Kementerian Agama RI
        </div>

        {{-- Headline --}}
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-4 leading-tight">
            {{ $settings['school_name'] ?? 'Madrasah Kami' }}
        </h1>
        <p class="text-xl sm:text-2xl font-medium mb-4" style="color:rgba(255,215,0,0.9);">
            {{ $settings['school_tagline'] ?? 'Berilmu, Berakhlak, Berprestasi' }}
        </p>
        <p class="text-base sm:text-lg max-w-2xl mb-10" style="color:rgba(255,255,255,0.75);">
            Membangun generasi unggul yang berilmu, berakhlak mulia, dan mampu bersaing di tingkat nasional maupun internasional.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('posts.index') }}" class="px-8 py-3.5 rounded-xl text-base font-bold text-white transition-all" style="background-color:#FFD700; color:#004d1f;" onmouseover="this.style.backgroundColor='#e6c200'" onmouseout="this.style.backgroundColor='#FFD700'">
                Baca Berita Terbaru
            </a>
            <a href="#tentang" class="px-8 py-3.5 rounded-xl text-base font-bold transition-all" style="background:rgba(255,255,255,0.15); color:white; border:1.5px solid rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                Tentang Madrasah
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-16 w-full max-w-2xl">
            @foreach([
                ['value' => $stats['posts'], 'label' => 'Berita'],
                ['value' => $stats['teachers'], 'label' => 'Tenaga Didik'],
                ['value' => $stats['extracurriculars'], 'label' => 'Ekskul'],
                ['value' => $stats['achievements'], 'label' => 'Prestasi'],
            ] as $stat)
            <div class="rounded-2xl p-4 text-center" style="background:rgba(255,255,255,0.1); backdrop-filter:blur(8px);">
                <div class="text-3xl font-extrabold text-white">{{ $stat['value'] }}+</div>
                <div class="text-xs mt-1" style="color:rgba(255,255,255,0.7);">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 32L60 26.7C120 21 240 11 360 16C480 21 600 43 720 48C840 53 960 43 1080 37.3C1200 32 1320 32 1380 32L1440 32V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0V32Z" fill="#F8FAFC"/>
        </svg>
    </div>
</section>

{{-- ============================================================
     BERITA TERBARU
     ============================================================ --}}
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between mb-10">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Informasi Terkini</div>
            <h2 class="text-3xl font-extrabold text-slate-900">Berita Terbaru</h2>
        </div>
        <a href="{{ route('posts.index') }}" class="btn-outline hidden sm:inline-flex">Lihat Semua →</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($latestPosts as $i => $post)
        <a href="{{ route('posts.show', $post) }}" class="card card-hover group block overflow-hidden {{ $i === 0 ? 'md:col-span-2 lg:col-span-1' : '' }}">
            <div class="overflow-hidden" style="height:200px;">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <svg class="w-16 h-16 opacity-30" fill="none" stroke="#006227" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/></svg>
                    </div>
                @endif
            </div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="badge badge-primary">{{ $post->category }}</span>
                    <span class="text-xs text-slate-400">{{ $post->published_at?->diffForHumans() }}</span>
                </div>
                <h3 class="font-bold text-slate-800 leading-snug group-hover:text-green-700 transition-colors line-clamp-2">{{ $post->title }}</h3>
                @if($post->excerpt)
                    <p class="text-sm text-slate-500 mt-2 line-clamp-2">{{ $post->excerpt }}</p>
                @endif
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-12 text-slate-400">Belum ada berita yang dipublish.</div>
        @endforelse
    </div>

    <div class="text-center mt-8 sm:hidden">
        <a href="{{ route('posts.index') }}" class="btn-outline">Lihat Semua Berita</a>
    </div>
</section>

{{-- ============================================================
     TENTANG MADRASAH
     ============================================================ --}}
<section id="tentang" class="py-16" style="background-image: linear-gradient(135deg, rgba(240, 253, 244, 0.85), rgba(224, 245, 245, 0.85)), url('https://www.transparenttextures.com/patterns/arabesque.png'); background-attachment: fixed;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Profil Kami</div>
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Tentang {{ $settings['school_name'] ?? 'Madrasah' }}</h2>
                <p class="text-slate-600 leading-relaxed mb-6">{{ $settings['about_text'] ?? 'Madrasah kami berkomitmen untuk mencetak generasi yang berilmu, berakhlak mulia, dan berprestasi.' }}</p>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['label' => 'Kepala Madrasah', 'value' => $settings['principal_name'] ?? '-'],
                        ['label' => 'Akreditasi', 'value' => $settings['accreditation'] ?? '-'],
                        ['label' => 'Tahun Berdiri', 'value' => $settings['established_year'] ?? '-'],
                        ['label' => 'Status', 'value' => 'Negeri / Kemenag'],
                    ] as $info)
                    <div class="p-4 rounded-xl bg-white shadow-sm">
                        <p class="text-xs text-slate-400 font-medium">{{ $info['label'] }}</p>
                        <p class="font-bold text-slate-800 text-sm mt-1">{{ $info['value'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @if(!empty($settings['principal_message']) || !empty($settings['principal_name']))
            <div class="relative w-full max-w-sm mx-auto mt-12 lg:mt-0 p-8 pt-12 bg-white rounded-3xl shadow-xl border border-slate-100 flex flex-col items-center">
                <div class="absolute -top-6 -left-6 opacity-10">
                    <svg class="w-24 h-24 text-green-700" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                </div>
                
                @php
                    $principalPhotoUrl = !empty($settings['principal_photo']) 
                        ? asset('storage/' . $settings['principal_photo']) 
                        : null;
                @endphp
                
                @if($principalPhotoUrl)
                    <img src="{{ $principalPhotoUrl }}" class="w-32 h-32 rounded-full object-cover shadow-lg absolute -top-16 border-4 border-white z-10" alt="Kepala Madrasah">
                @else
                    <div class="w-32 h-32 rounded-full shadow-lg absolute -top-16 border-4 border-white z-10 flex items-center justify-center text-white text-4xl font-bold" style="background:linear-gradient(135deg,#006227,#009494);">
                        {{ strtoupper(substr($settings['principal_name'] ?? 'KM', 0, 2)) }}
                    </div>
                @endif
                
                <h3 class="text-xl font-bold text-slate-800 text-center relative z-10 mt-6">{{ $settings['principal_name'] ?? 'Kepala Madrasah' }}</h3>
                <p class="text-xs text-slate-400 font-medium tracking-widest uppercase mb-5 relative z-10">Kepala Madrasah</p>
                
                @if(!empty($settings['principal_message']))
                <p class="text-slate-600 italic text-center text-sm leading-relaxed relative z-10 border-t border-slate-100 pt-5">
                    "{{ $settings['principal_message'] }}"
                </p>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ============================================================
     DATA GURU
     ============================================================ --}}
@if($teachers->count())
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden relative">
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Sumber Daya Manusia</div>
        <h2 class="text-3xl font-extrabold text-slate-900">Tenaga Pendidik</h2>
        <p class="text-slate-500 mt-3 text-sm max-w-2xl mx-auto">Mengenal lebih dekat para pendidik berdedikasi tinggi yang siap membimbing dan mencerdaskan generasi penerus bangsa.</p>
    </div>

    @push('styles')
    <style>
        .marquee-container {
            display: flex;
            overflow: hidden;
            width: 100%;
            position: relative;
        }
        .marquee-content {
            display: flex;
            gap: 1.5rem;
            padding: 0.75rem 0.75rem;
            width: max-content;
        }
        .teacher-card {
            width: 240px;
            flex-shrink: 0;
            background: white;
            border-radius: 1rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 1.25rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .animate-scroll-left { animation: scroll-left 75s linear infinite; }
        .animate-scroll-right { animation: scroll-right 75s linear infinite; }
        
        .marquee-container:hover .animate-scroll-left,
        .marquee-container:hover .animate-scroll-right {
            animation-play-state: paused;
        }

        @keyframes scroll-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-50% - 0.75rem)); }
        }
        @keyframes scroll-right {
            0% { transform: translateX(calc(-50% - 0.75rem)); }
            100% { transform: translateX(0); }
        }
        
        /* Gradient fade effect on the sides */
        .marquee-wrapper {
            position: relative;
        }
        .marquee-wrapper::before,
        .marquee-wrapper::after {
            content: "";
            position: absolute;
            top: 0;
            width: 100px;
            height: 100%;
            z-index: 10;
        }
        .marquee-wrapper::before {
            left: 0;
            background: linear-gradient(to right, white, transparent);
        }
        .marquee-wrapper::after {
            right: 0;
            background: linear-gradient(to left, white, transparent);
        }
    </style>
    @endpush

    @php
        // Split teachers into two rows
        $half = ceil($teachers->count() / 2);
        $row1 = $teachers->take($half);
        $row2 = $teachers->skip($half);
    @endphp

    <div class="marquee-wrapper space-y-6">
        {{-- Row 1: Scroll Left --}}
        <div class="marquee-container">
            <div class="marquee-content animate-scroll-left">
                {{-- Original --}}
                @foreach($row1 as $teacher)
                    <div class="teacher-card">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-3 shadow-md" alt="{{ $teacher->name }}">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-lg font-bold shadow-md" style="background:linear-gradient(135deg,#006227,#009494);">
                                {{ strtoupper(substr($teacher->name, 0, 2)) }}
                            </div>
                        @endif
                        <h3 class="font-bold text-slate-800 text-sm leading-tight line-clamp-1" title="{{ $teacher->name }}">{{ $teacher->name }}</h3>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1" title="{{ $teacher->position }}">{{ $teacher->position }}</p>
                        @if($teacher->subject)
                            <p class="text-xs font-semibold mt-1.5" style="color:#009494;">{{ $teacher->subject }}</p>
                        @endif
                    </div>
                @endforeach
                {{-- Duplicate for infinite scroll --}}
                @foreach($row1 as $teacher)
                    <div class="teacher-card">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-3 shadow-md" alt="{{ $teacher->name }}">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-lg font-bold shadow-md" style="background:linear-gradient(135deg,#006227,#009494);">
                                {{ strtoupper(substr($teacher->name, 0, 2)) }}
                            </div>
                        @endif
                        <h3 class="font-bold text-slate-800 text-sm leading-tight line-clamp-1" title="{{ $teacher->name }}">{{ $teacher->name }}</h3>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1" title="{{ $teacher->position }}">{{ $teacher->position }}</p>
                        @if($teacher->subject)
                            <p class="text-xs font-semibold mt-1.5" style="color:#009494;">{{ $teacher->subject }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Row 2: Scroll Right --}}
        @if($row2->count() > 0)
        <div class="marquee-container">
            <div class="marquee-content animate-scroll-right">
                {{-- Original --}}
                @foreach($row2 as $teacher)
                    <div class="teacher-card">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-3 shadow-md" alt="{{ $teacher->name }}">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-lg font-bold shadow-md" style="background:linear-gradient(135deg,#006227,#009494);">
                                {{ strtoupper(substr($teacher->name, 0, 2)) }}
                            </div>
                        @endif
                        <h3 class="font-bold text-slate-800 text-sm leading-tight line-clamp-1" title="{{ $teacher->name }}">{{ $teacher->name }}</h3>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1" title="{{ $teacher->position }}">{{ $teacher->position }}</p>
                        @if($teacher->subject)
                            <p class="text-xs font-semibold mt-1.5" style="color:#009494;">{{ $teacher->subject }}</p>
                        @endif
                    </div>
                @endforeach
                {{-- Duplicate for infinite scroll --}}
                @foreach($row2 as $teacher)
                    <div class="teacher-card">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-3 shadow-md" alt="{{ $teacher->name }}">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-lg font-bold shadow-md" style="background:linear-gradient(135deg,#006227,#009494);">
                                {{ strtoupper(substr($teacher->name, 0, 2)) }}
                            </div>
                        @endif
                        <h3 class="font-bold text-slate-800 text-sm leading-tight line-clamp-1" title="{{ $teacher->name }}">{{ $teacher->name }}</h3>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1" title="{{ $teacher->position }}">{{ $teacher->position }}</p>
                        @if($teacher->subject)
                            <p class="text-xs font-semibold mt-1.5" style="color:#009494;">{{ $teacher->subject }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endif

{{-- ============================================================
     EKSTRAKURIKULER
     ============================================================ --}}
@if($extracurriculars->count())
<section id="ekskul" class="py-16" style="background-color: #F8FAFC; background-image: linear-gradient(rgba(248, 250, 252, 0.85), rgba(248, 250, 252, 0.85)), url('https://www.transparenttextures.com/patterns/arabesque.png'); background-attachment: fixed;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Kegiatan Siswa</div>
            <h2 class="text-3xl font-extrabold text-slate-900">Ekstrakurikuler</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($extracurriculars as $ekskul)
            <div class="card card-hover p-5 flex gap-4">
                @if($ekskul->photo)
                    <img src="{{ asset('storage/' . $ekskul->photo) }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0">
                @else
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,#006227,#009494);">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                @endif
                <div>
                    <h3 class="font-bold text-slate-800">{{ $ekskul->name }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pembina: {{ $ekskul->supervisor }}</p>
                    <p class="text-xs mt-1 flex items-center gap-1" style="color:#009494;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $ekskul->schedule }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     PRESTASI
     ============================================================ --}}
@if($achievements->count())
<section id="prestasi" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
        <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Kebanggaan Kami</div>
        <h2 class="text-3xl font-extrabold text-slate-900">Prestasi Madrasah</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($achievements as $achievement)
        <div class="card card-hover p-5">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:#fef3c7;">
                <svg class="w-5 h-5" fill="#d97706" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <div class="font-bold text-slate-800 text-lg leading-tight">{{ $achievement->name }}</div>
            <p class="text-sm text-slate-600 mt-1">{{ $achievement->competition_type }}</p>
            <div class="flex items-center justify-between mt-3">
                <span class="badge {{ $achievement->level_badge }} text-xs">{{ $achievement->level_label }}</span>
                <span class="text-xs text-slate-400 font-semibold">{{ $achievement->year }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ============================================================
     FASILITAS
     ============================================================ --}}
@if($infrastructures->count())
<section id="fasilitas" class="py-16" style="background-image: linear-gradient(135deg, rgba(240, 253, 244, 0.85), rgba(224, 245, 245, 0.85)), url('https://www.transparenttextures.com/patterns/arabesque.png'); background-attachment: fixed;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <div class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#009494;">Sarana & Prasarana</div>
            <h2 class="text-3xl font-extrabold text-slate-900">Fasilitas Sekolah</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($infrastructures as $infra)
            <div class="bg-white rounded-2xl p-4 shadow-sm flex flex-col items-center text-center">
                @if($infra->photo)
                    <img src="{{ asset('storage/' . $infra->photo) }}" class="w-full h-32 object-cover rounded-xl mb-3">
                @else
                    <div class="w-full h-32 rounded-xl mb-3 flex items-center justify-center" style="background:linear-gradient(135deg,#e6f4ec,#e0f5f5);">
                        <svg class="w-10 h-10 opacity-40" fill="none" stroke="#006227" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                @endif
                <h3 class="font-bold text-slate-800 text-sm">{{ $infra->name }}</h3>
                <p class="text-xs text-slate-400 mt-0.5">{{ $infra->quantity }} unit</p>
                <span class="badge {{ $infra->condition_badge }} mt-2 text-xs">{{ $infra->condition_label }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

</x-layouts.app>
