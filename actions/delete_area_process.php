<?php
require_once '../includes/auth_check.php';
require_once '../config/database.php';

// Hanya untuk admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../pages/dashboard.php');
    exit();
}

// Cek apakah ID ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../pages/manage_areas.php?status=error&message=ID area tidak valid.');
    exit();
}

$id_area = (int)$_GET['id'];

// Hapus data dari database
$sql = "DELETE FROM tb_area_parkir WHERE id_area = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_area);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header('Location: ../pages/manage_areas.php?status=success&message=Area parkir berhasil dihapus.');
    } else {
        header('Location: ../pages/manage_areas.php?status=error&message=Area tidak ditemukan atau sudah dihapus.');
    }
} else {
    header('Location: ../pages/manage_areas.php?status=error&message=Gagal menghapus area: ' . $stmt->error);
}

$stmt->close();
$conn->close();
exit();
?>
