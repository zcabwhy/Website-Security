<?php
  include_once('header.php');
  include_once('navbar.php');
?>
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
        <form action="../controller/login.php" method="post" autocomplete="off">
          <input type="text" name="name" class="form-control" placeholder="Username" required><br>
          <input type="password" name="password" class="form-control" placeholder="Password" required><br>
          <input type="submit" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
