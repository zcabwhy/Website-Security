<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["uid"];
  // $currentPassword = $_GET["currentURL"];
  $newSnippet = $_GET["newSnippet"];
  if(!empty($_GET["newSnippet"])) {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE users SET snippet='$newSnippet' WHERE name='$name'";
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
