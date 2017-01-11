<?php
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "blog_app";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database

$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";

// execute the statement
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
  $sql = "CREATE DATABASE " . $dbname;
  if ($conn->query($sql) === TRUE) {
      echo "Database created successfully";
  } else {
      echo "Error creating database: " . $conn->error;
  }
  mysql_query("CREATE TABLE users(
    users varchar(32) PRIMARY KEY,
    password varchar(16) default null,
    iconURL varchar(500) default null,
    snippet varchar(64) not null,
    admin boolean not null default 0,
    author boolean not null default 1
  )");
  mysql_query("CREATE TABLE messages(
  ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(64) default null,
  message varchar(64) default null
  )");
}
else {
  echo "Databse already exists";
}


$conn->close();
?>

<!-- CREATE TABLE users(
  users varchar(32) PRIMARY KEY,
  password varchar(16) default null,
  iconURL varchar(500) default null,
  snippet varchar(64) not null,
  admin boolean not null default 0,
  author boolean not null default 0
)
CREATE TABLE messages(
  ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(32) default null,
  message varchar(200) default null -->
