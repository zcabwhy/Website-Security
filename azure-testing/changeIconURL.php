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
      //
      // $sql = "SELECT password FROM users WHERE name = '$name'";
      // $rows = $conn->query($sql);
      // $found = FALSE;
      // foreach($rows as $row){
      //   if($row["password"] == $currentPassword){
      //     $found = TRUE;
      //   }
      // }
      // if ($found == FALSE){
      //   header("Location: profile.php?status=failure&error=incorrectpassword");
      //   return;
      // }
      $sql = "UPDATE users SET iconURL='$newURL' WHERE name='$name'";
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
