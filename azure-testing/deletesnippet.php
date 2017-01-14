<?php
  include 'dbconnection.php';
  session_start();
  if(!isset($_SESSION['del_token'])){
      $_SESSION['del_token'] = md5(uniqid(rand(), TRUE));
  }

  $token_age = time() - $_SESSION['del_token_time'];

  if(($_GET['del_token'] == $_SESSION['del_token']) && ($token_age<100)){
    $number = $_GET['a'];
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if(!$conn){
      die("Connection failed: ".mysqli_connect_error());
    }
    // $sql = "DELETE FROM messages WHERE ID = '$number'";
    // $result = mysqli_query($conn, $sql);
    $sql = $conn->prepare("DELETE FROM messages WHERE ID = ?");
    $sql->bind_param("i",$number);
    $sql->execute();
    mysqli_close($conn);
    header("Location:/?action=snippets");
  }else{
    echo "session time out";
  }

?>
