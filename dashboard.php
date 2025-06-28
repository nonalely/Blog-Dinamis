<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Web Artikel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Selamat Datang, <b><?= $_SESSION['user'] ?></b>!</h2>
            <p class="mb-4">Silakan kelola konten blog melalui menu berikut:</p>

            <div class="d-grid gap-3 col-md-6 mx-auto">
                <a href="create_article.php" class="btn btn-success btn-lg">➕ Tambah Artikel</a>
                <a href="list_articles.php" class="btn btn-primary btn-lg">📋 Lihat Semua Artikel</a>
                <a href="kategori.php" class="btn btn-secondary btn-lg">📁 Kelola Kategori</a>
                <a href="logout.php" class="btn btn-danger btn-lg">🔓 Logout</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
