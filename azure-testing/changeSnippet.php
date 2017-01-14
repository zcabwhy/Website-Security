<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["uid"];
  // $currentPassword = $_GET["currentURL"];
  // $newSnippet = $_GET["newSnippet"]; //insecure
  $newSnippet = htmlspecialchars($newSnippet = $_POST["newSnippet"]);
  if(!empty($_POST["newSnippet"])) {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // $sql = "UPDATE users SET snippet='$newSnippet' WHERE name='$name'";
      // $stmt = $conn->prepare($sql);
      // $stmt->execute();
      $sql = $conn->prepare("UPDATE users SET snippet = :newSnippet WHERE name = :name");
      $sql->bindParam(':newSnippet', $newSnippet);
      $sql->bindParam(':name',$name); 
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
