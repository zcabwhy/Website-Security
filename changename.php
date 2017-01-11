<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["name"];

  $newName = $_POST["newName"];

  if(!empty($_POST["newName"])) {
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users SET name='$newName' WHERE name='$name'";
      $_SESSION["name"] = $newName;
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      header("Location: profile.php?status=success");
    }
    catch(PDOException $e) {
      header("Location: profile.php?status=failure&error=" . $e->getMessage());
    }
    $conn = null;
  } else {
    header("Location: profile.php?status=failure");
  }
?>
