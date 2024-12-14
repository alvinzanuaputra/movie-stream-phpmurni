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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">
    <!-- Sidebar -->
    <h1 class="text-center text-2xl text-blue-500 pt-12 font-bold text-blue-400 ">Tambahkan Film Baru</h1>
    <div class="inline-block">
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
            <form action="" method="POST" enctype="multipart/form-data" class="p-6 rounded-lg shadow-lg"
                style="background-color: #1E201E;">
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
                <footer class="text-white px-8 bg-black rounded-lg mt-6">
                    <div class="container mx-auto py-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div>
                                <h3 class="text-lg font-bold mb-4 underline">Kategori</h3>
                                <ul class="text-sm space-y-2">
                                    <li>Final Project</li>
                                    <li>Pemrograman Website</li>
                                    <li>Laravel 10</li>
                                    <li>CRUD</li>
                                    <li>MySQL</li>
                                    <li>Autentikasi</li>
                                    <li>Tailwind CSS</li>
                                    <li>Middleware</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-4 underline">Genre</h3>
                                <ul class="text-sm space-y-2">
                                    <li>Action</li>
                                    <li>Adventure</li>
                                    <li>Marvel</li>
                                    <li>Sci-Fi</li>
                                    <li>DC</li>
                                    <li>Romance</li>
                                    <li>Comedy</li>
                                    <li>Anime</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-4 underline">Lokasi</h3>
                                <div class="text-sm">
                                    <p>Semolowaru Utara VIII / 21, Sukolilo, Jawa Timur, Indonesia 60119</p>
                                    <p>Institut Teknologi Sepuluh Nopember</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="inline-block sm:flex sm:items-center lg:flex lg:items-center gap-2 mb-6 xs:gap-x-16 gap-x-20">
                        <div class="inline-block">
                            <h1 class="font-bold mt-6">Alvin Zanua Putra</h1>
                            <div class="flex items-center gap-2 mt-6">
                                <a href="https://www.instagram.com/alvinzanua" target="__blank"
                                    class="flex items-center gap-2 rounded-full border border-white">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <i class="fab fa-instagram text-white"></i>
                                    </button>
                                </a>
                                <a href="https://wa.me/6281217835337" target="__blank"
                                    class="flex items-center gap-2 rounded-full border border-white">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <i class="fab fa-whatsapp text-white"></i>
                                    </button>
                                </a>
                                <a href="https://x.com/AlvinZanua"
                                    class="flex items-center gap-2 rounded-full border border-white" target="__blank">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M214.75,211.71l-62.6-98.38,61.77-67.95a8,8,0,0,0-11.84-10.76L143.24,99.34,102.75,35.71A8,8,0,0,0,96,32H48a8,8,0,0,0-6.75,12.3l62.6,98.37-61.77,68a8,8,0,1,0,11.84,10.76l58.84-64.72,40.49,63.63A8,8,0,0,0,160,224h48a8,8,0,0,0,6.75-12.29ZM164.39,208,62.57,48h29L193.43,208Z">
                                            </path>
                                        </svg>
                                    </button>
                                </a>
                                <a href="https://www.linkedin.com/in/alvin-zanua-putra-34a758288" target="__blank"
                                    class="flex items-center gap-2 rounded-full border border-white">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <i class="fab fa-linkedin text-white"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="inline-block">
                            <h1 class="font-bold mt-6">Yahya Ayyash Ashdaqi</h1>
                            <div class="flex items-center gap-2 mt-6">
                                <a href="https://www.instagram.com/yhyayyash_" target="__blank"
                                    class="flex items-center gap-2 rounded-full border border-white">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <i class="fab fa-instagram text-white"></i>
                                    </button>
                                </a>
                                <a href="https://wa.me/6281335001748" target="__blank"
                                    class="flex items-center gap-2 rounded-full border border-white">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <i class="fab fa-whatsapp text-white"></i>
                                    </button>
                                </a>
                                <a href="https://x.com/yahyaayyash125"
                                    class="flex items-center gap-2 rounded-full border border-white" target="__blank">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M214.75,211.71l-62.6-98.38,61.77-67.95a8,8,0,0,0-11.84-10.76L143.24,99.34,102.75,35.71A8,8,0,0,0,96,32H48a8,8,0,0,0-6.75,12.3l62.6,98.37-61.77,68a8,8,0,1,0,11.84,10.76l58.84-64.72,40.49,63.63A8,8,0,0,0,160,224h48a8,8,0,0,0,6.75-12.29ZM164.39,208,62.57,48h29L193.43,208Z">
                                            </path>
                                        </svg>
                                    </button>
                                </a>
                                <a href="https://www.linkedin.com/in/yahya-ayyash-ashdaqi-a71974248/" target="__blank"
                                    class="flex items-center gap-2 rounded-full border border-white">
                                    <button
                                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                                        <i class="fab fa-linkedin text-white"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--  -->


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center border-t-2 py-2 border-gray-500">
                        <div class="flex flex-wrap items-center gap-4 text-xs md:text-sm">
                            <ul class="flex flex-wrap items-center gap-4">
                                <li>Kebijakan</li>
                                <li>Keamanan</li>
                                <li>Privasi</li>
                                <li>Cookies</li>
                                <li>Iklan</li>
                                <li>Lainnya</li>
                            </ul>
                        </div>
                        <div class="text-xs md:text-sm font-semibold flex md:justify-end py-4 pr-8">
                            <p>Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2024).
                                Dosen: Imam Kuswardayan, S.Kom, M.T.</p>
                        </div>
                    </div>
                </footer>
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