<?php
include "db.php";
$id = $_GET["id"];
$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT artikel.*, kategori.nama_kategori 
    FROM artikel 
    LEFT JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
    WHERE id_artikel = $id
"));

$terkait = mysqli_query($conn, "
    SELECT * FROM artikel 
    WHERE id_kategori = {$data['id_kategori']} AND id_artikel != $id 
    ORDER BY tanggal DESC LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul'] ?> - WebArtikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="bg-primary text-white text-center py-3">
    <h1>WebArtikel</h1>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- KONTEN -->
        <div class="col-md-8">
            <h2><?= $data['judul'] ?></h2>
            <small class="text-muted">Kategori: <?= $data['nama_kategori'] ?> | <?= $data['tanggal'] ?></small>
            <hr>
            <p><?= nl2br($data['isi']) ?></p>
        </div>

        <!-- SIDEBAR -->
        <div class="col-md-4">
            <h5>Artikel Terkait</h5>
            <ul class="list-group mb-4">
                <?php while ($row = mysqli_fetch_assoc($terkait)): ?>
                    <li class="list-group-item">
                        <a href="artikel.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul'] ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; 2025 WebArtikel
</footer>

</body>
</html>
