<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();

  if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = md5(uniqid(rand(), TRUE));
  }

  $token_age = time() - $_SESSION['csrf_token_time'];

  if(($_POST["csrf_form_token"] == $_SESSION['csrf_token']) && ($token_age<300)){
    $name = $_SESSION["uid"];
    // $currentPassword = $_GET["currentURL"];
    // $newSnippet = $_GET["newSnippet"]; //insecure
    $newSnippet = htmlspecialchars($newSnippet = $_POST["newSnippet"]);
    if(!empty($_POST["newSnippet"])) {
      try {
        change_profilestatus($name , $newSnippet , "privatesnippet");
        header("Location: /?action=profile&status=success");
      }
      catch(PDOException $e) {
        header("Location: /?action=profile&status=failure&error=" . $e->getMessage());
      }
      $conn = null;
    } else {
      header("Location: /?action=profile&status=failure");
    }
  }else{
    echo "invalid session";
  }


?>
