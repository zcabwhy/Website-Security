<?php
  include 'dbconnection.php';
  session_start();
  $_SESSION = array();
  @session_destroy();
  if(empty($_SESSION["name"])){
    $errorMessage = "loggedout";
  }else{
    $errorMessage = "error";
  }
  header("Location:signin.php?status=" . $errorMessage);
?>
