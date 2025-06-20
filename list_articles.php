<?php
session_start();
include "db.php";
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT artikel.*, kategori.nama_kategori FROM artikel
    LEFT JOIN kategori ON artikel.id_kategori = kategori.id_kategori");

echo "<h2>Daftar Artikel</h2>";
echo "<a href='create_article.php'>+ Tambah Artikel</a><br><br>";
echo "<table border='1'>
<tr><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Aksi</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['judul']}</td>
        <td>{$row['nama_kategori']}</td>
        <td>{$row['tanggal']}</td>
        <td>
            <a href='edit_article.php?id={$row['id_artikel']}'>Edit</a> |
            <a href='delete_article.php?id={$row['id_artikel']}' onclick=\"return confirm('Yakin?')\">Hapus</a>
        </td>
    </tr>";
}
echo "</table>";
?>
