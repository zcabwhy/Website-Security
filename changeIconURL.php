<?php
  session_start();
  $name = $_SESSION["name"];
  // $currentPassword = $_POST["currentURL"];
  $newURL = $_POST["newURL"];
  if(!empty($_POST["newURL"])) {
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
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
