<?php
  session_start();
  $_SESSION = array();
  @session_destroy();
  if(empty($_SESSION["name"])){
    $errorMessage = "logged out";
  }else{
    $errorMessage = "error";
  }
 ?>


 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Logged out</title>
   <head>
     <?php echo $errorMessage; ?>
     <a href = "index.php">"Back to home page"</a>
 </html>
