<?php
  include 'dbconnection.php';
  include 'model/snippetModel.php';

  check_database();

  //Redirtection
  session_start();

  if (isset($_POST['action'])) {
    $action = $_POST['action'];
  } else if (isset($_GET['action'])) {
    $action = $_GET['action'];
  } else {
    $action = 'index';
  }

  switch ($action) {
    case 'index':
      $result_recentsnippets = get_sqldata("recentsnippets");
      if(!empty($_SESSION["name"])){
        $result_namepassword = get_sqldata("namepassword");
        include "view/loggedIn.php";
      } else {
        include "view/notLogged.php";
      }
      break;
    case 'allsnippets':
      $result_allsnippets = get_sqldata("allsnippets");
      include "view/allsnippets.php";
      break;
    case 'snippets':
      $result_snippets = get_snippets(htmlspecialchars($_SESSION["name"]));
      include "view/snippets.php";
      break;
    case 'fileupload':
      include "view/fileupload.php";
      break;
    case 'profile':
      if ($_GET['uid'] != ''){
        $result_profile = get_sqldataprofile($_GET['uid']);
      } $result_profile = get_sqldataprofile($_SESSION["name"]);
      include "view/profile.php";
      break;
    case 'newsnippet':
      $result_authorstatus = get_sqldata("authorstatus");
      include "view/newsnippet.php";
      break;
    case 'userdetails':
      if ($_GET['linkname'] != ''){
        $result_snippets = get_snippets($_GET['linkname']);
      } else $result_snippets = get_snippets($_SESSION["name"]);
      include "view/userdetails.php";
      break;
    case 'logout':
      include "view/logOut.php";
      break;
    case 'login':
      include "view/signin.php";
      break;
    case 'register':
      include "view/register.php";
      break;
  }
?>
