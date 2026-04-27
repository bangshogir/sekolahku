# Dokumentasi Proyek: Website Madrasah

## 1. Gambaran Umum (Overview)
Proyek ini adalah sistem informasi berbasis web (Website Sekolah / Madrasah) yang difungsikan untuk mempublikasikan informasi sekolah kepada masyarakat. Selain sebagai portal informasi publik, aplikasi ini juga memiliki **Admin Panel** yang lengkap untuk mengelola konten dan data sekolah secara dinamis (CMS).

## 2. Teknologi Utama (Tech Stack)
Aplikasi ini dibangun menggunakan arsitektur *Monolithic* modern (TALL stack):
- **Bahasa Pemrograman:** PHP `^8.2`
- **Framework Backend:** Laravel `^12.0`
- **Framework Frontend:** Livewire `^4.2` (untuk interaktivitas sisi klien dan antarmuka reaktif tanpa perlu menulis Javascript secara manual)
- **Styling:** Tailwind CSS `^4.0`
- **Asset Bundling:** Vite `^7.0`
- **Database:** MySQL Server (dikelola melalui XAMPP di *local environment*)

## 3. Fitur & Modul Utama
Aplikasi ini memisahkan fitur hak akses ke dalam interaksi Publik dan Admin. 

### A. Fitur Publik (Front-End)
Dapat diakses secara bebas tanpa otentikasi:
- **Beranda / Halaman Utama (`/`)**
- **Portal Berita (`/berita` & `/berita/{slug}`)**

### B. Fitur Admin Panel (Back-End)
Diakses melalui prefix `/admin`, dikhususkan untuk role admin guna mengelola data:
- **Dashboard:** Menampilkan ringkasan data aplikasi.
- **Manajemen Berita (Posts):** CRUD artikel/berita yang dipublikasikan.
- **Manajemen Guru (Teachers):** Pencatatan data dan profil staf pendidik.
- **Manajemen Infrastruktur (Infrastructures):** Pencatatan fasilitas yang dimiliki sekolah.
- **Manajemen Ekstrakurikuler (Extracurriculars):** Mendata program pengembangan diri dan kegiatan siswa di luar jam tatap muka.
- **Manajemen Prestasi (Achievements):** Mendokumentasikan lomba dan prestasi yang diraih.
- **Pangaturan Sekolah (School Settings):** Master data untuk mengatur nama sekolah, logo, narasi profil, dan lain sebagainya.
- **Manajemen Pengguna (Users):** Pendelegasian akses sistem kepada staf/operator lain.

## 4. Struktur Database
Berdasarkan *migrations*, tabel-tabel data operasional utama proyek meliputi:
1. `users` (Dengan ekstensi kolom akses tingkat `role`)
2. `posts`
3. `teachers`
4. `infrastructures`
5. `extracurriculars`
6. `achievements`
7. `school_settings`

## 5. Pola Arsitektur MVC & Integrasi Livewire
Proyek Laravel ini menerapkan modifikasi pada pola implementasi MVC klasik dengan memanfaatkan **Livewire**.
- **Controllers** (di `app/Http/Controllers/`): Bertugas melayani *Routes* publik (`HomeController`, `PostController`).
- **Livewire Components** (di `app/Livewire/`): Mendominasi aspek manajemen *Back-End* CMS pada folder `Admin`. Komponen pada rute admin dirancang dengan pola klasifikasi seragam:
  - Kelas *List* (`ModelList.php`) untuk me-render antarmuka Data-Table utama modul.
  - Kelas *Form* (`ModelForm.php`) untuk me-render aksi pembuatan dan pembaruan entitas.
- **Livewire Views** (di `resources/views/livewire/`): Lapisan antarmuka Blade untuk melengkapi aksi dalam Komponen Livewire.

## 6. Routing & Middleware
Alur rute di `web.php` diarahkan dengan keamanan spesifik:
- `guest` middleware untuk mencegah pengguna yang sudah mempunyai sesi untuk memuat ulang formulir *Login*.
- `auth` & `admin` middleware dikombinasikan dan dijaga pada group rute sistem panel (`/admin/*`) untuk melakukan restriksi ketat membatasi agar hanya *user login berdinas administrator* yang bisa mengakses fitur CMS ini.

## 7. Catatan Teknis / Pemecahan Masalah Penolakan Koneksi (Connection Refused)
Masalah `SQLSTATE[HY000] [2002]` sebelumnya secara murni terjadi karena mesin DBMS (MySQL di *XAMPP*) dalam kondisi tidak berjalan (mati) saat inisiasi sesi aplikasi. Solusinya adalah dengan memastikan server lokal (XAMPP control panel) telah menyalakan layanan "MySQL" agar siap mendengarkan interaksi aplikasi Laravel via koneksi port `3306`.
