<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pastikan ID adalah angka dan valid
    if (is_numeric($id)) {
        // Ambil data film berdasarkan ID
        $sql = "SELECT * FROM movies WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        // Cek apakah query berhasil dan data ditemukan
        if ($result && mysqli_num_rows($result) > 0) {
            $movie = mysqli_fetch_assoc($result);
        } else {
            echo "Film tidak ditemukan.";
            exit();
        }
    } else {
        echo "ID film tidak valid.";
        exit();
    }
} else {
    echo "ID film tidak ditemukan.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Movies | Edit Film</title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-black flex justify-center items-center w-full min-h-screen">

    <div class=" w-full my-8 mx-4 p-8 text-white rounded-lg shadow-lg" style="background-color: #1E201E;">
        <h2 class="text-2xl font-bold text-center text-blue-500 mb-6">Edit Film</h2>
        <form action="movie_edit_proses.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">

            <!-- Title -->
            <div class="form-group">
                <label for="title" class="block font-medium mb-2 ">Judul Film</label>
                <input type="text" name="title" id="title" value="<?php echo $movie['title']; ?>" required
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Director -->
            <div class="form-group">
                <label for="director" class="block font-medium mb-2">Sutradara</label>
                <input type="text" name="director" id="director" value="<?php echo $movie['director']; ?>" required
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 ">
            </div>

            <!-- Actors -->
            <div class="form-group">
                <label for="actors" class="block font-medium mb-2">Aktor/Aktris</label>
                <input type="text" name="actors" id="actors" value="<?php echo $movie['actors']; ?>" required
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 ">
            </div>

            <!-- Release Year -->
            <div class="form-group">
                <label for="release_year" class="block font-medium mb-2">Tahun Rilis</label>
                <input type="number" name="release_year" id="release_year" value="<?php echo $movie['release_year']; ?>" required
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 ">
            </div>

            <!-- Genre -->
            <div class="form-group">
                <label for="genre" class="block font-medium mb-2">Genre</label>
                <input type="text" name="genre" id="genre" value="<?php echo $movie['genre']; ?>" required
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 ">
            </div>

            <!-- Current Poster Image -->
            <div class="form-group">
                <label class="block font-medium mb-2">Poster Saat Ini</label>
                <img src="/assets/movie/<?php echo $movie['poster_image']; ?>" alt="Poster Film" class="w-40 rounded">
            </div>

            <!-- Change Poster Image -->
            <div class="form-group">
                <label for="poster_image" class="block font-medium mb-2">Ganti Poster (opsional)</label>
                <input type="file" name="poster_image" id="poster_image" accept="image/*"
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 ">
            </div>

            <!-- Trailer URL -->
            <div class="form-group">
                <label for="trailer_url" class="block font-medium mb-2">URL Trailer</label>
                <input type="text" name="trailer_url" id="trailer_url" value="<?php echo $movie['trailer_url']; ?>" required
                       class="w-full p-3 rounded-lg border border-white bg-gray-700 bg-opacity-60 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 ">
            </div>

            <!-- Submit Button -->
            <div class="form-actions flex space-x-4">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded transition">
                    Update Film
                </button>
                <a href="dashboard.php"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded transition">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
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
        <div class="inline-block sm:flex sm:items-center lg:flex lg:items-center gap-2 mb-6 xs:gap-x-16 gap-x-20">
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
                    <a href="https://x.com/AlvinZanua" class="flex items-center gap-2 rounded-full border border-white"
                        target="__blank">
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
                    <a href="https://wa.me/6281335001748" target="__blank" class="flex items-center gap-2 rounded-full border border-white">
                        <button
                            class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                            <i class="fab fa-whatsapp text-white"></i>
                        </button>
                    </a>
                    <a href="https://x.com/yahyaayyash125" class="flex items-center gap-2 rounded-full border border-white"
                        target="__blank">
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
    </div>
    

</body>
</html>
