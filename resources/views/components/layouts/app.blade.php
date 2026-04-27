<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ \App\Models\SchoolSetting::get('school_tagline', 'Website Resmi Madrasah') }}">
    <title>{{ $title ?? \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body style="background-color:#F8FAFC; font-family:'Plus Jakarta Sans',sans-serif;">

{{-- ============================================================
     NAVBAR
     ============================================================ --}}
<header
    x-data="{ mobileMenu: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
    :class="scrolled ? 'shadow-md bg-white' : 'bg-white/95 backdrop-blur-md'"
    class="sticky top-0 z-50 transition-all duration-300 border-b border-slate-100"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                @if(\App\Models\SchoolSetting::get('school_logo'))
                    <img src="{{ asset('storage/' . \App\Models\SchoolSetting::get('school_logo')) }}" alt="Logo" class="w-10 h-10 object-contain rounded-full">
                @else
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #006227, #009494);">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="font-bold text-sm leading-tight" style="color:#006227;">{{ \App\Models\SchoolSetting::get('school_name', 'Madrasah') }}</p>
                    <p class="text-xs text-slate-400 leading-tight">{{ \App\Models\SchoolSetting::get('school_tagline', 'Berilmu, Berakhlak, Berprestasi') }}</p>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-white' : 'text-slate-600 hover:text-green-700 hover:bg-green-50' }}"
                   style="{{ request()->routeIs('home') ? 'background-color:#006227;' : '' }}">
                    Beranda
                </a>
                
                {{-- Profil Menu --}}
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button class="px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-1 transition-colors {{ request()->routeIs('about') || request()->routeIs('vision-mission') ? 'text-white' : 'text-slate-600 hover:text-green-700 hover:bg-green-50' }}"
                            style="{{ request()->routeIs('about') || request()->routeIs('vision-mission') ? 'background-color:#006227;' : '' }}">
                        Profil
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-48 bg-white/95 backdrop-blur-md rounded-xl shadow-lg border border-slate-100 py-2 z-50" style="display:none;">
                        <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('about') ? 'font-bold text-green-700' : '' }}">Tentang Kami</a>
                        <a href="{{ route('vision-mission') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('vision-mission') ? 'font-bold text-green-700' : '' }}">Visi & Misi</a>
                        <a href="{{ route('archives.teachers') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('archives.teachers') ? 'font-bold text-green-700' : '' }}">Tenaga Pendidik</a>
                    </div>
                </div>

                <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('posts.*') ? 'text-white' : 'text-slate-600 hover:text-green-700 hover:bg-green-50' }}"
                   style="{{ request()->routeIs('posts.*') ? 'background-color:#006227;' : '' }}">
                    Berita
                </a>
                <a href="{{ route('archives.extracurriculars') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('archives.extracurriculars') ? 'text-white' : 'text-slate-600 hover:text-green-700 hover:bg-green-50' }}"
                   style="{{ request()->routeIs('archives.extracurriculars') ? 'background-color:#006227;' : '' }}">
                    Ekstrakurikuler
                </a>
                <a href="{{ route('archives.achievements') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('archives.achievements') ? 'text-white' : 'text-slate-600 hover:text-green-700 hover:bg-green-50' }}"
                   style="{{ request()->routeIs('archives.achievements') ? 'background-color:#006227;' : '' }}">
                    Prestasi
                </a>
                <a href="{{ route('archives.infrastructures') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('archives.infrastructures') ? 'text-white' : 'text-slate-600 hover:text-green-700 hover:bg-green-50' }}"
                   style="{{ request()->routeIs('archives.infrastructures') ? 'background-color:#006227;' : '' }}">
                    Fasilitas
                </a>
            </nav>

            {{-- CTA + Mobile toggle --}}
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn-primary text-xs px-4 py-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary text-xs px-4 py-2 hidden md:inline-flex">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login Admin
                    </a>
                @endauth

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                    <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div
            x-show="mobileMenu"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden border-t border-slate-100 py-3 space-y-1"
            style="display:none;"
        >
            <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors">Beranda</a>
            
            {{-- Profil Mobile --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors">
                    Profil
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-collapse>
                    <div class="px-4 py-1 space-y-1 ml-4 border-l-2 border-slate-100">
                        <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-slate-500 hover:text-green-700">Tentang Kami</a>
                        <a href="{{ route('vision-mission') }}" class="block px-4 py-2 text-sm text-slate-500 hover:text-green-700">Visi & Misi</a>
                        <a href="{{ route('archives.teachers') }}" class="block px-4 py-2 text-sm text-slate-500 hover:text-green-700">Tenaga Pendidik</a>
                    </div>
                </div>
            </div>

            <a href="{{ route('posts.index') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors">Berita</a>
            <a href="{{ route('archives.extracurriculars') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors">Ekstrakurikuler</a>
            <a href="{{ route('archives.achievements') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors">Prestasi</a>
            <a href="{{ route('archives.infrastructures') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors">Fasilitas</a>
            <div class="pt-2 border-t border-slate-100">
                <a href="{{ route('login') }}" class="btn-primary w-full justify-center text-sm">Login Admin</a>
            </div>
        </div>
    </div>
</header>

{{-- ============================================================
     MAIN CONTENT
     ============================================================ --}}
<main>
    {{ $slot }}
</main>

{{-- ============================================================
     FOOTER
     ============================================================ --}}
<footer style="background: linear-gradient(135deg, #004d1f 0%, #006227 50%, #007a7a 100%);" class="text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    @if(\App\Models\SchoolSetting::get('school_logo'))
                        <div class="w-12 h-12 flex items-center justify-center bg-white/10 rounded-xl p-1">
                            <img src="{{ asset('storage/' . \App\Models\SchoolSetting::get('school_logo')) }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color:rgba(255,215,0,0.2);">
                            <svg class="w-6 h-6" fill="#FFD700" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <p class="font-bold">{{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}</p>
                        <p class="text-xs" style="color:rgba(255,255,255,0.6);">Di bawah naungan Kemenag RI</p>
                    </div>
                </div>
                <p class="text-sm" style="color:rgba(255,255,255,0.75); line-height:1.7;">
                    {{ \App\Models\SchoolSetting::get('school_tagline', 'Berilmu, Berakhlak, Berprestasi') }}
                </p>
                {{-- Sosial Media --}}
                <div class="flex gap-3 mt-4">
                    @if(\App\Models\SchoolSetting::get('facebook_url'))
                        <a href="{{ \App\Models\SchoolSetting::get('facebook_url') }}" class="w-8 h-8 rounded-lg flex items-center justify-center transition-all bg-white/10 hover:bg-white/20 hover:-translate-y-0.5 text-white">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                    @endif
                    @if(\App\Models\SchoolSetting::get('instagram_url'))
                        <a href="{{ \App\Models\SchoolSetting::get('instagram_url') }}" class="w-8 h-8 rounded-lg flex items-center justify-center transition-all bg-white/10 hover:bg-white/20 hover:-translate-y-0.5 text-white">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider" style="color:rgba(255,215,0,0.9);">Kontak</h4>
                <ul class="space-y-3 text-sm" style="color:rgba(255,255,255,0.8);">
                    <li class="flex gap-3">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ \App\Models\SchoolSetting::get('school_address', '-') }}</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>{{ \App\Models\SchoolSetting::get('school_phone', '-') }}</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>{{ \App\Models\SchoolSetting::get('school_email', '-') }}</span>
                    </li>
                </ul>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider" style="color:rgba(255,215,0,0.9);">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm" style="color:rgba(255,255,255,0.8);">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors hover:underline">Beranda</a></li>
                    <li><a href="{{ route('posts.index') }}" class="hover:text-white transition-colors hover:underline">Berita & Pengumuman</a></li>
                    <li><a href="{{ route('archives.extracurriculars') }}" class="hover:text-white transition-colors hover:underline">Ekstrakurikuler</a></li>
                    <li><a href="{{ route('archives.achievements') }}" class="hover:text-white transition-colors hover:underline">Prestasi</a></li>
                    <li><a href="{{ route('archives.infrastructures') }}" class="hover:text-white transition-colors hover:underline">Fasilitas</a></li>
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs" style="border-color:rgba(255,255,255,0.15); color:rgba(255,255,255,0.5);">
            <p>&copy; {{ date('Y') }} {{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}. Hak cipta dilindungi.</p>
            <p>Di bawah naungan <span style="color:#FFD700;">Kementerian Agama RI</span></p>
        </div>
    </div>
</footer>

@livewireScripts
@stack('scripts')
</body>
</html>
