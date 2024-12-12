<?php
include 'koneksi.php'; // File untuk koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $actors = $_POST['actors'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];

    $poster_image = $_FILES['poster_image']['name'];
    $poster_tmp = $_FILES['poster_image']['tmp_name'];
    move_uploaded_file($poster_tmp, "img_movies/" . $poster_image);

    $trailer_url = $_POST['trailer_url'];

    $sql = "INSERT INTO movies (title, director, actors, release_year, genre, poster_image, trailer_url) 
            VALUES ('$title', '$director', '$actors', '$release_year', '$genre', '$poster_image', '$trailer_url')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Film Berhasil ditambah');
        window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambah film');
        window.location.href = 'dashboard.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Movies | Tambah Film</title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">
    <!-- Sidebar -->
    <h1 class="text-center text-2xl text-blue-500 pt-12 font-bold text-blue-400 ">Tambahkan Film Baru</h1>
    <div class="flex">
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="px-1 py-3 text-left text-white hover:text-blue-700 flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff" viewBox="0 0 256 256">
                    <path
                        d="M232,144a64.07,64.07,0,0,1-64,64H80a8,8,0,0,1,0-16h88a48,48,0,0,0,0-96H51.31l34.35,34.34a8,8,0,0,1-11.32,11.32l-48-48a8,8,0,0,1,0-11.32l48-48A8,8,0,0,1,85.66,45.66L51.31,80H168A64.07,64.07,0,0,1,232,144Z">
                    </path>
                </svg>
                <a href="dashboard.php" class="text-md font-semibold underline">Kembali ke Dashboard</a>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-2">Judul Film</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-2 rounded bg-gray-700 text-white"
                        required>
                </div>

                <div class="mb-4">
                    <label for="director" class="block text-sm font-medium mb-2">Sutradara</label>
                    <input type="text" name="director" id="director"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white" required>
                </div>

                <div class="mb-4">
                    <label for="actors" class="block text-sm font-medium mb-2">Aktor/Aktris</label>
                    <input type="text" name="actors" id="actors"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white">
                </div>

                <div class="mb-4">
                    <label for="release_year" class="block text-sm font-medium mb-2">Tahun Rilis</label>
                    <input type="number" name="release_year" id="release_year" min="1900" max="2099"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white" required>
                </div>

                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium mb-2">Genre</label>
                    <input type="text" name="genre" id="genre" class="w-full px-4 py-2 rounded bg-gray-700 text-white">
                </div>

                <div class="mb-4">
                    <label for="poster_image" class="block text-sm font-medium mb-2">Upload Poster Gambar</label>
                    <input type="file" name="poster_image" id="poster_image" accept="image/*"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white" required>
                    <img id="preview" src="#" alt="Preview Poster" class="hidden mt-4 rounded shadow-md w-40">
                </div>

                <div class="mb-4">
                    <label for="trailer_url" class="block text-sm font-medium mb-2">URL Trailer</label>
                    <input type="url" name="trailer_url" id="trailer_url"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white">
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Film</button>
            </form>
        </main>
    </div>
    <script>
        document.getElementById('poster_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>