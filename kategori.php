<?php
include "db.php";
$id = $_GET["id"];
$nama = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_kategori FROM kategori WHERE id_kategori = $id"));
$artikel = mysqli_query($conn, "SELECT * FROM artikel WHERE id_kategori = $id ORDER BY tanggal DESC");

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori: <?= $nama['nama_kategori'] ?> - WebArtikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="bg-primary text-white text-center py-3">
    <h1>WebArtikel</h1>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- KONTEN -->
        <div class="col-md-8">
            <h2>Kategori: <?= $nama['nama_kategori'] ?></h2>
            <hr>
            <?php while ($row = mysqli_fetch_assoc($artikel)): ?>
                <div class="mb-4">
                    <h4><a href="artikel.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul'] ?></a></h4>
                    <small class="text-muted"><?= $row['tanggal'] ?></small>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- SIDEBAR -->
        <div class="col-md-4">
            <h5>Kategori Lain</h5>
            <ul class="list-group mb-4">
                <?php while ($row = mysqli_fetch_assoc($kategori)): ?>
                    <li class="list-group-item">
                        <a href="kategori.php?id=<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>

            <h5>Tentang</h5>
            <p>WebArtikel adalah tempat berbagi cerita dari berbagai kategori.</p>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; 2025 WebArtikel
</footer>

</body>
</html>
