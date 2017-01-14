<?php
require_once('database.php');

  function get_sqldata($querytype){
    include 'dbconnection.php';
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
    switch ($querytype){
      case "namepassword":
        session_start();
        $name = htmlspecialchars($_SESSION["name"]);
        $sql = $conn->prepare("SELECT name, password FROM users WHERE name = ?");
        $sql->bind_param('s',$name);
        $sql->execute();
        $result = $sql->get_result();
        break;
      case "recentsnippets":
        $sql = "SELECT u.name , n.message FROM users as u LEFT JOIN (SELECT * FROM messages WHERE (name , id) IN (SELECT name , MAX(id) FROM messages GROUP BY name)) AS n ON u.name = n.name ORDER BY u.name";
        $result = mysqli_query($conn, $sql);
        break;
      case "authorstatus":
        session_start();
        $name = htmlspecialchars($_SESSION["name"]);
        $sql = $conn->prepare("SELECT author FROM users WHERE name = ?");
        $sql->bind_param('s',$name);
        $sql->execute();
        $result = $sql->get_result();
        break;
      case "allsnippets":
        $sql = "SELECT * FROM messages";
        $result = mysqli_query($conn, $sql);
        break;
      case "snippets":
        session_start();
        $name = htmlspecialchars($_SESSION["name"]);
        $sql = $conn->prepare("SELECT * FROM messages WHERE name = ?");
        $sql->bind_param('s', $name);
        $sql->execute();
        break;
    }
    mysqli_close($conn);
    return $result;
  }

 ?>
