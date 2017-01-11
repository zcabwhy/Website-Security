<?php
  include 'dbconnection.php';
  session_start();
  $name = $_POST["name"];
  $password = $_POST["password"];
  $countResult = "";

  try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $search = "SELECT * FROM users WHERE name = '$name'";
    $result = $conn->query($search)->fetchAll();
    $countResult = count($result);
    if($countResult == 0){
      $sql = "INSERT INTO users (name , password) VALUES ('$name', '$password')";
      $conn->exec($sql);
    }
    $conn = null;
  }catch(PDOException $e) {
    header("Location: register.php?status=alreadyexists");//should be status failure;
  }

  if($countResult == 0){
    header("Location: register.php?status=success");
  }else{
    header("Location: register.php?status=alreadyexists");
  }
?>
