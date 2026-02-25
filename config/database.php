<?php
// Konfigurasi Koneksi Database
// Sesuaikan detail berikut dengan konfigurasi XAMPP Anda.

$db_host = 'localhost';     // Biasanya 'localhost' untuk XAMPP
$db_user = 'root';          // User default MySQL di XAMPP
$db_pass = '';              // Password default MySQL di XAMPP adalah kosong
$db_name = 'area_parkir'; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mengatur karakter set ke utf8mb4 untuk mendukung karakter yang lebih luas
$conn->set_charset("utf8mb4");

?>
