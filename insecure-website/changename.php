<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["uid"];
  $newName = $_POST["newName"];
  if(!empty($_POST["newName"])) {

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users SET name='$newName' WHERE name='$name'";
      $_SESSION["name"] = $newName;
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $sql = "UPDATE messages SET name='$newName' WHERE name='$name'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $dir = "uploads/" . $name;
      if (file_exists($dir)){
        rename("uploads/" . $name . "/" , "uploads/" . $newName . "/");
      }
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
