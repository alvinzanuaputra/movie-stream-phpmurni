<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus film berdasarkan ID
    $sql = "DELETE FROM movies WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Jika penghapusan berhasil
        echo "<script>
        alert('Film Berhasil Dihapus');
        window.location.href = 'dashboard.php'; // Redirect ke dashboard setelah sukses
        </script>";
    } else {
        // Jika penghapusan gagal
        echo "<script>
        alert('Gagal
        alert('Gagal menghapus film');
        window.location.href = 'dashboard.php'; // Redirect ke dashboard setelah gagal
        </script>";
    }
} else {
    // Jika ID tidak ditemukan dalam URL
    echo "<script>
    alert('ID film tidak ditemukan.');
    window.location.href = 'dashboard.php'; // Redirect ke dashboard jika ID tidak ada
    </script>";
}
?>