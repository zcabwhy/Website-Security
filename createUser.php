<?php
  session_start();
  $servername = "localhost:8889";
  $name = $_POST["name"];
  $password = $_POST["password"];
  $dbusername = "root";
  $dbpassword = "root";

  $conn = new PDO("mysql:host=$servername;dbname=blog_app", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $search = "SELECT * FROM users WHERE name = '$name'";
  $result = $conn->query($search)->fetchAll();
  $countResult = count($result);
  if($countResult == 0){
    $sql = "INSERT INTO users (name , password) VALUES ('$name', '$password')";
    $conn->exec($sql);

    $_SESSION["name"] = $name;
  }
  if($countResult == 0){
    header("Location: register.php?status=success");
  }else{
    header("Location: register.php?status=alreadyexists");
  }
?>
