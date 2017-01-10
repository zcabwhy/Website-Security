<?php
$number = $_GET['a'];
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog_app";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
$sql = "DELETE FROM messages WHERE ID = '$number'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location:snippets.php");
?>
