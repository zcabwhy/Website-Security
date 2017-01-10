<?php
  $name = $_POST["name"];
  $password = $_POST["password"];
  print "name = ";
  echo $name;
  echo "<br>";
  print "password = ";
  echo $password;

  $db = new PDO("mysql:dbname=blog_app", "root", "");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $exec = "INSERT INTO users VALUES ('$name', '$password')";
  $db->exec($exec);

?>


<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>check xss</title>
  <head>
  <body>
    <!- <ー?php echo htmlspecialchars($_POST['name']); ?> -->
