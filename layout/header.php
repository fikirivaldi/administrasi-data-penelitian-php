<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Bagian kiri navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="profile.php"><?php echo $_SESSION['username']; ?></a>
                <img src="profile.png" width="30" height="30" class="d-inline-block align-top" alt="Profile Picture">
            </li>
        </ul>

        <!-- Teks tengah navbar -->
        <div class="text-center mx-auto">
            <p class="navbar-text font-weight-bold h3 text-dark mb-0">Data Penelitian dan Program Kreativitas Mahasiswa</p>
        </div>

        <!-- Tautan Home dan About di bawah teks tengah navbar -->
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
        </ul>

        <!-- Bagian kanan navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>