<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header('Location: ../public/index.php?error=Username dan password tidak boleh kosong');
        exit();
    }

    // Menggunakan prepared statement untuk keamanan
    $sql = "SELECT id_user, password, role, nama_lengkap FROM tb_user WHERE username = ? AND status_aktif = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if ($password === $user['password']) {
            // Jika password cocok, simpan data ke session
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['role'];

            // Redirect ke dashboard
            header('Location: ../pages/dashboard.php');
            exit();
        } else {
            // Jika password salah
            header('Location: ../public/index.php?error=Username atau password salah');
            exit();
        }
    } else {
        // Jika user tidak ditemukan
        header('Location: ../public/index.php?error=Username atau password salah');
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika bukan metode POST, redirect ke halaman login
    header('Location: ../public/index.php');
    exit();
}
?>
