<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"/>
  <title>Sign-in</title>
<head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <h2 class="">Sign-in</h2>
        </div>
        <form action="confirmSignin.php" method="post" autocomplete="off">
          <input type="text" name="name" class="form-control" placeholder="Name"><br>
          <input type="password" name="password" class="form-control" placeholder="Password"><br>
          <input type="submit" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>
  </div>
</body>
</html>
