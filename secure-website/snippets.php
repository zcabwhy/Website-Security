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
</head>
<body>
  <nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
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
      <h2>Your Snippets</h2>
      <h4><a href='newsnippet.php'>Add Snippet</a> | <a href='allsnippets.php'>View All Snippets </a></h4>
      <div class="col-md-10 col-md-offset-1">
        <table class="table">
          <thead>
            <tr>
              <th style="text-align: left;">Snippet</th>
              <th style="text-align: center;">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $name = $_SESSION["name"];
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            if(!$conn){
                die("Connection failed: ".mysqli_connect_error());
            }
            $sql = "SELECT * FROM messages WHERE name = '$name'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>You haven't posted a snippet yet!</i>";
                }
                echo "<tr><td style='text-align:left;'>" . $row["message"] . "</td><td style='width: 175px;text-align:center;'><a href='deletesnippet.php?a=" . $row["ID"] . "'>[X]</a></td></tr>";
              }
            }
            else {
              echo "<i>You haven't posted a snippet yet!</i>";
            }

            mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>