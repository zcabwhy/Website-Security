<?php
session_start();
$message = $_GET["snippet"];
$name = $_SESSION["name"];
$db = new PDO("mysql:dbname=app_test", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rows = $db->query("INSERT INTO messages VALUES('$name','$message');");
header("Location:home.php");
?>