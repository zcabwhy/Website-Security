<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_POST["name"]);
  $password = htmlspecialchars($_POST["password"]);
  $countResult = "";
  if (strlen($password) < 8) {
       header("Location: /?action=register&status=password");
       exit();
  }

  try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $search = "SELECT * FROM users WHERE name = '$name'";
    // $result = $conn->query($search)->fetchAll();
    $sql = $conn->prepare("SELECT * FROM users WHERE name = :name");
    $sql->bindParam(':name', $name);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    $countResult = count($result);
    if($countResult == 0){
      // $sql = "INSERT INTO users (name , password) VALUES ('$name', '$password')";
      // $conn->exec($sql);
      $sql = $conn->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
      $sql->bindParam(':name',$name);
      $sql->bindParam(':password',$password);
      $sql->execute();
    }
    $conn = null;
  }catch(PDOException $e) {
    header("Location: /?action=register&status=alreadyexists");//should be status failure;
  }

  if($countResult == 0){
    header("Location: /?action=register&status=success");
  }else{
    header("Location: /?action=register&status=alreadyexists");
  }
?>
