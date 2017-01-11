<?php
  session_start();
  $name = $_SESSION["name"];
  // $currentPassword = $_POST["currentURL"];
  $newSnippet = $_POST["newSnippet"];
  if(!empty($_POST["newSnippet"])) {
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
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
