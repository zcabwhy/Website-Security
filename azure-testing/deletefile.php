<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);
  $filename = $_GET['filename'];

  unlink("uploads/" . $name . "/" .$filename);
  header("Location: /?action=fileupload");
?>
