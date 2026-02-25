# Aplikasi Parkir Sederhana (PHP & MySQL)

Aplikasi web ini dibuat untuk memenuhi tugas Uji Kompetensi Keahlian Rekayasa Perangkat Lunak dengan judul "Pengembangan Aplikasi Parkir".

## Teknologi yang Digunakan
- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript (minimal)
- **Database**: MySQL / MariaDB
- **Server Lokal**: XAMPP

## Struktur Folder

- `/config/` - Berisi file konfigurasi, terutama untuk koneksi database.
- `/public/` - Folder utama yang akan diakses melalui browser. Berisi `index.php` (halaman login), CSS, dan JavaScript.
- `/pages/` - Berisi file-file halaman utama aplikasi setelah pengguna login (misal: dashboard).
- `/includes/` - Berisi file-file PHP yang digunakan berulang kali, seperti header, footer, dan sistem otentikasi.
- `/actions/` - Berisi file-file PHP yang bertugas memproses form (misal: proses login, tambah data, dll).
- `database.sql` - File SQL yang berisi struktur tabel database. Anda bisa mengimpor file ini ke phpMyAdmin.

---

## Langkah-Langkah Instalasi Lokal dengan XAMPP

1.  **Unduh dan Instal XAMPP**
    -   Kunjungi situs resmi [Apache Friends](https://www.apachefriends.org/index.html) dan unduh XAMPP versi terbaru yang sesuai dengan sistem operasi Anda.
    -   Instal XAMPP di komputer Anda. Disarankan untuk menginstalnya di lokasi default (misal: `C:\xampp`).

2.  **Jalankan Apache dan MySQL**
    -   Buka **XAMPP Control Panel**.
    -   Klik tombol **Start** di sebelah modul **Apache** dan **MySQL** hingga keduanya berwarna hijau.

3.  **Salin File Aplikasi ke Folder `htdocs`**
    -   Salin semua file dan folder dari proyek aplikasi parkir ini.
    -   Tempelkan ke dalam folder `htdocs` di dalam direktori instalasi XAMPP Anda (misal: `C:\xampp\htdocs\aplikasi_parkir`). Anda bisa membuat folder baru bernama `aplikasi_parkir` atau nama lain yang Anda inginkan.

4.  **Buat Database di phpMyAdmin**
    -   Buka browser Anda dan akses `http://localhost/phpmyadmin`.
    -   Klik tab **Database**.
    -   Pada kolom "Create database", masukkan nama database yang Anda inginkan (misal: `area_parkir`), lalu klik **Create**.

5.  **Impor Struktur Tabel**
    -   Setelah database dibuat, pilih database tersebut dari daftar di sebelah kiri.
    -   Klik tab **Import**.
    -   Klik tombol "Choose File" dan pilih file `database.sql` yang ada di dalam folder proyek ini.
    -   Gulir ke bawah dan klik tombol **Go**. Tunggu hingga proses impor selesai. Semua tabel yang dibutuhkan akan otomatis dibuat.

6.  **Konfigurasi Koneksi Database**
    -   Buka file `/config/database.php` menggunakan teks editor.
    -   Pastikan konfigurasinya sesuai dengan pengaturan XAMPP Anda. Secara default, konfigurasinya adalah sebagai berikut:
        ```php
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = ''; // Password kosong
        $db_name = 'area_parkir'; // Sesuaikan dengan nama database yang Anda buat di langkah 4
        ```
    -   Simpan file jika ada perubahan.

7.  **Akses Aplikasi**
    -   Buka kembali browser Anda.
    -   Akses aplikasi melalui URL: `http://localhost/nama_folder_proyek/public/`
    -   Contoh: `http://localhost/aplikasi_parkir/public/`
    -   Halaman login akan muncul. Anda siap menggunakan aplikasi.

## Akun Default

Anda bisa menambahkan akun default melalui phpMyAdmin di tabel `tb_user` atau membuat fitur registrasi.

-   **Username**: admin
-   **Password**: admin123 (Password harus di-hash menggunakan `password_hash()` di PHP)

