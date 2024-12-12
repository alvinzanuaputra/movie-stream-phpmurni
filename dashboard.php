<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_watchlist'])) {
    $movie_id = intval($_POST['movie_id']);
    $username = $_SESSION['username'];

    // Cek apakah film sudah ada di daftar tonton
    $check_sql = "SELECT * FROM watchlist WHERE username = ? AND movie_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("si", $username, $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Film sudah ada di daftar tonton Anda.');</script>";
    } else {
        $insert_sql = "INSERT INTO watchlist (username, movie_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("si", $username, $movie_id);
        if ($stmt->execute()) {
            echo "<script>alert('Film berhasil ditambahkan ke daftar tonton.');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan film ke daftar tonton.');</script>";
        }
    }
}

$keyword = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
}

$sql = "SELECT * FROM movies WHERE title LIKE ? OR genre LIKE ? OR director LIKE ?";
$stmt = $conn->prepare($sql);
$search_param = "%" . $keyword . "%";
$stmt->bind_param("sss", $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Movies | Dashboard</title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .btn-uniform {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 1px 5px 1px;
            width: 100%;
            font-size: 1.2w;
            /* Font responsif berdasarkan lebar viewport */
            text-align: center;
        }

        /* Media query untuk ukuran layar kecil */
        @media (max-width: 768px) {
            .btn-uniform {
                font-size: 1rem;
                /* Ukuran font pada layar sedang */
            }
        }

        /* Media query untuk layar sangat kecil (ponsel) */
        @media (max-width: 480px) {
            .btn-uniform {
                font-size: 0.8rem;
                /* Ukuran font lebih kecil */
            }
        }
    </style>
</head>

<body class="bg-black text-white">
    <div class="flex flex-col md:flex-row lg:p-2 lg:ml-2">
        <!-- Sidebar -->
        <div class="hidden md:block w-64 bg-{#1E201E] fixed justify-between inset-y-0 left-0 md:flex flex-col items-center py-4 px-2 m-2 rounded-lg"
            style="background-color: #1E201F;">
            <div class="flex flex-wrap">
                <a href="dashboard.php" class="flex items-center">
                    <img src="/assets/images/navbar.png" alt="Logo" class="w-40 h-auto lg:w-60 pb-6">
                </a>
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
            <div id="mobile-menu" class="hidden mt-4">
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
        <div class="p-4 flex-1 md:ml-64 ml-2 mr-1 rounded-lg " style="background-color: #1E201E;">


            <div class="flex justify-between items-center mb-6">
                <h1 class="flex items-center text-2xl text-white font-bold gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M220.17,100,202.86,70a28,28,0,0,0-38.24-10.25,27.69,27.69,0,0,0-9,8.34L138.2,38a28,28,0,0,0-48.48,0A28,28,0,0,0,48.15,74l1.59,2.76A27.67,27.67,0,0,0,38,80.41a28,28,0,0,0-10.24,38.25l40,69.32a87.47,87.47,0,0,0,53.43,41,88.56,88.56,0,0,0,22.92,3,88,88,0,0,0,76.06-132Zm-6.66,62.64A72,72,0,0,1,81.62,180l-40-69.32a12,12,0,0,1,20.78-12L81.63,132a8,8,0,1,0,13.85-8L62,66A12,12,0,1,1,82.78,54L114,108a8,8,0,1,0,13.85-8L103.57,58h0a12,12,0,1,1,20.78-12l33.42,57.9a48,48,0,0,0-5.54,60.6,8,8,0,0,0,13.24-9A32,32,0,0,1,172.78,112a8,8,0,0,0,2.13-10.4L168.23,90A12,12,0,1,1,189,78l17.31,30A71.56,71.56,0,0,1,213.51,162.62ZM184.25,31.71A8,8,0,0,1,194,26a59.62,59.62,0,0,1,36.53,28l.33.57a8,8,0,1,1-13.85,8l-.33-.57a43.67,43.67,0,0,0-26.8-20.5A8,8,0,0,1,184.25,31.71ZM80.89,237a8,8,0,0,1-11.23,1.33A119.56,119.56,0,0,1,40.06,204a8,8,0,0,1,13.86-8,103.67,103.67,0,0,0,25.64,29.72A8,8,0,0,1,80.89,237Z">
                        </path>
                    </svg>Hallo, Selamat Datang,
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </h1>

            </div>

            <!-- Search Form -->
            <form method="POST" action="dashboard.php" class="flex mb-6 text-black relative rounded-t-lg "
                style="background-color: #1E201E;">
                <input type="text" name="keyword" id="search-input" placeholder="Cari disini..."
                    value="<?php echo htmlspecialchars($keyword); ?>"
                    class="w-full bg-black text-white flex-1 py-2 px-16 rounded-lg border border-blue-700">


                <!-- Tombol Search -->
                <button type="submit" class="absolute left-2 p-2 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                        </path>
                    </svg>
                </button>

                <button type="button" id="clear-search"
                    class="absolute right-1 py-2.5 px-1 text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z">
                        </path>
                    </svg>
                </button>

            </form>


            <!-- Movie List -->
            <h2 class="text-xl mb-4 font-bold text-white">Daftar Film</h2>
            <?php if ($_SESSION['role'] == 'admin'): ?>

                <div
                    class="w-1/3 md:w-1/2 lg:w-1/6 px-4 py-2 text-center bg-green-600 hover:bg-green-500 text-white rounded gap-2 mb-4">
                    <a href="movie_tambah.php" class="flex items-center gap-x-2"><svg xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                            <path
                                d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm3 7.5H8.5V11a.5.5 0 0 1-1 0V8.5H5a.5.5 0 0 1 0-1h2.5V5a.5.5 0 0 1 1 0v2.5H11a.5.5 0 0 1 0 1z" />
                        </svg>
                        <p class="font-bold text-xs">
                            Tambah Film
                        </p>
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($result->num_rows > 0): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="bg-black rounded-md border border-white overflow-hidden shadow-lg">
                            <img src="/assets/movie/<?php echo $row['poster_image']; ?>" alt="Poster Film"
                                class="w-full h-84 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-blue-400 truncate underline"
                                    title="<?php echo htmlspecialchars($row['title']); ?>">
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </h3>
                                <p class="text-sm mb-2 text-white"><?php echo htmlspecialchars($row['director']); ?></p>
                                <p class="text-sm mb-2 text-white truncate"
                                    title="<?php echo htmlspecialchars($row['genre']); ?>">
                                    <?php echo htmlspecialchars($row['genre']); ?>
                                </p>
                                <p class="text-sm mb-2 text-white"><?php echo htmlspecialchars($row['release_year']); ?></p>

                                <div class="flex items-center gap-x-1 text-center mb-2 text-xs">
                                    <!-- Tombol Tambah -->
                                    <form method="POST" action="" class="w-full">
                                        <input type="hidden" name="movie_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="add_to_watchlist"
                                            class="btn-uniform bg-green-600 hover:bg-green-700 text-white rounded flex items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm3 7.5H8.5V11a.5.5 0 0 1-1 0V8.5H5a.5.5 0 0 1 0-1h2.5V5a.5.5 0 0 1 1 0v2.5H11a.5.5 0 0 1 0 1z" />
                                            </svg>
                                            Tambah
                                        </button>
                                    </form>

                                    <?php if ($_SESSION['role'] == 'admin'): ?>
                                        <a href="movie_hapus.php?id=<?= $row['id'] ?>"
                                            class="btn-uniform bg-red-600 hover:bg-red-700 text-white rounded flex items-center justify-center gap-1"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus film ini?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6zm2-.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9.5a2.5 2.5 0 0 1-2.5 2.5h-5A2.5 2.5 0 0 1 3 13.5V4h-.5a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1H5.5l1-1h3l1 1h2.5a1 1 0 0 1 1 1v1zM4 4v9.5A1.5 1.5 0 0 0 5.5 15h5a1.5 1.5 0 0 0 1.5-1.5V4H4z" />
                                            </svg>
                                            Hapus
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="flex items-center gap-x-2 text-xs">
                                    <?php if ($_SESSION['role'] == 'admin'): ?>
                                        <!-- Tombol Edit -->
                                        <a href="movie_edit.php?id=<?= $row['id'] ?>"
                                            class="btn-uniform bg-gray-600 hover:bg-gray-700 text-white rounded flex items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706l-1.439 1.44-2.122-2.122 1.44-1.44a.5.5 0 0 1 .707 0l1.414 1.415zm-1.354 2.768-2.122-2.121L1 12.813V15h2.186l11.162-11.06z" />
                                            </svg>
                                            Edit
                                        </a>
                                    <?php endif; ?>

                                    <!-- Tombol Tonton -->
                                    <a href="tonton_trailer.php?id=<?php echo $row['id']; ?>"
                                        class="btn-uniform bg-blue-600 hover:bg-blue-700 text-white rounded flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.79 5.093A.5.5 0 0 1 7.5 5.5v5a.5.5 0 0 1-.71.458L3.71 8.457a.5.5 0 0 1 0-.914L6.79 5.093z" />
                                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" />
                                        </svg>
                                        Tonton
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php else: ?>
                <p class="text-blue-400">Film tidak ditemukan untuk kata kunci "<?php echo htmlspecialchars($keyword); ?>".
                </p>
            <?php endif; ?>
            <!-- Footer -->
            <footer class="text-white px-8 bg-black rounded-lg mt-10">
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
                        <a href="https://x.com/AlvinZanua"
                            class="flex items-center gap-2 rounded-full border border-white" target="__blank">
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
        </div>
        <div class="fixed bottom-4 right-4">
            <button id="scrollTopBtn"
                class="hidden bg-blue-600 border text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700 transition">
                ↑ Top
            </button>
        </div>
    </div>


    <!-- Tambahkan script untuk toggle menu -->
    <script>
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        document.getElementById('clear-search').addEventListener('click', function () {
            document.getElementById('search-input').value = '';
            // Mengirimkan form agar pencarian kosong juga dikirimkan
            document.querySelector('form').submit();
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