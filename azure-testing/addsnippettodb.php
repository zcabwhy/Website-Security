<?php
  include 'dbconnection.php';
  session_start();
  // $message = $_GET["snippet"]; insecure
  $message = htmlspecialchars($_GET["snippet"]); //secure XSS no javascript injection
  $name = htmlspecialchars($_SESSION["name"]);
  $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
  if(!$conn){
      die("Connection failed: ".mysqli_connect_error());
  }
  $temp = null;
  // $sql = "INSERT INTO messages VALUES(null,'$name','$message');";
  // $result = mysqli_query($conn, $sql)
  $sql = $conn->prepare("INSERT INTO messages VALUES (?,?,?)");
  $sql->bind_param("iss", $temp, $name, $message);
  $sql->execute(); 
  mysqli_close($conn);
  header("Location:/?action=snippets");
?>
