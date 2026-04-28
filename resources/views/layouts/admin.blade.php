<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel Admin {{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}">
    <title>Admin — {{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}</title>
    @if(\App\Models\SchoolSetting::get('school_logo'))
        <link rel="icon" href="{{ asset('storage/' . \App\Models\SchoolSetting::get('school_logo')) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific styles (e.g. Quill.js) --}}
    @stack('styles')

    {{-- Livewire --}}
    @livewireStyles
</head>
<body style="background-color:#F8FAFC; font-family:'Plus Jakarta Sans',sans-serif;">

{{-- ============================================================
     LAYOUT WRAPPER
     ============================================================ --}}
<div
    x-data="{
        sidebarOpen: window.innerWidth >= 1024,
        mobileOpen: false,
        init() {
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) { this.mobileOpen = false; }
            });
        }
    }"
    class="min-h-screen flex"
>

    {{-- =============================================
         MOBILE OVERLAY
         ============================================= --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="fixed inset-0 bg-black/50 z-40 lg:hidden"
        style="display:none;"
    ></div>

    {{-- =============================================
         SIDEBAR
         ============================================= --}}
    <aside
        :style="sidebarOpen ? 'width:256px' : 'width:72px'"
        class="sidebar hidden lg:flex sticky top-0 h-screen"
        style="width:256px;"
    >
        {{-- Logo / Brand --}}
        <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10 flex-shrink-0">
            @if(\App\Models\SchoolSetting::get('school_logo'))
                <img src="{{ asset('storage/' . \App\Models\SchoolSetting::get('school_logo')) }}" alt="Logo" class="w-9 h-9 object-contain rounded-xl flex-shrink-0 bg-white p-0.5">
            @else
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:rgba(255,215,0,0.2)">
                    <svg class="w-5 h-5" fill="#FFD700" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            @endif
            <div x-show="sidebarOpen" x-transition class="overflow-hidden">
                <p class="text-white font-bold text-sm leading-tight truncate" style="max-width:160px;">
                    {{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}
                </p>
                <p class="text-xs" style="color:rgba(255,255,255,0.5);">Panel Admin</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto overflow-x-hidden py-3 px-2">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                {{-- Icon: Home --}}
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Dashboard</span>
            </a>

            {{-- Konten --}}
            <p class="sidebar-group-label" x-show="sidebarOpen" x-transition>Konten</p>
            <a href="{{ route('admin.posts.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4h4M8 13h8M8 17h4"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Berita</span>
            </a>

            {{-- Data Master --}}
            <p class="sidebar-group-label" x-show="sidebarOpen" x-transition>Data Master</p>
            <div x-data="{ openMenu: {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.settings') ? 'true' : 'false' }} }">
                <button @click="openMenu = !openMenu" 
                        class="sidebar-item w-full flex items-center justify-between {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.settings') ? 'text-green-700' : '' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span x-show="sidebarOpen" x-transition class="text-sm">Profil Sekolah</span>
                    </div>
                    <svg x-show="sidebarOpen" x-transition :class="openMenu ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openMenu && sidebarOpen" x-collapse>
                    <div class="pl-9 pr-2 py-1 space-y-1">
                        <a href="{{ route('admin.settings') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings') ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">Identitas & Kontak</a>
                        <a href="{{ route('admin.settings.about') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings.about') ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">Tentang Sejarah</a>
                        <a href="{{ route('admin.settings.vision-mission') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings.vision-mission') ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">Visi & Misi</a>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.teachers.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Data Guru</span>
            </a>
            <a href="{{ route('admin.infrastructures.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.infrastructures.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Infrastruktur</span>
            </a>
            <a href="{{ route('admin.extracurriculars.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.extracurriculars.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Ekstrakurikuler</span>
            </a>
            <a href="{{ route('admin.achievements.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Prestasi</span>
            </a>

            {{-- Pengaturan --}}
            <p class="sidebar-group-label" x-show="sidebarOpen" x-transition>Pengaturan</p>
            <a href="{{ route('admin.users.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span x-show="sidebarOpen" x-transition class="text-sm">Manajemen User</span>
            </a>
        </nav>

        {{-- Toggle Button (Desktop) --}}
        <div class="p-3 border-t border-white/10">
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="w-full flex items-center justify-center p-2 rounded-lg text-white/60 hover:text-white hover:bg-white/10 transition-all duration-200"
                :title="sidebarOpen ? 'Collapse sidebar' : 'Expand sidebar'"
            >
                <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
                <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </aside>

    {{-- Mobile Sidebar --}}
    <aside
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="sidebar lg:hidden fixed top-0 left-0 h-screen"
        style="width:256px; display:none;"
    >
        {{-- Same content as desktop sidebar tapi selalu expanded --}}
        <div class="flex items-center justify-between gap-3 px-4 py-5 border-b border-white/10">
            <div class="flex items-center gap-3">
                @if(\App\Models\SchoolSetting::get('school_logo'))
                    <img src="{{ asset('storage/' . \App\Models\SchoolSetting::get('school_logo')) }}" alt="Logo" class="w-9 h-9 object-contain rounded-xl flex-shrink-0 bg-white p-0.5">
                @else
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:rgba(255,215,0,0.2)">
                        <svg class="w-5 h-5" fill="#FFD700" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="text-white font-bold text-sm truncate" style="max-width:160px;">
                        {{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}
                    </p>
                    <p class="text-xs" style="color:rgba(255,255,255,0.5);">Panel Admin</p>
                </div>
            </div>
            <button @click="mobileOpen = false" class="text-white/60 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-3 px-2">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="text-sm">Dashboard</span>
            </a>
            <p class="sidebar-group-label">Konten</p>
            <a href="{{ route('admin.posts.index') }}" class="sidebar-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/></svg>
                <span class="text-sm">Berita</span>
            </a>
            <p class="sidebar-group-label">Data Master</p>
            <div x-data="{ openMenu: {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.settings') ? 'true' : 'false' }} }">
                <button @click="openMenu = !openMenu" 
                        class="sidebar-item w-full flex items-center justify-between {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.settings') ? 'bg-green-50 text-green-700' : '' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span class="text-sm">Profil Sekolah</span>
                    </div>
                    <svg :class="openMenu ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openMenu" x-collapse>
                    <div class="pl-9 pr-2 py-1 space-y-1">
                        <a href="{{ route('admin.settings') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings') ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">Identitas & Kontak</a>
                        <a href="{{ route('admin.settings.about') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings.about') ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">Tentang Sejarah</a>
                        <a href="{{ route('admin.settings.vision-mission') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings.vision-mission') ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">Visi & Misi</a>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.teachers.index') }}" class="sidebar-item {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="text-sm">Data Guru</span>
            </a>
            <a href="{{ route('admin.infrastructures.index') }}" class="sidebar-item {{ request()->routeIs('admin.infrastructures.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span class="text-sm">Infrastruktur</span>
            </a>
            <a href="{{ route('admin.extracurriculars.index') }}" class="sidebar-item {{ request()->routeIs('admin.extracurriculars.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-sm">Ekstrakurikuler</span>
            </a>
            <a href="{{ route('admin.achievements.index') }}" class="sidebar-item {{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <span class="text-sm">Prestasi</span>
            </a>
            <p class="sidebar-group-label">Pengaturan</p>
            <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span class="text-sm">Manajemen User</span>
            </a>
        </nav>
    </aside>

    {{-- =============================================
         MAIN CONTENT AREA
         ============================================= --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Top Header --}}
        <header class="bg-white border-b border-slate-100 px-4 lg:px-6 py-3 flex items-center justify-between flex-shrink-0" style="box-shadow:0 1px 3px rgba(0,0,0,0.06);">

            {{-- Mobile hamburger --}}
            <button @click="mobileOpen = true" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb / Page Title --}}
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <span class="font-medium text-slate-700">@yield('page-title', 'Dashboard')</span>
            </div>

            {{-- User Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button
                    @click="open = !open"
                    @click.away="open = false"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors"
                >
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold" style="background: linear-gradient(135deg, #006227, #009494);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-slate-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1 z-50"
                    style="display:none;"
                >
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Lihat Website
                    </a>
                    <a href="{{ route('admin.profile.password') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Ganti Password
                    </a>
                    <div class="h-px bg-slate-100 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Flash Messages (after redirect) --}}
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="mx-4 lg:mx-6 mt-4"
            >
                <div class="flash-success">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 5000)"
                x-show="show"
                class="mx-4 lg:mx-6 mt-4"
            >
                <div class="flash-error">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- Global Toast (untuk operasi Livewire tanpa redirect) --}}
        <div
            id="toast-container"
            x-data="toastManager()"
            @notify.window="add($event.detail)"
            class="fixed top-5 right-5 z-[200] flex flex-col gap-2 pointer-events-none"
            style="max-width: 360px;"
        >
            <template x-for="toast in toasts" :key="toast.id">
                <div
                    x-show="toast.visible"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 translate-x-8"
                    :class="toast.type === 'success' ? 'flash-success' : 'flash-error'"
                    class="pointer-events-auto shadow-lg w-full"
                >
                    <template x-if="toast.type === 'success'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    </template>
                    <span x-text="toast.message" class="text-sm font-medium"></span>
                </div>
            </template>
        </div>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            {{ $slot }}
        </main>
    </div>

</div>

@stack('scripts')

<script>
function toastManager() {
    return {
        toasts: [],
        add(detail) {
            const toast = {
                id: Date.now(),
                message: detail.message || detail,
                type: detail.type || 'success',
                visible: true,
            };
            this.toasts.push(toast);
            setTimeout(() => {
                toast.visible = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== toast.id);
                }, 300);
            }, 3500);
        }
    };
}

// Tangkap event Livewire dan teruskan ke Alpine toast
document.addEventListener('livewire:initialized', () => {
    Livewire.on('notify', (params) => {
        const detail = Array.isArray(params) ? params[0] : params;
        window.dispatchEvent(new CustomEvent('notify', { detail }));
    });
});
</script>

@livewireScripts
</body>
</html>
