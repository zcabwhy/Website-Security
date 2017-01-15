<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';

  $uid = $_GET['uid'];
  $pw = $_GET['pw'];
  if ($uid==''){
    $name = htmlspecialchars($_POST["name"]);
  } else {
    $name = $uid;
  }
  if ($pw==''){
    $password = htmlspecialchars($_POST["password"]);
  } else {
    $password = $pw;
  }

  if(checkPass($servername, $dbusername, $dbpassword, $dbname, $name, $password)){
    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["authorized"] = true;
    header("Location: /");
  }else{
    header("Location: /?action=login&status=badlogin");
  }

  function checkPass($servername, $dbusername, $dbpassword, $dbname, $username, $pw){
    try{
      $results = get_md5password($username);
      foreach($results as $result){
        $cpass = $result["password"];
        if(password_verify($pw, $cpass)){
          return TRUE;
        }
      }
      return FALSE;
    }catch(PDOException $e) {
      return FALSE;
    }
  }
?>
