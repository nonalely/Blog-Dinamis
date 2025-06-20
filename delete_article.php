<?php
session_start();
include "db.php";
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM artikel WHERE id_artikel=$id");
header("Location: list_articles.php");
exit;
?>
