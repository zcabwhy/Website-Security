<?php
  function check_database(){
    include 'dbconnection.php';
    // Create database
    $conn = new mysqli($servername, $dbusername, $dbpassword);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";

    // execute the statement
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
      $sql = "CREATE DATABASE " . $dbname;
      if ($conn->query($sql) === TRUE) {
          //echo "Database created successfully";
      } else {
          //echo "Error creating database: " . $conn->error;
      }
      $conn->close();
    } else {
      //echo "Databse already exists";
    }

    //Create tables
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "CREATE TABLE users(
      name varchar(32) PRIMARY KEY,
      password varchar(255) default null,
      iconURL varchar(500) default null,
      snippet varchar(250) default null,
      admin boolean not null default 0,
      author boolean not null default 1
    )";
    if ($conn->query($sql) === TRUE) {
        //echo "Table MyGuests created successfully";
    } else {
        //echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE messages(
      ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name varchar(32) default null,
      message varchar(200) default null)";
    if ($conn->query($sql) === TRUE) {
        //echo "Table MyGuests created successfully";
    } else {
        //echo "Error creating table: " . $conn->error;
    }
    $conn->close();

  }

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
        $sql = "SELECT * FROM messages ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        break;
    }
    mysqli_close($conn);
    return $result;
  }

  function get_snippets($name){
    include 'dbconnection.php';
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
    session_start();
    $sql = $conn->prepare("SELECT message FROM messages WHERE name = ? ORDER BY id DESC");
    $sql->bind_param('s', $name);
    $sql->execute();
    $result = $sql->get_result();
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
