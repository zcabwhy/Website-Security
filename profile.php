<?php
  session_start();
  $name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="style.css" rel="stylesheet">
  <title>Snippets</title>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
          <?php
          if ($name == NULL) {
            echo "<li>
            <a href='signin.php'>Sign in</a></li><li><a href='register.php'>Register</a></li>";
          } else {
            echo "<li><a href='profile.php'>Logged in as $name</a></li><li><a href='snippets.php'>Snippets</a></li><li><a href='fileupload.php'>Storage</a></li><li><a href='logOut.php'>Logout</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <h1>Profile Page</h1>
    <?php
    if ($_GET['status'] == "success"){
      echo "<div class = 'alert alert-success'>Successfully saved settings!</div>";
    } else if ($_GET['status'] == "failure" && $_GET['error'] == "incorrectpassword"){
      echo "<div class = 'alert alert-danger'>Incorrect password was entered.</div>";
    } else if ($_GET['status'] == "failure"){
      echo "<div class = 'alert alert-danger'>Error occurred!" . $_GET['error'] . "</div>";
    }
    ?>
    <h2>Change Username</h1>
    <form action="changename.php" method="post">
      <p><label> Current Username:</label><?php echo " $name"; ?></p>
      <input type="text" class="form-control" name="newName"><br>
      <input type="submit" class="btn btn-primary">
    </form>
    <h2>Change Password</h2>
    <form action="changepassword.php" method="post">
      <label>Current Password</label>
      <input type="password" class="form-control" name="currentPassword"><br>
      <label>New Password</label>
      <input type="password" class="form-control" name="newPassword"><br>
      <input type="submit" class="btn btn-primary">
    </form>

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
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

  </div>
</body>
</html>
