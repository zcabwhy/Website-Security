<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["name"];
  $filename = $_GET['filename'];

  unlink("uploads/" . $name . "/" .$filename);
  header("Location: fileupload.php");
?>
