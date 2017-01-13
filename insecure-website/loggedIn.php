<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"/>
  <title>Snippets</title>
  <link href="style.css" rel="stylesheet">
<head>
  <nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="profile.php">Logged in as <?php echo $name; ?></a>
          </li>
          <li>
            <a href="snippets.php">Snippets</a>
          </li>
          <li>
            <a href="fileupload.php">Storage</a>
          </li>
          <li>
            <a href="logOut.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>Welcome <?php echo $name?> to Snippets!</h2>
      <?php

      $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT name , password FROM users WHERE name = '$name'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

          echo "<h3>User Link</h3><h4>http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?uid=" . $row['name'] . "&pw=" . $row['password'] . "</h4>";
        }
      }

      mysqli_close($conn);
      ?>
      <h3>Current Members</h3>
      <div class="col-md-10 col-md-offset-1">
        <table class="table">
          <thead>
            <tr>
              <th style="text-align: center;">Names</th>
              <th style="text-align: left;">Snippet (Most Recent)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT u.name , n.message FROM users as u LEFT JOIN (SELECT * FROM messages WHERE (name , id) IN (SELECT name , MAX(id) FROM messages GROUP BY name)) AS n ON u.name = n.name ORDER BY u.name";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $linkname = $row['name'];
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>The user hasn't posted a snippet yet!</i>";
                }
                echo "<tr><th style='width: 175px;text-align:center;'><a href='userdetails.php?linkname=" . $linkname . "'>" . $row["name"]. "</a></th><td style='text-align:left;'>" . $message . "</td></tr>";
              }
            }
            mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<body>
</body>
</html>
