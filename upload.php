<?php
session_start();
include "koneksi.php";

if (isset($_POST['proses'])) {
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];

    if (isset($_FILES['NamaFile']) && $_FILES['NamaFile']['error'] == UPLOAD_ERR_OK) {
        $direktori = "berkas/";
        $file_name = $_FILES['NamaFile']['name'];
        $file_tmp_name = $_FILES['NamaFile']['tmp_name'];

        if (!is_dir($direktori)) {
            mkdir($direktori, 0755, true);
        }

        if (move_uploaded_file($file_tmp_name, $direktori . $file_name)) {
            // Masukkan data ke database
            $query = "INSERT INTO records (judul, author, tahun, deskripsi, file) VALUES ('$judul', '$author', '$tahun', '$deskripsi', '$file_name')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['upload_message'] = "Data berhasil diupload: $judul";
                header("Location: upload.php");
                exit;
            } else {
                $_SESSION['upload_message'] = "Gagal mengupload data: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['upload_message'] = "Gagal memindahkan file";
        }
    } else {
        $_SESSION['upload_message'] = "File tidak ditemukan atau terjadi kesalahan saat mengupload";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

    <?php include "layout/header.php" ?>

    <div class="container py-5">
        <h3>Upload Dokumen</h3>
        <?php if (isset($_SESSION['upload_message'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['upload_message']; ?>
            </div>
            <?php unset($_SESSION['upload_message']); ?>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <b>File Upload</b> <input type="file" name="NamaFile" required>
            </div>
            <input type="submit" name="proses" value="Upload" class="btn btn-info">
        </form>
    </div>

    <?php include "layout/footer.html" ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
