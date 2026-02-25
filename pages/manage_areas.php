<?php
require_once '../includes/auth_check.php';
require_once '../config/database.php';

// Fitur ini hanya untuk admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php?status=error&message=Anda tidak memiliki akses ke halaman ini.');
    exit();
}

require_once '../includes/header.php';

// Ambil semua data area parkir
$result = $conn->query("SELECT * FROM tb_area_parkir ORDER BY nama_area ASC");

?>

<main>
    <div class="container-fluid">
        <h2 class="list-title">Kelola Area Parkir</h2>

        <?php
        // Tampilkan pesan sukses atau error
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $message = htmlspecialchars($_GET['message']);
            echo "<div class='message {$status}'>{$message}</div>";
        }
        ?>

        <a href="area_form.php" class="btn btn-primary mb-3">Tambah Area Baru</a>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Area</th>
                        <th>Nama Area</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id_area']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_area']); ?></td>
                                <td><?php echo htmlspecialchars($row['kapasitas']); ?></td>
                                <td><?php echo htmlspecialchars($row['terisi']); ?></td>
                                <td class="action-links">
                                    <a href="area_form.php?id=<?php echo $row['id_area']; ?>" class="btn-edit">Edit</a>
                                    <a href="../actions/delete_area_process.php?id=<?php echo $row['id_area']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus area ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Belum ada data area parkir.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
$conn->close();
require_once '../includes/footer.php';
?>
