<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';
?>

<main>
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>!</h2>
    <p>Anda login sebagai: <strong><?php echo ucfirst(htmlspecialchars($_SESSION['role'])); ?></strong></p>
    
    <div class="dashboard-content">
        <h3>Dashboard Aplikasi Parkir</h3>
        <p>Ini adalah halaman utama aplikasi. Fitur-fitur akan ditampilkan di sini sesuai dengan hak akses Anda.</p>
        
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="admin-features">
            <h4>Fitur Admin:</h4>
            <ul>
                <li>CRUD User</li>
                <li>CRUD Tarif Parkir</li>
                <li>CRUD Area Parkir</li>
                <li>Akses Log Aktivitas</li>
            </ul>
        </div>
        <?php endif; ?>

        <?php if ($_SESSION['role'] == 'petugas'): ?>
        <div class="petugas-features">
            <h4>Fitur Petugas:</h4>
            <ul>
                <li>Input Kendaraan Masuk</li>
                <li>Input Kendaraan Keluar</li>
                <li>Cetak Struk Parkir</li>
                <li>Lihat Daftar Kendaraan Parkir</li>
            </ul>
        </div>
        <?php endif; ?>

    </div>
</main>

<?php
require_once '../includes/footer.php';
?>
