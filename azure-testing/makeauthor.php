<?php
  include 'dbconnection.php';
  session_start();

  $name = htmlspecialchars($_SESSION["uid"]);

  if(isset($_POST['optradio']))
  {
    $selected_radio = $_POST['optradio'];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users SET author='$selected_radio' WHERE name='$name'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
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
