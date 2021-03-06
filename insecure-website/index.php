<?php
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
    password varchar(16) default null,
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

  //Redirtection
  session_start();
  if(!empty($_SESSION["name"])){
    header("Location: loggedIn.php");
  }else{
    header("Location: notLogged.php");
  }
?>
