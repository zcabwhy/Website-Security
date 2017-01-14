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
    header("Location: /");
  }else{
    header("Location: /?action=login&status=badlogin");
  }

  function checkPass($servername, $dbusername, $dbpassword, $dbname, $username, $pw){
    try{
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $sql = "SELECT password FROM users WHERE name = '$username'";
      // $rows = $conn->query($sql);
      $sql = $conn->prepare("SELECT password FROM users WHERE name = ?");
      $sql->execute(array($username));
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
