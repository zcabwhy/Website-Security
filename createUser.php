<?php
  session_start();
  $servername = "localhost:8889";
  $name = $_POST["name"];
  $password = $_POST["password"];
  $dbusername = "root";
  $dbpassword = "root";

  $conn = new PDO("mysql:host=$servername;dbname=blog_app", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $search = "SELECT * FROM users WHERE name = '$name'";
  $result = $conn->query($search)->fetchAll();
  $countResult = count($result);
  if($countResult == 0){
    $sql = "INSERT INTO users (name , password) VALUES ('$name', '$password')";
    $conn->exec($sql);

    $_SESSION["name"] = $name;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Account Created</title>
  <head>
  <body>
    <?php
    if($countResult == 0){
      echo "<p>Account Created</p>";
      echo '<a href = "index.php">Go to main page</a>';
    }else{
      echo "<p>Name already exists</p>";
      echo '<a href = "register.php">Go back to Sign up</a>';
    }
    ?>
  </body>
</html>


<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>check xss</title>
  <head>
  <body>
    <!- <ー?php echo htmlspecialchars($_POST['name']); ?> -->
