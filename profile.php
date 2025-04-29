<?php
session_start();
include "koneksi.php";

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
    exit;
}

// Mendapatkan user_id dari session
$username = $_SESSION['username'];
$query = "SELECT id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];

// Mendapatkan data pengguna
$query = "SELECT u.name, u.username, u.email, u.image, d.jurusan, d.universitas, d.alamat, d.jenis_kelamin 
          FROM users u 
          LEFT JOIN user_details d ON u.id = d.user_id 
          WHERE u.id = $user_id";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Menangani form submission untuk memperbarui data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $universitas = $_POST['universitas'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $image = $_FILES['image'];

    // Validasi data input
    if (empty($name) || empty($email) || empty($jurusan) || empty($universitas) || empty($alamat) || empty($jenis_kelamin)) {
        $error = 'Silakan isi semua kolom';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Alamat email tidak valid';
    } else {
        // Memperbarui data pengguna di tabel users
        $query = "UPDATE users SET name = '$name', email = '$email' WHERE id = $user_id";
        mysqli_query($conn, $query);

        // Memperbarui atau menyisipkan data di tabel user_details
        $query = "REPLACE INTO user_details (user_id, jurusan, universitas, alamat, jenis_kelamin) 
                  VALUES ($user_id, '$jurusan', '$universitas', '$alamat', '$jenis_kelamin')";
        mysqli_query($conn, $query);

        // Menangani unggahan gambar
        if ($image['size'] > 0) {
            $image_path = 'uploads/' . $image['name'];
            move_uploaded_file($image['tmp_name'], $image_path);
            $query = "UPDATE users SET image = '$image_path' WHERE id = $user_id";
            mysqli_query($conn, $query);
        }

        // Redirect ke halaman profil
        header('Location: profile.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<?php include "layout/header.php" ?>

<div class="container py-5">
    <h2>Edit Profil</h2>
    <?php if (isset($error)) { echo '<p class="error text-danger">' . $error . '</p>'; } ?>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $user_data['name']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $user_data['email']; ?>">
        </div>
        <div class="form-group">
            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="jurusan" class="form-control" value="<?php echo $user_data['jurusan']; ?>">
        </div>
        <div class="form-group">
            <label for="universitas">Universitas:</label>
            <input type="text" id="universitas" name="universitas" class="form-control" value="<?php echo $user_data['universitas']; ?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $user_data['alamat']; ?>">
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                <option value="L" <?php if ($user_data['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                <option value="P" <?php if ($user_data['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Profile Picture:</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-info">Save Changes</button>
    </form>
    <?php if (!empty($user_data['image'])) { ?>
        <p>Current Profile Picture:</p>
        <img src="<?php echo $user_data['image']; ?>" width="100" height="100">
    <?php } ?>
</div>

<?php include "layout/footer.html" ?>

<!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
