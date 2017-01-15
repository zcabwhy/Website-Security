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
    $currentPassword = htmlspecialchars($_POST["currentPassword"]);
    $newPassword = htmlspecialchars($_POST["newPassword"]);
    if (strlen($newPassword) < 8) {
         header("Location: /?action=profile&status=failure&error= Password Must Be Longer Than 8 Characters");
         exit();
    }
    if(!empty($_POST["currentPassword"]) || !empty($_POST["newPassword"])) {
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare("SELECT password FROM users WHERE name = :name");
        $sql->bindParam(':name', $name);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        $found = FALSE;
        foreach($rows as $row){
          if(password_verify($currentPassword, $row["password"])){
            $found = TRUE;
          }
        }
        if ($found == FALSE){
          header("Location: /?action=profile&status=failure&error=incorrectpassword");
          return;
        }
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        change_profilestatus($name , $hashedNewPassword , "password");
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
