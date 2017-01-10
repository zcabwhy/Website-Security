<html>
<!-- <head>
  <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
</head> -->
<body>

<h1>Profile Page</h1>

<h2>Change User Name</h1>

<p> Current User Name: <?php $name = "Name"; echo $name; ?></p>

<form action="" method="post">
New Name: <input type="text" name="newName"><br>
<input type="submit">
</form>

<?php
   $newName = $_POST["newName"];
   $current = "OP";

   if(!empty($_POST["newName"])) {
     $servername = "localhost:8889";
     $username = "root";
     $password = "root";

     // Create connection
    try {
      $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";

      $sql = "UPDATE users SET name='$newName' WHERE name='$current'";

      $stmt = $conn->prepare($sql);

      // execute the query
      $stmt->execute();

      // echo a message to say the UPDATE succeeded
      echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
  }
?>


<h2>Change Password</h2>

<p> Current Password: <?php
$currentname = "Will";
$servername = "localhost:8889";
$username = "root";
$password = "root";
$conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";

$sql = "SELECT password FROM users WHERE name='$currentname'";

// print_r($conn->query($sql));

foreach ($conn->query($sql) as $row) {
      echo $row['password'];
}
$conn = null;?></p>

<form action="" method="post">
New Password: <input type="text" name="newPassword"><br>
<input type="submit">
</form>

<?php
   $newPassword= $_POST["newPassword"];
   $currentName = "Will";

   if(!empty($_POST["newPassword"])) {
     $servername = "localhost:8889";
     $username = "root";
     $password = "root";

     // Create connection
    try {
      $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";

      $sql = "UPDATE users SET password='$newPassword' WHERE name='$currentName'";

      $stmt = $conn->prepare($sql);

      // execute the query
      $stmt->execute();

      // echo a message to say the UPDATE succeeded
      echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
  }
?>


<h2>Change Icon URL</h2>

<p> Current Icon URL: <?php
$currentname = "Will";
$servername = "localhost:8889";
$username = "root";
$password = "root";
$conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";

$sql = "SELECT iconURL FROM users WHERE name='$currentName'";

foreach ($conn->query($sql) as $row) {
      print $row['iconURL'] . "\t";
  }
$conn = null;
// $name = "Icon URL";
// echo $name; ?></p>

<form action="" method="post">
New Icon URL: <input type="text" name="newURL"><br>
<input type="submit">
</form>

<?php
   $newURL= $_POST["newURL"];
   $currentname = "Will";

   if(!empty($_POST["newURL"])) {
     $servername = "localhost:8889";
     $username = "root";
     $password = "root";

     // Create connection
    try {
      $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";

      $sql = "UPDATE users SET iconURL='$newURL' WHERE name='$currentname'";

      $stmt = $conn->prepare($sql);

      // execute the query
      $stmt->execute();

      // echo a message to say the UPDATE succeeded
      echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
  }
?>

<h2>Change Private Snippet</h2>

<p> Current Private Snippet: <?php

  $currentname = "Will";
  $servername = "localhost:8889";
  $username = "root";
  $password = "root";
  $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";

  $sql = "SELECT snippet FROM users WHERE name='$currentName'";

  foreach ($conn->query($sql) as $row) {
        print $row['snippet'] . "\t";
    }
$conn = null;?></p>


<form action="" method="post">
New Snippet: <textarea name='newSnippet' rows='5' style='width:100%'></textarea><br>
<input type="submit">
</form>


<?php
   $newSnippet= $_POST["newSnippet"];
   $currentname = "Will";

   if(!empty($_POST["newSnippet"])) {
     $servername = "localhost:8889";
     $username = "root";
     $password = "root";

     // Create connection
    try {
      $conn = new PDO("mysql:host=$servername;dbname=blog_app", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";

      $sql = "UPDATE users SET snippet='$newSnippet' WHERE name='$currentName'";

      $stmt = $conn->prepare($sql);

      // execute the query
      $stmt->execute();

      // echo a message to say the UPDATE succeeded
      echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
  }
?>

<!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> -->


</body>
</html>
