<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Infrastructure;
use App\Models\Post;
use App\Models\SchoolSetting;
use App\Models\Teacher;

class HomeController extends Controller
{
    public function index()
    {
        $settings        = SchoolSetting::getAllSettings();
        $latestPosts     = Post::published()->latest('published_at')->limit(6)->get();
        $teachers        = Teacher::active()->limit(8)->get();
        $extracurriculars = Extracurricular::active()->latest()->get();
        $achievements    = Achievement::orderByDesc('year')->limit(8)->get();
        $infrastructures = Infrastructure::orderBy('name')->get();

        // Stats counter
        $stats = [
            'posts'           => Post::published()->count(),
            'teachers'        => Teacher::where('is_active', true)->count(),
            'extracurriculars'=> Extracurricular::where('is_active', true)->count(),
            'achievements'    => Achievement::count(),
        ];

        return view('public.home', compact(
            'settings', 'latestPosts', 'teachers',
            'extracurriculars', 'achievements', 'infrastructures', 'stats'
        ));
    }
}
