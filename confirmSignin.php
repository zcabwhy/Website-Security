<?php
  $servername = "localhost:8889";
  $name = $_POST["name"];
  $password = $_POST["password"];
  $dbusername = "root";
  $dbpassword = "root";

  if(checkPass($servername, $dbusername, $dbpassword, $name, $password)){
    session_start();
    $_SESSION["name"] = $name;
    header("Location: index.php"); 

  }else{
    header("Location: signin.php");
  }


  function checkPass($servername, $dbusername, $dbpassword, $username, $pw){
    $conn = new PDO("mysql:host=$servername;dbname=blog_app", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT password FROM users WHERE name = '$username'";
    $rows = $conn->query($sql);
    foreach($rows as $row){
      $cpass = $row["password"];
      if($pw == $cpass){
        return TRUE;
      }
    }

    return FALSE;
  }




?>
