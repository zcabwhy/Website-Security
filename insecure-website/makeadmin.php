<?php
  include 'dbconnection.php';
  session_start();

  $name = $_SESSION["uid"];

  if(isset($_GET['optradio']))
  {
    $selected_radio = $_GET['optradio'];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users SET admin='$selected_radio' WHERE name='$name'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      header("Location: profile.php?uid=$name&status=success");
    }
    catch(PDOException $e) {
      header("Location: profile.php?uid=$name&status=failure&error=" . $e->getMessage());
    }
    $conn = null;
  } else {
    header("Location: profile.php?uid=$name&status=failure");
  }
?>
