<?php
  $servername = "localhost:8889";
  $name = $_POST["name"];
  $password = $_POST["password"];
  $dbusername = "root";
  $dbpassword = "root";
  print "name = ";
  echo $name;
  echo "<br>";
  print "password = ";
  echo $password;

  $conn = new PDO("mysql:host=$servername;dbname=blog_app", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO users (name , password) VALUES ('$name', '$password')";
  $conn->exec($sql);

?>


<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>check xss</title>
  <head>
  <body>
    <!- <ー?php echo htmlspecialchars($_POST['name']); ?> -->
