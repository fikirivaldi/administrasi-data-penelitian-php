<?php
require('koneksi.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM records WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus.";

        // Redirect kembali ke halaman sebelumnya setelah 2 detik
        echo '<script>
                setTimeout(function() {
                    window.location.href = document.referrer;
                }, 2000); // 2 detik
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Parameter ID tidak valid.";
}

mysqli_close($conn);
?>
