<?php
$host = "sql200.infinityfree.com";
$user = "if0_39347016";
$pass = "dDxJgR11XI";
$db = "if0_39347016_webartikel";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
