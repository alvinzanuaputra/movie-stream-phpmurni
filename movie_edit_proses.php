<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $director = $_POST['director'];
    $actors = $_POST['actors'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $trailer_url = $_POST['trailer_url'];

    // Cek apakah ada poster baru
    if ($_FILES['poster_image']['name']) {
        $poster_image = $_FILES['poster_image']['name'];
        $poster_tmp = $_FILES['poster_image']['tmp_name'];
        move_uploaded_file($poster_tmp, "img_movies/" . $poster_image);
    } else {
        // Jika tidak ada poster baru, gunakan poster yang lama
        $poster_image = $_POST['poster_image_lama'];
    }

    // Update data film ke database
    $sql = "UPDATE movies SET title = '$title', director = '$director', actors = '$actors', release_year = '$release_year', genre = '$genre', poster_image = '$poster_image', trailer_url = '$trailer_url' WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Film berhasil diperbarui');
        window.location.href = 'dashboard.php'; // Redirect ke dashboard
        </script>";
    } else {
        echo "<script>
        alert('Gagal memperbarui film');
        window.location.href = 'dashboard.php'; // Redirect ke dashboard
        </script>";
    }
}
?>
