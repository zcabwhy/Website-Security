<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["uid"]);
  $currentPassword = htmlspecialchars($_POST["currentPassword"]);
  $newPassword = htmlspecialchars($_POST["newPassword"]);
  if(!empty($_POST["currentPassword"]) || !empty($_POST["newPassword"])) {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT password FROM users WHERE name = '$name'";
      $rows = $conn->query($sql);
      $found = FALSE;
      foreach($rows as $row){
        if($row["password"] == $currentPassword){
          $found = TRUE;
        }
      }
      if ($found == FALSE){
        header("Location: /?action=profile&status=failure&error=incorrectpassword");
        return;
      }
      $sql = "UPDATE users SET password='$newPassword' WHERE name='$name'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
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
