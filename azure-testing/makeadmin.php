<?php
  include 'dbconnection.php';
  session_start();

  $name = htmlspecialchars($_SESSION["uid"]);

  if(isset($_GET['optradio']))
  {
    $selected_radio = $_GET['optradio'];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $sql = "UPDATE users SET admin='$selected_radio' WHERE name='$name'";
      // $stmt = $conn->prepare($sql);
      // $stmt->execute();
      $sql = $conn->prepare("UPDATE users SET admin = :selected_radio WHERE name = :name");
      $sql->bindParam(':selected_radio',$selected_radio);
      $sql->bindParam(':name',$name);
      $sql->execute();
      header("Location: /?action=profile&uid=$name&status=success");
    }
    catch(PDOException $e) {
      header("Location: /?action=profile&uid=$name&status=failure&error=" . $e->getMessage());
    }
    $conn = null;
  } else {
    header("Location: /?action=profile&uid=$name&status=failure");
  }
?>
