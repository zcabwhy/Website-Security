<!DOCTYPE html>
<html>
<head>
<title> My Snippets </title>
</head>
<body>
<a href="home.php"> Home page </a><br />
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_test";
$name = $_SESSION["name"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
$sql = "SELECT * FROM messages WHERE name = '$name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo " Message: " . $row["message"];?>
        <a href="deletesnippet.php?a=<?=$row["ID"]?>">[X]</a><br/>
    <?php 
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</body>
</html>