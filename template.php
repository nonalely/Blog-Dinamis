<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WebArtikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <div class="bg-primary text-white p-3 text-center">
        <h1 class="m-0">WebArtikel</h1>
        <p class="m-0">Berbagi Cerita dan Informasi Menarik</p>
    </div>

    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">Home</a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto">
            <!-- Tambahan nav jika perlu -->
          </ul>
          <form class="d-flex" role="search" method="GET" action="search.php">
            <input class="form-control me-2" type="search" name="q" placeholder="Cari artikel..." required>
            <button class="btn btn-outline-light" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- Konten + Sidebar -->
    <div class="container mt-4">
        <div class="row">
            <!-- KONTEN UTAMA -->
            <div class="col-md-8">
                <!-- ISI DINAMIS -->
                <?php include("konten.php"); ?>
            </div>

            <!-- SIDEBAR -->
            <div class="col-md-4">
                <div class="mb-4">
                    <h5>Kategori</h5>
                    <ul class="list-group">
                        <?php
                        include("db.php");
                        $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                        while ($row = mysqli_fetch_assoc($kategori)):
                        ?>
                        <li class="list-group-item">
                            <a href="kategori.php?id=<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5>Tentang</h5>
                    <p>WebArtikel adalah blog sederhana untuk menyebarkan cerita dan artikel menarik dari berbagai topik.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-4">
        &copy; 2025 WebArtikel. All rights reserved.
    </footer>

</body>
</html>
