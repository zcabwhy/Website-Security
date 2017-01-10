<?php
  session_start();
  $name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BLOG_APP</title>
  <head>
    <?php
      echo "logged in as ";
      echo $name; ?>
    <a href = "logOut.php">sign out</a>
    <body>
    </body>
</html>
