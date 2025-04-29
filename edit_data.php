<?php
session_start();

require('koneksi.php');

$pageTitle = "Edit Data";

$query = "SELECT * FROM records";
$result = mysqli_query($conn, $query);

$messages = [];

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];

    foreach ($id as $key => $value) {
        $updateQuery = "UPDATE records SET judul='" . $judul[$key] . "', author='" . $author[$key] . "', tahun='" . $tahun[$key] . "', deskripsi='" . $deskripsi[$key] . "' WHERE id='" . $value . "'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            $messages[] = "Data dengan ID $value berhasil diperbarui.";
        } else {
            $messages[] = "Gagal memperbarui data dengan ID $value: " . mysqli_error($conn);
        }
    }

    $result = mysqli_query($conn, $query);
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
        <h1><?php echo $pageTitle; ?></h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Author</th>
                    <th>Tahun</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['tahun']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td>
                            <a href="edit_form.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <form method="get" action="delete.php" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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