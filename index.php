<?php
session_start();
include "db.php";

// Ambil artikel terbaru
$artikel = mysqli_query($conn, "SELECT artikel.*, kategori.nama_kategori 
    FROM artikel 
    LEFT JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
    ORDER BY tanggal DESC 
    LIMIT 7");

// Ambil semua kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Artikel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap JS (opsional, tapi bagus untuk komponen interaktif) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php"><strong>Web Artikel</strong></a>
        <div class="d-flex">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="dashboard.php" class="btn btn-outline-primary me-2">⚙️ Dashboard</a>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-success">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container">
    <div class="row">

        <!-- Konten kiri (artikel) -->
        <div class="col-md-8">
            <h3>📰 Artikel Terbaru</h3>
            <hr>
            <?php while ($row = mysqli_fetch_assoc($artikel)) : ?>
                <div class="mb-4">
                    <h5><a href="artikel.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul'] ?></a></h5>
                    <small class="text-muted"><?= $row['tanggal'] ?> | <?= $row['nama_kategori'] ?></small>
                    <hr>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Sidebar kanan -->
        <div class="col-md-4">
            <div class="mb-4">
                <h5>🔍 Pencarian</h5>
                <form action="search.php" method="GET">
                    <input type="text" name="q" class="form-control" placeholder="Cari artikel...">
                </form>
            </div>

            <div class="mb-4">
                <h5>📁 Kategori</h5>
                <ul class="list-group">
                    <?php while ($kat = mysqli_fetch_assoc($kategori)) : ?>
                        <li class="list-group-item">
                            <a href="kategori.php?id=<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="mb-4">
                <h5>ℹ️ Tentang</h5>
                <p>Web Artikel sederhana untuk latihan membuat sistem manajemen konten.</p>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="text-center mt-5 py-4 bg-white border-top">
    <small>&copy; <?= date('Y') ?> Web Artikel - Dibuat dengan ❤️ dan PHP</small>
</footer>

</body>
</html>
