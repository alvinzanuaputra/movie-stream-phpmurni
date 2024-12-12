<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Movies</title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="text-white bg-cover bg-center bg-black" style="background-image: url('/assets/images/background.jpg');">
    <a href="dashboard.php" class="bg-black bg-opacity-60 flex items-center px-6 py-4">
        <img src="/assets/images/navbar.png" alt="Logo" class="w-56 h-auto lg:w-60">
    </a>
    <div
        class="relative z-50 flex flex-col items-center justify-center h-screen text-center p-4 bg-cover bg-center">
        <h1 class="text-4xl font-bold mb-4 text-blue-500">Selamat Datang di Motion Movies</h1>
        <p class="w-full md:w-1/2 lg:w-1/2 mb-8 px-4 text-lg text-gray-300">
            Jelajahi berbagai koleksi film dari berbagai genre. Motion Movies memberikan pengalaman menonton terbaik
            dengan pilihan film terkini yang bisa Anda nikmati kapan saja dan di mana saja.
        </p>
        <a href="login.php"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition-all duration-300">
            Masuk untuk Menonton Film
        </a>
        <div class="text-center py-6">
            <div class="container mx-auto">
                <h2 class="text-xl font-semibold text-gray-300 mb-4">Silahkan Masuk sebagai user (menonton) dengan:</h2>
                <ul class="text-gray-400 text-sm">
                    <li>Username: <strong>user</strong></li>
                    <li>Password: <strong>user</strong></li>
                </ul>

                <h2 class="text-xl font-semibold text-gray-300 mt-6 mb-4">Silahkan Masuk sebagai admin (mengelola)
                    dengan:
                </h2>
                <ul class="text-gray-400 text-sm">
                    <li>Username: <strong>admin</strong></li>
                    <li>Password: <strong>admin</strong></li>
                </ul>
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
            <div class="flex items-center gap-2 mt-6">
                <a href="https://www.instagram.com/alvinzanua" target="__blank"
                    class="flex items-center gap-2 rounded-full border border-white">
                    <button
                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                        <i class="fab fa-instagram text-white"></i>
                    </button>
                </a>
                <a href="https://www.facebook.com/profile.php?id=100070957315001" target="__blank"
                    class="flex items-center gap-2 rounded-full border border-white">
                    <button
                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                        <i class="fab fa-facebook text-white"></i>
                    </button>
                </a>
                <a href="https://x.com/AlvinZanua" class="flex items-center gap-2 rounded-full border border-white"
                    target="__blank">
                    <button
                        class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                        <i class="fab fa-twitter text-white"></i>
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
</body>

</html>