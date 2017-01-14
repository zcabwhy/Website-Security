<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["uid"]);
  // $currentPassword = $_POST["currentURL"];
  $newURL = $_POST["newURL"];
  if(!empty($_POST["newURL"])) {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $sql = "UPDATE users SET iconURL='$newURL' WHERE name='$name'";
      // $stmt = $conn->prepare($sql);
      // $stmt->execute();
      $sql = $conn->prepare("UPDATE users SET iconURL= :newURL WHERE name = :name");
      $sql->bindParam(':newURL', $newURL);
      $sql->bindParam(':name', $name);
      $sql->execute();
      header("Location: /?action=profile&status=success");
    }
    catch(PDOException $e) {
      header("Location: /?action=profile&status=failure&error=" . $e->getMessage());
    }
    $conn = null;
  } else {
    header("Location: /?action=profile&status=failure");
  }
?>
