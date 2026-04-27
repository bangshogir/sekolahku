<?php
$files = [
    'users/user-list.blade.php',
    'teachers/teacher-list.blade.php',
    'posts/post-list.blade.php',
    'infrastructures/infrastructure-list.blade.php',
    'extracurriculars/extracurricular-list.blade.php',
    'dashboard.blade.php',
    'achievements/achievement-list.blade.php',
];

$dir = 'c:\\xampp\\htdocs\\sekolahku\\resources\\views\\livewire\\admin\\';

$editIcon = ' title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>';
$hapusIcon = ' title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>';

foreach ($files as $f) {
    if (file_exists($dir.$f)) {
        $content = file_get_contents($dir.$f);
        $content = preg_replace('/class="([^"]*btn-ghost[^"]*)"\s*>Edit<\/a>/', 'class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent"'.$editIcon.'</a>', $content);
        $content = preg_replace('/class="([^"]*btn-danger[^"]*)"\s*>Hapus<\/button>/', 'class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent"'.$hapusIcon.'</button>', $content);
        file_put_contents($dir.$f, $content);
        echo "Updated $f\n";
    }
}
echo "Done";
