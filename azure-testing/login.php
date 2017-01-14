<?php
  include 'dbconnection.php';

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
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = $conn->prepare("SELECT password FROM users WHERE name = :name");
      $sql->bindParam(':name', $username);
      $sql->execute(); 
      $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
      foreach($rows as $row){
        $cpass = $row["password"];
        if($pw == $cpass){
          $conn = null;
          return TRUE;
        }
      }
      $conn = null;
      return FALSE;
    }catch(PDOException $e) {
      return FALSE;
    }
  }
?>
