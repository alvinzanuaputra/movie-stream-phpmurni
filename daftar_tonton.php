<?php
session_start();
include 'koneksi.php';


// Pastikan user telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Definisikan variabel keyword jika belum ada
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

// Query untuk mendapatkan daftar film favorit pengguna
$sql = "
    SELECT m.*
    FROM watchlist w
    INNER JOIN movies m ON w.movie_id = m.id
    WHERE w.username = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Movies | Daftar Tonton</title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">
    <div class="flex flex-col md:flex-row lg:p-2 lg:ml-2">
        <div class="hidden md:block w-64 bg-{#1E201E] fixed justify-between inset-y-0 left-0 md:flex flex-col items-center py-4 px-2 m-2 rounded-lg"
            style="background-color: #1E201F;">
            <div class="flex flex-wrap">
                <a href="dashboard.php" class="flex items-center">
                    <img src="/assets/images/navbar.png" alt="Logo" class="w-40 h-auto lg:w-60 pb-6">
                </a>
                <a href="dashboard.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-white rounded mb-4  font-bold hover:text-white duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm-16,72h16v48H192Zm16-16H192V48h16ZM48,48H176V208H48ZM208,208H192V168h16v40Zm-56.25-42a39.76,39.76,0,0,0-17.19-23.34,32,32,0,1,0-45.12,0A39.84,39.84,0,0,0,72.25,166a8,8,0,0,0,15.5,4c2.64-10.25,13.06-18,24.25-18s21.62,7.73,24.25,18a8,8,0,1,0,15.5-4ZM96,120a16,16,0,1,1,16,16A16,16,0,0,1,96,120Z">
                        </path>
                    </svg>Daftar
                    Film
                </a>
                <a href="daftar_tonton.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center rounded mb-4 text-blue-500 font-bold hover:text-white duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z">
                        </path>
                    </svg> Daftar Tonton
                </a>
                <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar ?');"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-red-500 rounded hover:text-blue-600 text-white font-bold duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                        </path>
                    </svg>
                    Keluar
                </a>
            </div>
            <div class="bg-black rounded-lg px-4  py-4 pr-8" style="font-size: 11px;">
                <p>Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2024).
                    Dosen: Imam Kuswardayan, S.Kom, M.T.
                </p>
            </div>
        </div>

        <!-- Sidebar untuk layar kecil -->
        <div class="block md:hidden w-full py-4 px-2">
            <div class="flex justify-between items-center">
                <a href="dashboard.php" class="flex items-center ml-6">
                    <img src="/assets/images/navbar.png" alt="Logo" class="w-52 h-auto lg:w-60">
                </a>
                <button id="menu-toggle" class="text-white rounded px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                        </path>
                    </svg>
                </button>
            </div>
            <div id="mobile-menu" class="hidden my-4">
                <a href="dashboard.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-white rounded mb-4 text-blue-500 font-bold hover:text-white duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm-16,72h16v48H192Zm16-16H192V48h16ZM48,48H176V208H48ZM208,208H192V168h16v40Zm-56.25-42a39.76,39.76,0,0,0-17.19-23.34,32,32,0,1,0-45.12,0A39.84,39.84,0,0,0,72.25,166a8,8,0,0,0,15.5,4c2.64-10.25,13.06-18,24.25-18s21.62,7.73,24.25,18a8,8,0,1,0,15.5-4ZM96,120a16,16,0,1,1,16,16A16,16,0,0,1,96,120Z">
                        </path>
                    </svg>Daftar
                    Film
                </a>
                <a href="daftar_tonton.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-white  rounded hover:text-blue-500 text-white font-bold duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z">
                        </path>
                    </svg> Daftar Tonton
                </a>
                <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar ?');"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-red-500 rounded hover:text-blue-600 text-white font-bold duration-500 transition-all mt-4"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                        </path>
                    </svg>
                    Keluar
                </a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="p-4 flex-1 md:ml-64 ml-2 mr-1 rounded-lg" style="background-color: #1E201E;">
            <div class="flex justify-between items-center mb-6">
                <h1 class="font-bold text-2xl">Daftar Tonton: <?php echo htmlspecialchars($username); ?></h1>

            </div>



            <!-- Movie List -->

            <?php if ($result->num_rows > 0): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                    <?php while ($movie = $result->fetch_assoc()): ?>
                        <div class="bg-black rounded-md border border-white overflow-hidden shadow-lg">
                            <img src="/assets/movie/<?php echo $movie['poster_image']; ?>" alt="Poster Film"
                                class="w-full h-84 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-blue-400 truncate underline"
                                    title="<?php echo htmlspecialchars($movie['title']); ?>">
                                    <?php echo htmlspecialchars($movie['title']); ?>
                                </h3>
                                <p class="text-sm mb-2 text-white"><?php echo htmlspecialchars($movie['director']); ?></p>
                                <p class="text-sm mb-2 text-white truncate"
                                    title="<?php echo htmlspecialchars($movie['genre']); ?>">
                                    <?php echo htmlspecialchars($movie['genre']); ?>
                                </p>
                                <p class="text-sm mb-2 text-white"><?php echo htmlspecialchars($movie['release_year']); ?></p>
                                <a href="tonton_trailer.php?id=<?php echo htmlspecialchars($movie['id']); ?>"
                                    class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M6.79 5.093A.5.5 0 0 1 7.5 5.5v5a.5.5 0 0 1-.71.458L3.71 8.457a.5.5 0 0 1 0-.914L6.79 5.093z" />
                                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" />
                                    </svg>
                                    Tonton
                                </a>
                                <a href="hapus_watchlist.php?id=<?php echo htmlspecialchars($movie['id']); ?>"
                                    class="w-full mt-1 py-2 bg-red-600 hover:bg-red-700 text-white rounded flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6zm2-.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9.5a2.5 2.5 0 0 1-2.5 2.5h-5A2.5 2.5 0 0 1 3 13.5V4h-.5a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1H5.5l1-1h3l1 1h2.5a1 1 0 0 1 1 1v1zM4 4v9.5A1.5 1.5 0 0 0 5.5 15h5a1.5 1.5 0 0 0 1.5-1.5V4H4z" />
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-blue-400">Film tidak ditemukan.</p>
            <?php endif; ?>
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
        </div>

        <div class="fixed bottom-4 right-4">
            <button id="scrollTopBtn"
                class="hidden bg-blue-600 border text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700 transition">
                ↑ Top
            </button>
        </div>
    </div>
    <script>
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        // Tampilkan tombol saat scroll lebih dari 200px
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollTopBtn.classList.remove('hidden');
            } else {
                scrollTopBtn.classList.add('hidden');
            }
        });

        // Scroll ke atas saat tombol diklik
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

    </script>
</body>

</html>