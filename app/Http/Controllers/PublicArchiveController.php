<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Infrastructure;
use App\Models\Teacher;

class PublicArchiveController extends Controller
{
    public function teachers()
    {
        $teachers = Teacher::active()->paginate(12);
        return view('public.archives.teachers', compact('teachers'));
    }

    public function infrastructures()
    {
        $infrastructures = Infrastructure::orderBy('name')->paginate(12);
        return view('public.archives.infrastructures', compact('infrastructures'));
    }

    public function extracurriculars()
    {
        $extracurriculars = Extracurricular::active()->latest()->paginate(12);
        return view('public.archives.extracurriculars', compact('extracurriculars'));
    }

    public function achievements()
    {
        $achievements = Achievement::orderByDesc('year')->paginate(12);
        return view('public.archives.achievements', compact('achievements'));
    }
}
