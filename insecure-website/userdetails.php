<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="style.css" rel="stylesheet">
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
    <h2><center><?php echo $_GET['linkname'] ?></center></h2>
    <div class="col-md-6 col-md-offset-3">
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: left;">Snippets (Starting with Most Recent)</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $linkname = $_GET['linkname'];

          $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT message FROM messages WHERE name = '" . $linkname . "' ORDER BY id DESC";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $linkname = $row['name'];
              echo "<tr><td style='text-align:left;'>" . $row["message"]. "</td></tr>";
            }
          } else {
            echo "<tr><td>The user has posted no snippets!</td></tr>";
          }
          mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
