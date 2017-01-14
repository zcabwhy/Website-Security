<?php
  include 'dbconnection.php';
  $number = $_GET['a'];
  $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
  if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
  }
  $sql = "DELETE FROM messages WHERE ID = '$number'";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  header("Location:/?action=snippets");
?>
