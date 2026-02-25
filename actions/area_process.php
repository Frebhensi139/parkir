<?php
require_once '../includes/auth_check.php';
require_once '../config/database.php';

// Hanya untuk admin dan metode POST
if ($_SESSION['role'] !== 'admin' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/dashboard.php');
    exit();
}

// Ambil data dari form
$id_area = $_POST['id_area'];
$nama_area = trim($_POST['nama_area']);
$kapasitas = (int)$_POST['kapasitas'];

// Validasi dasar
if (empty($nama_area) || $kapasitas <= 0) {
    header('Location: ../pages/manage_areas.php?status=error&message=Nama area dan kapasitas harus diisi dengan benar.');
    exit();
}

// Tentukan apakah ini operasi INSERT atau UPDATE
if (empty($id_area)) {
    // === INSERT (Tambah Data Baru) ===
    $sql = "INSERT INTO tb_area_parkir (nama_area, kapasitas) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $nama_area, $kapasitas);

    if ($stmt->execute()) {
        header('Location: ../pages/manage_areas.php?status=success&message=Area parkir baru berhasil ditambahkan.');
    } else {
        header('Location: ../pages/manage_areas.php?status=error&message=Gagal menambahkan area: ' . $stmt->error);
    }
} else {
    // === UPDATE (Edit Data) ===
    $sql = "UPDATE tb_area_parkir SET nama_area = ?, kapasitas = ? WHERE id_area = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $nama_area, $kapasitas, $id_area);

    if ($stmt->execute()) {
        header('Location: ../pages/manage_areas.php?status=success&message=Data area berhasil diperbarui.');
    } else {
        header('Location: ../pages/manage_areas.php?status=error&message=Gagal memperbarui data: ' . $stmt->error);
    }
}

$stmt->close();
$conn->close();
exit();
?>
