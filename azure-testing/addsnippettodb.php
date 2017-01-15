<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();

  if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = md5(uniqid(rand(), TRUE));
  }

  $token_age = time() - $_SESSION['csrf_token_time'];

  if(($_POST["csrf_form_token"] == $_SESSION['csrf_token']) && ($token_age<300)){
    $message = htmlspecialchars($_POST["snippet"]); //secure XSS no javascript injection
    $name = htmlspecialchars($_SESSION["name"]);
    create_snippet($name , $message);
    header("Location:/?action=snippets");
  }else{
    echo "invalid session";
  }






?>
