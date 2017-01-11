<?php
  include 'dbconnection.php';
  session_start();
  $message = $_GET["snippet"];
  $name = $_SESSION["name"];
  $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
  if(!$conn){
      die("Connection failed: ".mysqli_connect_error());
  }
  $sql = "INSERT INTO messages VALUES(null,'$name','$message');";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  header("Location:snippets.php");
?>
