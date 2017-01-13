<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>Snippets</title>
  <link href="style.css" rel="stylesheet">
<head>
<body>
  <nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
          <li>
            <a href="signin.php">Sign in</a>
          </li>
          <li>
            <a href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="container-fluid text-center">
      <h1>Current Members</h1>
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
              include 'dbconnection.php';

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
              } else {
                echo "There are no member! Be the first!";
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
