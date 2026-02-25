<?php
require_once '../includes/auth_check.php';
require_once '../config/database.php';

// Fitur ini hanya untuk admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php?status=error&message=Anda tidak memiliki akses ke halaman ini.');
    exit();
}

// Inisialisasi variabel
$area = ['id_area' => '', 'nama_area' => '', 'kapasitas' => ''];
$form_action = '../actions/area_process.php';
$page_title = 'Tambah Area Parkir Baru';

// Cek apakah ini mode edit
if (isset($_GET['id'])) {
    $id_area = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM tb_area_parkir WHERE id_area = ?");
    $stmt->bind_param('i', $id_area);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $area = $result->fetch_assoc();
        $page_title = 'Edit Area Parkir';
    } else {
        header('Location: manage_areas.php?status=error&message=Area tidak ditemukan.');
        exit();
    }
    $stmt->close();
}

require_once '../includes/header.php';
?>

<main>
    <div class="form-container">
        <h2><?php echo $page_title; ?></h2>

        <form action="<?php echo $form_action; ?>" method="POST">
            <!-- Hidden input untuk ID saat edit -->
            <input type="hidden" name="id_area" value="<?php echo htmlspecialchars($area['id_area']); ?>">

            <div class="input-group">
                <label for="nama_area">Nama Area</label>
                <input type="text" id="nama_area" name="nama_area" value="<?php echo htmlspecialchars($area['nama_area']); ?>" required>
            </div>

            <div class="input-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" id="kapasitas" name="kapasitas" value="<?php echo htmlspecialchars($area['kapasitas']); ?>" required min="1">
            </div>

            <button type="submit" class="btn">Simpan Data</button>
        </form>
        <div class="back-link">
            <a href="manage_areas.php">Kembali ke Daftar Area</a>
        </div>
    </div>
</main>

<?php
$conn->close();
require_once '../includes/footer.php';
?>
