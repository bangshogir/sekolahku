<x-layouts.app :title="'Visi & Misi | ' . \App\Models\SchoolSetting::get('school_name', 'Madrasah')">

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20 animate-fade-in">

    {{-- Header --}}
    <div class="text-center mb-12">
        <div class="text-xs font-bold uppercase tracking-widest mb-3" style="color:#009494;">Arah & Tujuan Madrasah</div>
        <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Visi & Misi</h1>
        <div class="w-24 h-1 mx-auto rounded-full bg-gradient-to-r from-green-600 to-teal-500"></div>
    </div>

    {{-- Content Area --}}
    <div class="card p-8 lg:p-12 shadow-sm border border-slate-100 bg-white">
        @if(empty(trim(strip_tags(\App\Models\SchoolSetting::get('vision_mission_content', '')))))
            <div class="text-center py-16 text-slate-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <p class="font-medium text-lg">Informasi Visi & Misi Sedang Disiapkan</p>
                <p class="text-sm mt-2">Konten arah dan tujuan madrasah akan segera diperbarui.</p>
            </div>
        @else
            <article class="prose prose-slate prose-lg max-w-none hover:prose-a:text-green-600 prose-a:text-green-700 prose-headings:text-slate-800 prose-img:rounded-xl">
                {!! \App\Models\SchoolSetting::get('vision_mission_content', '') !!}
            </article>
        @endif
    </div>

</div>

</x-layouts.app>
