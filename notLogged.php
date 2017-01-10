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
            $servername = "localhost:8889";
            $username = "root";
            $password = "root";
            $dbname = "blog_app";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM ( SELECT u.name , m.message , id FROM users as u Left JOIN messages as m ON m.name = u.name ORDER BY id DESC) AS temp GROUP BY name ORDER BY name";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $linkname = $row['name'];
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>The user hasn't posted a snippet yet!</i>";
                }
                echo "<tr><th style='width: 175px;text-align:center;'><a href='userdetails.php?linkname=" . $linkname . "'>" . $row["name"]. "</th><td style='text-align:left;'>" . $message . "</td></tr>";
              }
            } else {
              echo "0 results";
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
