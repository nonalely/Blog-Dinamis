<?php
session_start();
include "db.php";
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];
$artikel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel=$id"));
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];
    $id_kategori = $_POST["id_kategori"];

    $sql = "UPDATE artikel SET judul='$judul', isi='$isi', id_kategori=$id_kategori WHERE id_artikel=$id";
    mysqli_query($conn, $sql);
    header("Location: list_articles.php");
    exit;
}
?>

<h2>Edit Artikel</h2>
<form method="POST">
    Judul:<br>
    <input type="text" name="judul" value="<?= $artikel['judul'] ?>" required><br><br>
    Isi:<br>
    <textarea name="isi" rows="6" cols="50" required><?= $artikel['isi'] ?></textarea><br><br>
    Kategori:<br>
    <select name="id_kategori">
        <?php while ($row = mysqli_fetch_assoc($kategori)): ?>
            <option value="<?= $row['id_kategori'] ?>" <?= $artikel['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>>
                <?= $row['nama_kategori'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>
    <input type="submit" value="Update">
</form>
