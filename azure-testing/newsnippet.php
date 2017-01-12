<?php
  include 'dbconnection.php';
  session_start();
  $name = $_SESSION["name"];

  $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "SELECT author FROM users WHERE name = '" . $name . "'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $author = $row['author'];
    }
  }

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
      <h2>New Snippet</h2>
      <h4><a href='snippets.php'>Your Snippets</a> | <a href='allsnippets.php'>View All Snippets </a></h4>
      <div class="col-md-12">
        <form method="get" action="addsnippettodb.php">
          <div class="form-group">
            <textarea name='snippet' class="form-control" id="exampleTextarea" rows="3" placeholder=<?php echo (($author==0)?'"You are do not have permission to make a snippet!" disabled':'"Add a new snippet"');?>></textarea>
          </div>
          <?php echo (($author==1)?'<input type="submit" class="btn btn-block btn-primary">':'');?>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
