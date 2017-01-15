<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();
  if(!isset($_SESSION['del_token'])){
      $_SESSION['del_token'] = md5(uniqid(rand(), TRUE));
  }

  $token_age = time() - $_SESSION['del_token_time'];

  if(($_GET['del_token'] == $_SESSION['del_token']) && ($token_age<100)){
    $number = $_GET['a'];
    delete_snippet($number);
    header("Location:/?action=snippets");
  }else{
    echo "session time out";
  }

?>
