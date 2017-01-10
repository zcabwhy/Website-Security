<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"/>
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <h2 class="">Registering</h2>
        </div>
        <form action="createUser.php" method="post" autocomplete="off">
          <input type="text" name="name" class="form-control" placeholder="Name" required><br>
          <input type="password" name="password" class="form-control" placeholder="Password" required><br>
          <input type="submit" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>
  </div>
</body>

</html>
