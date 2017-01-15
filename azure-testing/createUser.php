<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();
  $name = htmlspecialchars($_POST["name"]);
  $password = htmlspecialchars($_POST["password"]);
  $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
  $countResult = "";
  if (strlen($password) < 8) {
       header("Location: /?action=register&status=password");
       exit();
  }

  try{
    $status = create_user($name , $hashedpassword);
  }catch(PDOException $e) {
    header("Location: /?action=register&status=alreadyexists");//should be status failure;
  }

  if($status == 0){
    header("Location: /?action=register&status=success");
  }else{
    header("Location: /?action=register&status=alreadyexists");
  }
?>
