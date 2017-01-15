<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();

  $name = htmlspecialchars($_SESSION["uid"]);

  if(isset($_POST['optradio']))
  {
    $selected_radio = $_POST['optradio'];
    try {
      change_profilestatus($name , $selected_radio , "author");
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
