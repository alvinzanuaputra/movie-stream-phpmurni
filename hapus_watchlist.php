<?php
session_start();
include 'koneksi.php';

// Pastikan user telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil ID film dari parameter URL
$movie_id = isset($_GET['id']) ? $_GET['id'] : '';

// Pastikan ID film ada
if ($movie_id) {
    // Query untuk menghapus film dari watchlist
    $sql = "DELETE FROM watchlist WHERE username = ? AND movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $movie_id);

    if ($stmt->execute()) {
        // Setelah berhasil menghapus, tampilkan alert dan redirect ke daftar tonton
        echo "<script>alert('Film berhasil dihapus dari daftar tonton.'); window.location.href='daftar_tonton.php';</script>";
    } else {
        // Jika gagal, tampilkan alert dan redirect ke daftar tonton
        echo "<script>alert('Gagal menghapus film dari daftar tonton.'); window.location.href='daftar_tonton.php';</script>";
    }
} else {
    echo "<script>alert('Film tidak ditemukan.'); window.location.href='daftar_tonton.php';</script>";
}
?>
