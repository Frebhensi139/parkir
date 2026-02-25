<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';
?>

<main>
    <div class="form-container">
        <h2>Ubah Password Anda</h2>

        <?php
        // Tampilkan pesan sukses atau error dari proses update
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $message = htmlspecialchars($_GET['message']);
            echo "<div class='message {$status}'>{$message}</div>";
        }
        ?>

        <form action="../actions/update_password_process.php" method="POST">
            <div class="input-group">
                <label for="old_password">Password Lama</label>
                <input type="password" id="old_password" name="old_password" required>
            </div>
            <div class="input-group">
                <label for="new_password">Password Baru</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-group">
                <label for="confirm_new_password">Konfirmasi Password Baru</label>
                <input type="password" id="confirm_new_password" name="confirm_new_password" required>
            </div>
            <button type="submit" class="btn">Update Password</button>
        </form>
        <div class="back-link">
            <a href="dashboard.php">Kembali ke Dashboard</a>
        </div>
    </div>
</main>

<?php
require_once '../includes/footer.php';
?>
