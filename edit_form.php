<?php
session_start();
require('koneksi.php');

// Inisialisasi variabel
$pageTitle = "Edit Data";

// Ambil ID yang dikirimkan melalui URL
$id = $_GET['id'];

// Ambil data dari database berdasarkan ID yang dikirimkan
$query = "SELECT * FROM records WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Inisialisasi array untuk menyimpan pesan kesalahan validasi atau sukses
$messages = [];

// Jika ada upaya pengiriman formulir untuk menyimpan perubahan
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];

    // update data ke database
    $updateQuery = "UPDATE records SET judul='$judul', author='$author', tahun='$tahun', deskripsi='$deskripsi' WHERE id='$id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $messages[] = "Data dengan ID $id berhasil diperbarui.";
    } else {
        $messages[] = "Gagal memperbarui data dengan ID $id: " . mysqli_error($conn);
    }

    // Ambil kembali data terbaru dari database setelah update
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <!-- Masukkan CSS Bootstrap di sini jika diperlukan -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include "layout/header.php" ?>

    <div class="container mt-5">
        <h1><?php echo $pageTitle; ?></h1>

        <!-- pesan kesalahan atau sukses -->
        <?php foreach ($messages as $message) : ?>
            <p><?php echo $message; ?></p>
        <?php endforeach; ?>

        <!-- Formulir untuk mengedit data -->
        <form method="POST">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul']; ?>">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" id="tahun" name="tahun" value="<?php echo $row['tahun']; ?>">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-info">Simpan Perubahan</button>
        </form>
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