<?php
include "koneksi.php";

// Handle form submission
if (isset($_POST["submit"])) {
    $judul = trim($_POST["judul"]);
    $author = trim($_POST["author"]);
    $tahun = trim($_POST["tahun"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $file = $_FILES["file"];

    // Validate the form data
    if (empty($judul) || empty($author) || empty($tahun) || empty($deskripsi) || empty($file["name"])) {
        $_SESSION["msg"] = "All fields are required.";
        header('Location: index.php');
        exit;
    }

    // Validate file type and size
    $allowed_types = ['application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if (!in_array($file["type"], $allowed_types) || $file["size"] > 2 * 1024 * 1024) {
        $_SESSION["msg"] = "Invalid file type or size.";
        header('Location: index.php');
        exit;
    }

    // Insert the data into the database
    $query = "INSERT INTO records (judul, author, tahun, deskripsi, file) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $judul, $author, $tahun, $deskripsi, $file["name"]);
    mysqli_stmt_execute($stmt);

    // Check for errors
    if (mysqli_stmt_error($stmt)) {
        $_SESSION["msg"] = "Error inserting data: " . mysqli_stmt_error($stmt);
    } else {
        // Upload the file
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $_SESSION["msg"] = "Record added successfully";
            echo "<b>Record added successfully";
        } else {
            $_SESSION["msg"] = "Error uploading file.";
            echo "<b>Error uploading file.";
        }
    }

    header('Location: index.php');
    exit;
}
?>
