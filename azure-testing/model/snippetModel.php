<?php
require_once('database.php');

  function get_recentsnippets() {
    include 'dbconnection.php';

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT u.name , n.message FROM users as u LEFT JOIN (SELECT * FROM messages WHERE (name , id) IN (SELECT name , MAX(id) FROM messages GROUP BY name)) AS n ON u.name = n.name ORDER BY u.name";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function get_namepassword(){
    include 'dbconnection.php';
    session_start();
    $name = htmlspecialchars($_SESSION["name"]);
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT name , password FROM users WHERE name = '$name'";
    // $sql = $conn->prepare("SELECT name , password FROM users WHERE name = :name");
    // //
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return $result;
  }

  function get_allsnippets(){
    include 'dbconnection.php';

    $name = $_SESSION["name"];
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql = "SELECT * FROM messages";
    $result = mysqli_query($conn, $sql);


  }


 ?>
