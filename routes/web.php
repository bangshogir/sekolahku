<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/berita', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::view('/tentang-kami', 'public.pages.about')->name('about');
Route::view('/visi-misi', 'public.pages.vision-mission')->name('vision-mission');

// Arsip Publik
Route::get('/tenaga-pendidik', [\App\Http\Controllers\PublicArchiveController::class, 'teachers'])->name('archives.teachers');
Route::get('/fasilitas-sekolah', [\App\Http\Controllers\PublicArchiveController::class, 'infrastructures'])->name('archives.infrastructures');
Route::get('/ekstrakurikuler', [\App\Http\Controllers\PublicArchiveController::class, 'extracurriculars'])->name('archives.extracurriculars');
Route::get('/prestasi-madrasah', [\App\Http\Controllers\PublicArchiveController::class, 'achievements'])->name('archives.achievements');

// Download template CSV
Route::get('/templates/teachers', function () {
    $file = public_path('templates/teachers_template.csv');
    return response()->download($file, 'template_data_guru.csv', [
        'Content-Type'        => 'text/csv',
        'Content-Disposition' => 'attachment; filename="template_data_guru.csv"',
    ]);
})->name('templates.teachers');

/*
|--------------------------------------------------------------------------
| Auth Routes (Guest only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Auth + Admin role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('dashboard');

    // Berita
    Route::get('/posts',              \App\Livewire\Admin\Posts\PostList::class)->name('posts.index');
    Route::get('/posts/create',       \App\Livewire\Admin\Posts\PostForm::class)->name('posts.create');
    Route::get('/posts/{post}/edit',  \App\Livewire\Admin\Posts\PostForm::class)->name('posts.edit');

    // Guru
    Route::get('/teachers',               \App\Livewire\Admin\Teachers\TeacherList::class)->name('teachers.index');
    Route::get('/teachers/create',        \App\Livewire\Admin\Teachers\TeacherForm::class)->name('teachers.create');
    Route::get('/teachers/{teacher}/edit',\App\Livewire\Admin\Teachers\TeacherForm::class)->name('teachers.edit');

    // Infrastruktur
    Route::get('/infrastructures',                      \App\Livewire\Admin\Infrastructures\InfrastructureList::class)->name('infrastructures.index');
    Route::get('/infrastructures/create',               \App\Livewire\Admin\Infrastructures\InfrastructureForm::class)->name('infrastructures.create');
    Route::get('/infrastructures/{infrastructure}/edit',\App\Livewire\Admin\Infrastructures\InfrastructureForm::class)->name('infrastructures.edit');

    // Ekstrakurikuler
    Route::get('/extracurriculars',                        \App\Livewire\Admin\Extracurriculars\ExtracurricularList::class)->name('extracurriculars.index');
    Route::get('/extracurriculars/create',                 \App\Livewire\Admin\Extracurriculars\ExtracurricularForm::class)->name('extracurriculars.create');
    Route::get('/extracurriculars/{extracurricular}/edit', \App\Livewire\Admin\Extracurriculars\ExtracurricularForm::class)->name('extracurriculars.edit');

    // Prestasi
    Route::get('/achievements',                   \App\Livewire\Admin\Achievements\AchievementList::class)->name('achievements.index');
    Route::get('/achievements/create',            \App\Livewire\Admin\Achievements\AchievementForm::class)->name('achievements.create');
    Route::get('/achievements/{achievement}/edit',\App\Livewire\Admin\Achievements\AchievementForm::class)->name('achievements.edit');

    // Profil Sekolah
    Route::get('/settings', \App\Livewire\Admin\SchoolSettings::class)->name('settings');
    Route::get('/settings/about', \App\Livewire\Admin\Pages\AboutPage::class)->name('settings.about');
    Route::get('/settings/vision-mission', \App\Livewire\Admin\Pages\VisionMissionPage::class)->name('settings.vision-mission');

    // Manajemen User
    Route::get('/users',              \App\Livewire\Admin\Users\UserList::class)->name('users.index');
    Route::get('/users/create',       \App\Livewire\Admin\Users\UserForm::class)->name('users.create');
    Route::get('/users/{user}/edit',  \App\Livewire\Admin\Users\UserForm::class)->name('users.edit');
});
