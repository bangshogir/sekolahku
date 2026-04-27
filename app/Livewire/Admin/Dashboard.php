<?php

namespace App\Livewire\Admin;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Infrastructure;
use App\Models\Post;
use App\Models\Teacher;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            [
                'label'      => 'Total Berita',
                'value'      => Post::count(),
                'published'  => Post::published()->count() . ' dipublish',
                'icon_color' => '#006227',
                'bg_color'   => '#e6f4ec',
                'icon'       => 'document',
                'link'       => route('admin.posts.index'),
            ],
            [
                'label'      => 'Data Guru',
                'value'      => Teacher::count(),
                'published'  => Teacher::where('is_active', true)->count() . ' aktif',
                'icon_color' => '#009494',
                'bg_color'   => '#e0f5f5',
                'icon'       => 'users',
                'link'       => route('admin.teachers.index'),
            ],
            [
                'label'      => 'Ekstrakurikuler',
                'value'      => Extracurricular::count(),
                'published'  => Extracurricular::where('is_active', true)->count() . ' aktif',
                'icon_color' => '#7c3aed',
                'bg_color'   => '#ede9fe',
                'icon'       => 'star',
                'link'       => route('admin.extracurriculars.index'),
            ],
            [
                'label'      => 'Prestasi',
                'value'      => Achievement::count(),
                'published'  => Achievement::where('year', date('Y'))->count() . ' tahun ini',
                'icon_color' => '#d97706',
                'bg_color'   => '#fef3c7',
                'icon'       => 'trophy',
                'link'       => route('admin.achievements.index'),
            ],
        ];

        $recentPosts = Post::with('user')->latest()->limit(5)->get();

        return view('livewire.admin.dashboard', compact('stats', 'recentPosts'))
            ->layout('layouts.admin')
            ->title('Dashboard');
    }
}
