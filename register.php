<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user";

    $checkQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $username, $password, $role);

        if ($stmt->execute()) {
            $success = "Registrasi berhasil! Silakan <a href='login.php'>login di sini</a>.";
        } else {
            $error = "Registrasi gagal: " . $conn->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Movies | Daftar</title>
    <link rel="icon" href="/assets/images/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-black bg-opacity-60 text-white bg-cover bg-center"
    style="background-image: url('/assets/images/background.jpg');">
    <a href="dashboard.php" class="bg-black bg-opacity-60 flex items-center px-6 py-4">
        <img src="/assets/images/navbar.png" alt="Logo" class="w-56 h-auto lg:w-60">
    </a>
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md bg-black bg-opacity-60 p-12 rounded-sm shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-2">Daftar</h2>

            <?php if (isset($error))
                echo "<div class='bg-red-500 text-white p-1 rounded mb-1 text-sm'>{$error}</div>"; ?>
            <?php if (isset($success))
                echo "<div class='bg-green-500 text-white p-1 rounded mb-1 text-sm'>{$success}</div>"; ?>

            <form action="" method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-semibold mb-2">Username</label>
                    <input id="username" type="text" name="username" required
                        class="w-full py-2.5 px-3 rounded-sm border border-blue-500 bg-gray-800 bg-opacity-65 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white"
                        placeholder="Masukkan Username">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full py-2.5 px-3 rounded-sm border border-blue-500 bg-gray-800 bg-opacity-65 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white"
                        placeholder="Masukkan Password">
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-sm transition-all duration-400">
                        Daftar
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm">
                Sudah punya akun? <a href="login.php"
                    class="text-blue-500 font-semibold duration-500 transition-all underline">
                    Login di sini
                </a>
            </p>
        </div>
    </div>
    <footer class="text-white px-8 bg-black rounded-lg">
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