<?php
include "auth.php";
include "db.php";

// Proses simpan artikel jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul     = mysqli_real_escape_string($conn, $_POST['judul']);
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);
    $isi       = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal   = date("Y-m-d");

    $query = "INSERT INTO artikel (judul, id_kategori, isi, tanggal) 
              VALUES ('$judul', '$kategori', '$isi', '$tanggal')";

    if (mysqli_query($conn, $query)) {
        header("Location: list_articles.php");
        exit;
    } else {
        echo "Gagal menambahkan artikel: " . mysqli_error($conn);
    }
}

// Ambil data kategori untuk dropdown
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel - WebArtikel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4">📝 Tambah Artikel Baru</h3>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php while ($row = mysqli_fetch_assoc($kategori)) : ?>
                            <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Artikel</label>
                    <textarea name="isi" class="form-control" rows="7" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan Artikel</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
