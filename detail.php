<?php
session_start();

require('koneksi.php');

// Inisialisasi variabel
$pageTitle = "Detail Data";
$judul = "";
$author = "";
$tahun = "";
$deskripsi = "";
$file = "";

// Ambil parameter id dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // query ke database untuk mendapatkan detail data berdasarkan id
    $query = "SELECT * FROM records WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $judul = $row['judul'];
        $author = $row['author'];
        $tahun = $row['tahun'];
        $deskripsi = $row['deskripsi'];
        $file = $row['file']; // Ambil nama file dari database

        // menampilkan judul halaman sesuai dengan judul data yang dipilih
        $pageTitle = $judul;
    } else {
        // Jika data tidak ditemukan
        $pageTitle = "Data Tidak Ditemukan";
    }
} else {
    // Jika parameter id tidak ada atau kosong
    $pageTitle = "Parameter ID Tidak Ditemukan";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include "layout/header.php" ?>

    <div class="container mt-5">
        <h1 class="mb-3"><?php echo $judul; ?></h1>
        <p><strong>Author:</strong> <?php echo $author; ?></p>
        <p><strong>Tahun:</strong> <?php echo $tahun; ?></p>
        <p><strong>Deskripsi:</strong> <?php echo $deskripsi; ?></p>

        <!-- Tombol download -->
        <?php if (!empty($file)) : ?>
            <a href="download.php?file=<?php echo urlencode($file); ?>" class="btn btn-info" download>Download PDF</a>
        <?php else : ?>
            <p class="text-danger">File tidak tersedia untuk diunduh.</p>
        <?php endif; ?>

        <p class="mt-5"><a href="javascript:history.back()">Kembali</a></p>
    </div>

    <?php include "layout/footer.html" ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
    if (isset($result)) {
        mysqli_free_result($result);
    }    
?>