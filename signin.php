<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"/>
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
            <a href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <h2 class="">Sign-in</h2>
        </div>
        <?php
        if ($_GET['status'] == "loggedout"){
          echo "<div class = 'alert alert-success'>Successfully logged out!</div>";
        } else if ($_GET['status'] == "badlogin"){
          echo "<div class = 'alert alert-danger'>Incorrect username or password!</div>";

        }
        ?>
        <form action="confirmSignin.php" method="post" autocomplete="off">
          <input type="text" name="name" class="form-control" placeholder="Username" required><br>
          <input type="password" name="password" class="form-control" placeholder="Password" required><br>
          <input type="submit" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>
  </div>
</body>
</html>
