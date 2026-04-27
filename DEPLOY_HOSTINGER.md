# Panduan Lengkap Deploy Website Madrasah ke Hostinger / Niagahoster

Karena aplikasi madrasah ini dibangun di atas kerangka *Laravel* dan dipadukan dengan *Vite* (Tailwind & Livewire), proses perilisan (*deployment*) ke layanan *Shared Hosting* bervolume cPanel atau hPanel (Hostinger) perlu perlakuan khusus demi menjamin keamanan data dan sistem.

Berikut adalah langkah-langkah praktis dan paling aman untuk mengudara di layanan Hostinger.

---

## TAHAP 1: Persiapan File di Komputer Lokal

Sebelum file dipindah, kerangkanya harus dirampingkan dan disiapkan agar siap bekerja dalam wujud produksi. Buka Terminal/CMD Anda di dalam folder projek `sekolahku`, lalu jalankan:

1. **Build Aset Frontend (CSS/JS)**  
   ```bash
   npm run build
   ```
   *Langkah ini memastikan desain Tailwind CSS telah dijahit dengan padat. Anda sudah melakukan ini di tahap sebelumnya.*

2. **Bersihkan Cache**  
   ```bash
   php artisan optimize:clear
   ```

3. **Kompresi File (Zip)**  
   Pada File Explorer (Windows), sorot semua isi folder projek Anda (mulai dari folder `app`, `bootstrap`, `public`, `.env`, konfigurasi, dan semuanya), klik kanan, pilih **"Send to -> Compressed (zipped) folder"**. Beri nama `sekolahku-produksi.zip`. 
   > **Perhatian:** Jangan ikut sertakan *folder* `node_modules` karena akan membuat ukuran meledak hebat. *Folder* `vendor` wajib ikut karena shared hosting terkadang kesulitan menjalankan Composer.

---

## TAHAP 2: Pembuatan Database di Hostinger

1. Masuk ke panel kontrol hosting Anda (hPanel Hostinger).
2. Cari menu **Database Management** atau **Manajemen Database**.
3. Buatlah Database MySQL Baru:
   - **Database Name:** (Sesuai keinginan, misalnya: `u12345_madrasah`)
   - **Database Username:** (Misalnya: `u12345_admin`)
   - **Password:** (Gunakan kata sandi yang rumit & kuat)
4. *Catat persis nama database, username, dan password tersebut. Anda akan membutuhkannya sesaat lagi.*

---

## TAHAP 3: Unggah dan Ekstrak Berkas

Metode teraman di Laravel adalah meletakkan file sistem di belakang layar, dan hanya `public` yang diarahkan ke domain. Karena hPanel dari Hostinger mendukung perubahan Letak Dokumen Utama (*Document Root*), langkahnya cukup mudah:

1. Buka menu **File Manager**.
2. Masuk ke ruang penyimpanan utama domain Anda (biasanya folder bernama `domains/namadomain.com/public_html`).
3. Hapuskan file awalan bebas seperti `default.php` atau `index.php` basi yang mungkin ada.
4. **Unggah (Upload)** berkas `sekolahku-produksi.zip` yang telah kita buat ke folder pangkalan ini.
5. Klik Kanan file Zip tersebut, lalu pilih **Extract**. Izinkan hasil ekstraksi mekar membanjiri bagian `public_html` tersebut.
6. Hapus file Zip-nya untuk meluangkan ruang *server*.

---

## TAHAP 4: Mengarahkan Alamat Web (Document Root)

Karena file mesin penggerak (`app`, `routes`, dll) dilarang terekspos secara publik, server harus dititahkan untuk hanya melihat ke dalam folder `/public`.

1. Kembali ke Dashboard hPanel utama Hostinger.
2. Cari dan klik menu konfigurasi **Websites** -> klik **Manage** pada domain Anda.
3. Cari kotak menu penyetingan **Document Root** atau **Lokasi File Website** (biasanya di bawah opsi Setelan PHP atau Web Details).
4. Ganti target foldernya (yang biasanya diakhiri tulisan `/public_html`) menjadi: `/public_html/public`
5. Tekan **Save / Simpan**.

---

## TAHAP 5: Persambungan Database & Pengaturan Keamanan (.env)

Masih dalam **File Manager**:
1. Cari berkas `.env` (pastikan pengaturan "Lihat Daftar File Tersembunyi" di File Manager menyala).
2. Edit file tersebut, dan ubah susunannya menjadi wujud produksi:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://namadomainmadrasah.sch.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u12345_madrasah
DB_USERNAME=u12345_admin
DB_PASSWORD=KataSandiHostingerAnda!
```
*(Ganti nama database & pengguna sesuai Tahap 2).*

---

## TAHAP 6: Melahirkan Kerangka Basis Data (Migrasi Akhir)

*Shared Hosting* tidak memiliki perintah Terminal interaktif secara gamblang. Untuk menjalankan proses pemasangan tabel layaknya perintah `php artisan migrate`, Hostinger menyediakan **SSH Access**.

**Cara A (Menggunakan SSH Hostinger - Sangat Disarankan):**
1. Buka fitur **SSH Access** di hPanel.
2. Hubungkan Terminal Komputer Anda (`ssh u12345@18X.XX.XX.XX -p 65002`).
3. Arahkan direktori (contoh: `cd domains/namadomain.com/public_html`)
4. Jalankan perintah migrasi ini secara berurutan:
   ```bash
   php artisan migrate:fresh --seed --force
   ```
   *(Ini otomatis memasang tabel sekaligus menambahkan Akun Administrator bawaan kita).*

5. Lanjutkan agar foto-guru dan galeri bisa terbuka secara publik:
   ```bash
   php artisan storage:link
   ```

**Cara B (Bila SSH ditolak/dibatasi):**
Ekspor *Database* MySQL lokal (komputer Anda - XAMPP) menjadi file SQL. Masuk ke **phpMyAdmin** dari Hostinger, dan pilih *Import* untuk mengunggah struktur Database SQL komplitnya ke sana.

---

> 🎉 **Keberhasilan!**
> Segarkan laman `https://namadomainmadrasah.sch.id` di peramban Anda. Aplikasi Madrasah telah beroperasi dalam skala dunia layaknya situs Kemenag nasional. Jangan lupa tes fungsionalitas Upload Foto untuk memastikan `storage:link` berjalan sempurna.
