<?php
session_start();
$message = $_GET["snippet"];
$name = $_SESSION["name"];
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog_app";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
$sql = "INSERT INTO messages VALUES(null,'$name','$message');";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location:snippets.php");
?>
