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
</head>
<body class="bg-gray-900 flex justify-center items-center w-full min-h-screen">

    <div class="container w-full my-8 mx-auto p-8 bg-gray-800 text-white rounded-lg shadow-lg w-3/4">
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
    </div>

</body>
</html>
