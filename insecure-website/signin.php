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
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
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
        <form action="login.php" method="post" autocomplete="off">
          <input type="text" name="name" class="form-control" placeholder="Username" required><br>
          <input type="password" name="password" class="form-control" placeholder="Password" required><br>
          <input type="submit" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>
  </div>
  <br>
  <br>
  <div class="footer">
    <a href="https://github.com/zcabwhy/Website-Security">
      <img style='display: block; margin-left: auto; margin-right: auto;height:30px; width:30px; margin-bottom: 10px;' src="images/github.png"/>
    </a>
    Copyright © 2017 Kazuma Hochin, Sam Pham, William Lam, Zi Sim - Team K SW3
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"><\/script>')</script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
