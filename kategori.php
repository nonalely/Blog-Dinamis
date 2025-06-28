<?php
session_start();
include "db.php";

// Periksa apakah ID ada di URL, kalau tidak redirect
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID kategori tidak valid.");
}

$id = (int)$_GET["id"];

// Cek apakah kategori benar-benar ada
$kategoriQuery = mysqli_query($conn, "SELECT nama_kategori FROM kategori WHERE id_kategori = $id");
if (!$kategoriQuery || mysqli_num_rows($kategoriQuery) == 0) {
    die("Kategori tidak ditemukan.");
}

$nama = mysqli_fetch_assoc($kategoriQuery);
$artikel = mysqli_query($conn, "SELECT * FROM artikel WHERE id_kategori = $id ORDER BY tanggal DESC");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori: <?= htmlspecialchars($nama['nama_kategori']) ?> - WebArtikel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (jika ada) -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

<!-- Header -->
<div class="bg-primary text-white text-center py-4 mb-4 shadow">
    <h1>WebArtikel</h1>
</div>

<!-- Konten -->
<div class="container">
    <div class="row">
        <!-- Artikel Utama -->
        <div class="col-md-8">
            <h3 class="mb-4">📁 Kategori: <?= htmlspecialchars($nama['nama_kategori']) ?></h3>
            <?php if (mysqli_num_rows($artikel) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($artikel)): ?>
                    <div class="mb-4 p-3 bg-white border rounded shadow-sm">
                        <h4><a href="artikel.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul'] ?></a></h4>
                        <small class="text-muted"><?= $row['tanggal'] ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="alert alert-warning">Belum ada artikel dalam kategori ini.</div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="p-3 bg-white rounded shadow-sm border mb-4">
                <h5>Kategori Lain</h5>
                <ul class="list-group">
                    <?php while ($row = mysqli_fetch_assoc($kategori)): ?>
                        <li class="list-group-item">
                            <a href="kategori.php?id=<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="p-3 bg-white rounded shadow-sm border">
                <h5>Tentang</h5>
                <p>WebArtikel menyediakan beragam konten dari berbagai kategori.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; <?= date('Y') ?> WebArtikel
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

