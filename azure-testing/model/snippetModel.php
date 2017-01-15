<?php
include 'database.php';

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
        $result = $sql->get_result();
        break;
    }
    mysqli_close($conn);
    return $result;
  }

  function get_md5password($uname){
    include 'dbconnection.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT password FROM users WHERE name = :name");
    $sql->bindParam(':name', $uname);
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $results;
  }

  function change_profilestatus($name , $newdata , $querytype){
    include 'dbconnection.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    switch ($querytype){
      case "admin":
        $sql = $conn->prepare("UPDATE users SET admin = :newdata WHERE name = :name");
        $sql->bindParam(':newdata',$newdata);
        break;
      case "author":
        $sql = $conn->prepare("UPDATE users SET author = :newdata WHERE name = :name");
        $sql->bindParam(':newdata',$newdata);
        break;
      case "privatesnippet":
        $sql = $conn->prepare("UPDATE users SET snippet = :newdata WHERE name = :name");
        $sql->bindParam(':newdata',$newdata);
        break;
      case "iconURL":
        $sql = $conn->prepare("UPDATE users SET iconURL= :newdata WHERE name = :name");
        $sql->bindParam(':newdata', $newdata);
        break;
      case "name":
        $sql = $conn->prepare("UPDATE users SET name = :newdata WHERE name = :name");
        $sql->bindParam(':newdata',$newdata);
        break;
      case "messagename":
        $sql = $conn->prepare("UPDATE messages SET name = :newdata WHERE name = :name");
        $sql->bindParam(':newdata', $newdata);
        break;
      case "password":
        $sql = $conn->prepare("UPDATE users SET password = :newdata WHERE name = :name");
        $sql->bindParam(':newdata', $newdata);
        break;
    }
    $sql->bindParam(':name',$name);
    $sql->execute();
    $conn = null;
  }

  function create_snippet($name , $message){
    include 'dbconnection.php';
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
    $temp = null;
    $sql = $conn->prepare("INSERT INTO messages VALUES (?,?,?)");
    $sql->bind_param("iss", $temp, $name, $message);
    $sql->execute();
    mysqli_close($conn);
  }

  function create_user($name , $hashedpassword){
    include 'dbconnection.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT * FROM users WHERE name = :name");
    $sql->bindParam(':name', $name);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    $countResult = count($result);
    if($countResult == 0){
      $sql = $conn->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
      $sql->bindParam(':name',$name);
      $sql->bindParam(':password',$hashedpassword);
      $sql->execute();
      $conn = null;
      return 0; //User created successfuly
    }
    $conn = null;
    return 1; //Already exists
  }

  function delete_snippet($snippetid){
    include 'dbconnection.php';
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if(!$conn){
      die("Connection failed: ".mysqli_connect_error());
    }
    $sql = $conn->prepare("DELETE FROM messages WHERE ID = ?");
    $sql->bind_param("i",$snippetid);
    $sql->execute();
    mysqli_close($conn);
  }
 ?>
