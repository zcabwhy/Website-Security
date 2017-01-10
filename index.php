<?php
  session_start();
  if(!empty($_SESSION["name"])){
    header("Location: loggedIn.php");
  }else{
    header("Location: notLogged.php");
  }
?>
