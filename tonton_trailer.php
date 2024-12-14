<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil id film dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data film berdasarkan id
    $sql = "SELECT * FROM movies WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Jika film ditemukan, ambil data film
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Ekstrak URL trailer dan embed YouTube
        $link = $row['trailer_url'];
        $videoId = substr(parse_url($link, PHP_URL_QUERY), 2);
        $embedUrl = "https://www.youtube.com/embed/$videoId";
    } else {
        echo "Film tidak ditemukan.";
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
    <title>Motion Movies | <?php echo $row['title']; ?></title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">

    <!-- Container -->
    <div class="bg-black w-full mx-auto p-6 ounded-lg shadow-lg ">
        <h2 class="text-3xl py-6 text-center text-blue-500 font-semibold mb-6"><?php echo $row['title']; ?></h2>
        <div class="text-xs lg:text-lg px-1 py-2 bg-black my-6 text-left text-white hover:text-blue-700 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff" viewBox="0 0 256 256">
                <path
                    d="M232,144a64.07,64.07,0,0,1-64,64H80a8,8,0,0,1,0-16h88a48,48,0,0,0,0-96H51.31l34.35,34.34a8,8,0,0,1-11.32,11.32l-48-48a8,8,0,0,1,0-11.32l48-48A8,8,0,0,1,85.66,45.66L51.31,80H168A64.07,64.07,0,0,1,232,144Z">
                </path>
            </svg>
            <a href="dashboard.php" class="font-semibold underline">Kembali </a>
        </div>
        <div class="aspect-w-16 aspect-h-9 mb-6 rounded border border-black">
            <iframe width="100%" height="570"
                class="w-full h-[50px] lg:h-[620px] embed-responsive-item rounded border border-gray-700"
                src="<?php echo $embedUrl; ?>" allowfullscreen></iframe>
        </div>

        <!-- Film Details -->
        <div class="my-6 p-6 rounded-lg flex " style="background-color: #1E201E;">
            <img src="/assets/movie/<?php echo $row['poster_image']; ?>" alt="Poster Film"
                class="w-32 h-34 lg:w-40 lg:h-84 object-cover">
            <div class="inline-black pl-4 lg:text-lg text-xs">
                <h1 class="text-lg lg:text-2xl text-blue-500 pb-4 font-bold text-blue-400 underline"
                    title="<?php echo htmlspecialchars($row['title']); ?>">
                    <?php echo htmlspecialchars($row['title']); ?>
                </h1>
                <p><strong class="text-blue-500">Sutradara:</strong> <?php echo $row['director']; ?></p>
                <p><strong class="text-blue-500">Aktor/Aktris:</strong> <?php echo $row['actors']; ?></p>
                <p><strong class="text-blue-500">Genre:</strong> <?php echo $row['genre']; ?></p>
                <p><strong class="text-blue-500">Tahun Rilis:</strong> <?php echo $row['release_year']; ?></p>
            </div>
        </div>
        <div class="bg-black text-white p-6 rounded-lg w-full mx-auto">

            <h2 class="text-center text-lg font-semibold mb-4">Apa Reaksi Kamu ?</h2>

            <div class="grid grid-cols-6 gap-4 items-center mb-6">
                <!-- Reaction Love -->
                <div class="text-center">
                    <div class="relative">
                        <img src="https://media.giphy.com/media/W5q0JHjCJS9oU/giphy.gif" alt="Love"
                            class="w-12 h-12 lg:w-40 lg:h-40 mx-auto">
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">49%</span>
                    </div>
                    <p class="text-xs mt-2">Love</p>
                </div>
                <!-- Reaction Angry -->
                <div class="text-center">
                    <div class="relative">
                        <img src="https://media.giphy.com/media/l1J9urHnC6mWR2YVW/giphy.gif" alt="Angry"
                            class="w-12 h-12 lg:w-40 lg:h-40 mx-auto">
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">5%</span>
                    </div>
                    <p class="text-xs mt-2">Angry</p>
                </div>
                <!-- Reaction Laugh -->
                <div class="text-center">
                    <div class="relative">
                        <img src="https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif" alt="Laugh"
                            class="w-12 h-12 lg:w-40 lg:h-40 mx-auto">
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">2%</span>
                    </div>
                    <p class="text-xs mt-2">Laugh</p>
                </div>
                <!-- Reaction Cry -->
                <div class="text-center">
                    <div class="relative">
                        <img src="https://media.giphy.com/media/3og0IMJcSI8p6hYQXS/giphy.gif" alt="Cry"
                            class="w-12 h-12 lg:w-40 lg:h-40 mx-auto">
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">35%</span>
                    </div>
                    <p class="text-xs mt-2">Cry</p>
                </div>
                <!-- Reaction Wow -->
                <div class="text-center">
                    <div class="relative">
                        <img src="https://media.giphy.com/media/26AHONQ79FdWZhAI0/giphy.gif" alt="Wow"
                            class="w-12 h-12 lg:w-40 lg:h-40 mx-auto">
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">2%</span>
                    </div>
                    <p class="text-xs mt-2">Wow</p>
                </div>
                <!-- Reaction Sleepy -->
                <div class="text-center">
                    <div class="relative">
                        <img src="https://media.giphy.com/media/l0MYN9kF1mK24m8rm/giphy.gif" alt="Sleepy"
                            class="w-12 h-12 lg:w-40 lg:h-40 mx-auto">
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">6%</span>
                    </div>
                    <p class="text-xs mt-2">Sleepy</p>
                </div>
            </div>


        </div>

        <footer class="text-white px-8 bg-black rounded-lg ">
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