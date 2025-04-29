<?php
//inisialisasi session
session_start();

//mengecek username pada session
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: login.php');
}

// Mengatur waktu sesi
$inactive = 600; // Waktu dalam detik (misalnya 10 menit)
if (isset($_SESSION['timeout'])) {
  $session_life = time() - $_SESSION['timeout'];
  if ($session_life > $inactive) {
    session_destroy();
    header("Location: login.php");
    exit;
  }
}
$_SESSION['timeout'] = time();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    /* CSS kustom untuk menimpa gaya default Bootstrap */
    .pagination .page-item.active .page-link {
      background-color: #17a2b8 !important;
      /* Warna bg-info */
      border-color: #17a2b8 !important;
      /* Border color to match bg-info */
      color: white !important;
      /* Warna teks */
    }

    .pagination .page-item .page-link {
      color: black;
      /* Warna teks tidak aktif */
    }
  </style>
</head>

<body>

  <?php include "layout/header.php" ?>

  <div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
      <!-- Form pencarian -->
      <form class="form-inline" action="" method="GET">
        <input class="form-control mr-sm-2" type="text" placeholder="Cari Judul" aria-label="Search" name="search">
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
      </form>

      <!-- Tombol tambah dan edit -->
      <div>
        <button class="btn btn-info mr-2">
          <a class="text-light" href="upload.php">Tambah</a>
        </button>
        <button class="btn btn-info">
          <a class="text-light" href="edit_data.php">Edit</a>
        </button>
      </div>
    </div>

    <?php
    include "koneksi.php";

    // Set the number of records to display per page
    $records_per_page = 4;

    // Get the current page number
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the offset for the query
    $offset = ($page - 1) * $records_per_page;

    // Base query
    $query = "SELECT * FROM records";

    // Add search condition if applicable
    if (isset($_GET['search'])) {
      $searching = $_GET['search'];
      $query .= " WHERE judul LIKE '%" . $searching . "%'";
    }

    // Query to count total records
    $total_query = "SELECT COUNT(*) as total_records FROM (" . $query . ") as count_query";
    $result = mysqli_query($conn, $total_query);
    $total_records = mysqli_fetch_assoc($result)['total_records'];

    // Query with limit and offset for pagination
    $query .= " LIMIT $offset, $records_per_page";

    $result = mysqli_query($conn, $query);

    // Display the records
    echo "<table class='table table-striped'>";
    echo "<tr><th>Judul</th><th>Author</th><th>Tahun</th><th>Deskripsi</th><th>File</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td><a href='detail.php?id=" . $row['id'] . "'>" . $row['judul'] . "</a></td>";
      echo "<td>" . $row['author'] . "</td>";
      echo "<td>" . $row['tahun'] . "</td>";
      echo "<td>" . $row['deskripsi'] . "</td>";
      echo "<td><a href='download.php?file=" . $row['file'] . "' class='btn btn-outline-info'>PDF Download</a></td>";
      echo "</tr>";
    }
    echo "</table>";

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $records_per_page);

    // Display the pagination links
    echo "<nav aria-label='Page navigation'>";
    echo "<ul class='pagination'>";

    for ($i = 1; $i <= $total_pages; $i++) {
      $activeClass = ($i == $page) ? "active" : "";
      echo "<li class='page-item $activeClass'>";
      echo "<a class='page-link' href='?page=$i";
      if (isset($searching)) {
        echo "&search=$searching";
      }
      echo "'>$i</a></li>";
    }

    echo "</ul>";
    echo "</nav>";

    ?>
  </div>

  <?php include "layout/footer.html" ?>

  <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>