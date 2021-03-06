<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();

  if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = md5(uniqid(rand(), TRUE));
  }
  $token_age = time() - $_SESSION['csrf_token_time'];

  if(($_POST["csrf_form_token"] == $_SESSION['csrf_token']) && ($token_age<300)){
    $name = htmlspecialchars($_SESSION["uid"]);
    $newName = htmlspecialchars($_POST["newName"]);
    if(!empty($_POST["newName"])) {

      try {
        change_profilestatus($name , $newName , "name");
        $_SESSION["name"] = $newName;
        change_profilestatus($name , $newName , "messagename");
        $dir = "uploads/" . $name;
        if (file_exists($dir)){
          rename("uploads/" . $name . "/" , "uploads/" . $newName . "/");
        }
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
