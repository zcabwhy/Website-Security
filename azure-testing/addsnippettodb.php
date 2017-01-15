<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';
  session_start();

  //Generates csrf token if it doesn't exist already
  if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = md5(uniqid(rand(), TRUE));
  }

  //Calculates how long the token has been used for
  $token_age = time() - $_SESSION['csrf_token_time'];

  //Checks if the csrf token is valid and if the token has been recently generated
  if(($_POST["csrf_form_token"] == $_SESSION['csrf_token']) && ($token_age<300)){
    $message = htmlspecialchars($_POST["snippet"]); //escape before inserting untrusted data
    $name = htmlspecialchars($_SESSION["name"]);
    create_snippet($name , $message);
    header("Location:/?action=snippets");
  }else{
    echo "Invalid Session";
  }






?>
