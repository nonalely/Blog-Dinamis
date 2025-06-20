<?php
include "db.php";
$q = mysqli_real_escape_string($conn, $_GET["q"]);
$hasil = mysqli_query($conn, "SELECT * FROM artikel WHERE judul LIKE '%$q%' ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian - WebArtikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="bg-primary text-white text-center py-3">
    <h1>WebArtikel</h1>
</div>

<div class="container mt-4">
    <h2>Hasil Pencarian: "<?= htmlspecialchars($q) ?>"</h2>
    <hr>
    <?php if (mysqli_num_rows($hasil) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
            <div class="mb-4">
                <h4><a href="artikel.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul'] ?></a></h4>
                <small class="text-muted"><?= $row['tanggal'] ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Tidak ada artikel ditemukan.</p>
    <?php endif; ?>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; 2025 WebArtikel
</footer>

</body>
</html>
