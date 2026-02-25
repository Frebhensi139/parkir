<?php
require_once '../includes/auth_check.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Hanya izinkan metode POST
    header('Location: ../pages/update_password.php');
    exit();
}

// Ambil data dari form
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_new_password = $_POST['confirm_new_password'];
$user_id = $_SESSION['user_id'];

// 1. Validasi input tidak kosong
if (empty($old_password) || empty($new_password) || empty($confirm_new_password)) {
    header('Location: ../pages/dashboard.php?status=error&message=Semua field harus diisi.');
    exit();
}

// 2. Cek apakah password baru dan konfirmasi cocok
if ($new_password !== $confirm_new_password) {
    header('Location: ../pages/dashboard.php?status=error&message=Password baru dan konfirmasi tidak cocok.');
    exit();
}

// 3. Ambil hash password saat ini dari database
$stmt = $conn->prepare("SELECT password FROM tb_user WHERE id_user = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    // Seharusnya tidak terjadi jika user sudah login
    header('Location: ../pages/dashboard.php?status=error&message=User tidak ditemukan.');
    exit();
}

$user = $result->fetch_assoc();
$current_password_hash = $user['password'];

// 4. Verifikasi password lama
if ($old_password !== $current_password_hash) {
    header('Location: ../pages/dashboard.php?status=error&message=Password lama salah.');
    exit();
}

// 5. Gunakan password baru sebagai teks biasa
$new_plain_password = $new_password;

// 6. Update password baru ke database
$update_stmt = $conn->prepare("UPDATE tb_user SET password = ? WHERE id_user = ?");
$update_stmt->bind_param('si', $new_plain_password, $user_id);

if ($update_stmt->execute()) {
    // Berhasil diupdate
    header('Location: ../pages/dashboard.php?status=success&message=Password berhasil diubah.');
} else {
    // Gagal diupdate
    header('Location: ../pages/dashboard.php?status=error&message=Gagal mengubah password. Silakan coba lagi.');
}

$stmt->close();
$update_stmt->close();
$conn->close();
exit();
?>
