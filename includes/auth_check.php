<?php
session_start();

// Jika tidak ada session user_id, artinya pengguna belum login
// Redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/index.php');
    exit();
}
?>
