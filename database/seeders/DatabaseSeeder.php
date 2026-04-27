<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Infrastructure;
use App\Models\Post;
use App\Models\SchoolSetting;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // 1. Admin User
        // =============================================
        $admin = User::firstOrCreate(
            ['email' => 'admin@madrasah.sch.id'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // =============================================
        // 2. School Settings (Profil Sekolah Default)
        // =============================================
        $settings = [
            'school_name'      => 'Madrasah Tsanawiyah Negeri 1',
            'school_tagline'   => 'Berilmu, Berakhlak, Berprestasi',
            'school_address'   => 'Jl. Pendidikan No. 1, Kecamatan Contoh, Kab. Contoh',
            'school_phone'     => '(0000) 000-0000',
            'school_email'     => 'info@madrasah.sch.id',
            'school_website'   => 'www.madrasah.sch.id',
            'principal_name'   => 'Drs. H. Abdullah, M.Pd.',
            'accreditation'    => 'A',
            'established_year' => '1985',
            'facebook_url'     => '#',
            'instagram_url'    => '#',
            'youtube_url'      => '#',
            'about_text'       => 'Madrasah kami berkomitmen untuk mencetak generasi yang berilmu, berakhlak mulia, dan berprestasi dalam bidang akademik maupun non-akademik. Dengan tenaga pendidik yang profesional dan fasilitas yang memadai, kami siap mendukung setiap siswa untuk meraih cita-cita terbaik mereka.',
        ];

        foreach ($settings as $key => $value) {
            SchoolSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }

        // =============================================
        // 3. Posts (Berita)
        // =============================================
        Post::factory(12)->published()->create([
            'user_id' => $admin->id,
        ]);

        // =============================================
        // 4. Teachers (Guru)
        // =============================================
        Teacher::factory(10)->create();

        // =============================================
        // 5. Infrastructures (Fasilitas)
        // =============================================
        $facilities = [
            ['name' => 'Ruang Kelas',            'condition' => 'baik',         'quantity' => 18, 'description' => 'Ruang kelas yang nyaman dan dilengkapi dengan AC dan proyektor.'],
            ['name' => 'Laboratorium IPA',       'condition' => 'baik',         'quantity' => 1,  'description' => 'Laboratorium lengkap untuk praktikum IPA, Fisika, dan Kimia.'],
            ['name' => 'Laboratorium Komputer',  'condition' => 'baik',         'quantity' => 1,  'description' => '40 unit komputer terhubung internet untuk pembelajaran TIK.'],
            ['name' => 'Perpustakaan',           'condition' => 'baik',         'quantity' => 1,  'description' => 'Koleksi lebih dari 5.000 buku pelajaran dan referensi islami.'],
            ['name' => 'Musholla',               'condition' => 'baik',         'quantity' => 1,  'description' => 'Tempat ibadah yang bersih dan luas untuk seluruh warga madrasah.'],
            ['name' => 'Lapangan Olahraga',      'condition' => 'baik',         'quantity' => 1,  'description' => 'Lapangan multifungsi untuk futsal, basket, dan upacara bendera.'],
            ['name' => 'Ruang UKS',              'condition' => 'baik',         'quantity' => 1,  'description' => 'Unit Kesehatan Sekolah yang dilengkapi obat-obatan dan tempat istirahat.'],
            ['name' => 'Kantin',                 'condition' => 'rusak_ringan', 'quantity' => 1,  'description' => 'Kantin sehat dengan menu bergizi dan halal untuk seluruh siswa.'],
        ];

        foreach ($facilities as $facility) {
            Infrastructure::create($facility);
        }

        // =============================================
        // 6. Extracurriculars (Ekskul)
        // =============================================
        $ekskuls = [
            ['name' => 'Pramuka',        'supervisor' => 'Ahmad Fauzi, S.Pd.',   'schedule' => "Jum'at, 14.00 - 16.00", 'description' => 'Kegiatan kepramukaan untuk membentuk karakter dan jiwa kepemimpinan siswa.'],
            ['name' => 'PMR',            'supervisor' => 'Siti Rahayu, S.Pd.',    'schedule' => 'Sabtu, 08.00 - 10.00',  'description' => 'Palang Merah Remaja — belajar pertolongan pertama dan kepedulian sosial.'],
            ['name' => 'Rohis',          'supervisor' => 'Ustadz M. Iqbal, S.Ag.','schedule' => "Jum'at, 13.00 - 15.00",'description' => 'Kerohanian Islam — kajian, dakwah, dan pengembangan aqidah siswa.'],
            ['name' => 'Seni Kaligrafi', 'supervisor' => 'Hasan Basri, S.Pd.I.', 'schedule' => 'Sabtu, 10.00 - 12.00',  'description' => 'Mempelajari seni menulis indah huruf Arab (kaligrafi) sebagai ekspresi seni Islam.'],
            ['name' => 'Futsal',         'supervisor' => 'Rudi Hartono, S.Pd.',  'schedule' => 'Rabu, 15.00 - 17.00',   'description' => 'Tim futsal madrasah yang aktif mengikuti kompetisi antar pelajar.'],
            ['name' => 'Hadroh',         'supervisor' => 'Ust. Wahyudi, S.Pd.I.','schedule' => 'Kamis, 14.00 - 16.00',  'description' => 'Seni musik Islami dengan rebana untuk melestarikan budaya dan syiar Islam.'],
        ];

        foreach ($ekskuls as $ekskul) {
            Extracurricular::create(array_merge($ekskul, ['is_active' => true]));
        }

        // =============================================
        // 7. Achievements (Prestasi)
        // =============================================
        $achievements = [
            ['name' => 'Juara 1',       'competition_type' => 'MTQ Tilawah Putra',        'level' => 'kabupaten',   'year' => 2024],
            ['name' => 'Juara 2',       'competition_type' => 'Olimpiade Matematika',      'level' => 'provinsi',    'year' => 2024],
            ['name' => 'Juara 1',       'competition_type' => 'Lomba Kaligrafi',           'level' => 'kabupaten',   'year' => 2024],
            ['name' => 'Juara 3',       'competition_type' => 'Lomba Futsal Pelajar',      'level' => 'kecamatan',   'year' => 2025],
            ['name' => 'Juara 1',       'competition_type' => 'Lomba Pidato Bahasa Arab',  'level' => 'provinsi',    'year' => 2023],
            ['name' => 'Juara Harapan 1','competition_type'=> 'Olimpiade IPA',             'level' => 'nasional',    'year' => 2023],
            ['name' => 'Juara 2',       'competition_type' => 'Lomba Hadroh',              'level' => 'kabupaten',   'year' => 2025],
            ['name' => 'Juara 1',       'competition_type' => 'Lomba Tahfidz Quran',       'level' => 'kecamatan',   'year' => 2025],
            ['name' => 'Juara 3',       'competition_type' => 'Olimpiade Bahasa Indonesia','level' => 'kabupaten',   'year' => 2024],
            ['name' => 'Juara 2',       'competition_type' => 'Lomba Pramuka Penggalang',  'level' => 'kabupaten',   'year' => 2024],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create(array_merge($achievement, ['description' => '']));
        }
    }
}
