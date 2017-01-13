<?php include_once('header.php');?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <h2 class="">Registering</h2>
        </div>
        <?php
        if ($_GET['status'] == "success"){
          echo "<div class = 'alert alert-success'>Account created! Please sign in.</div>";
        } else if ($_GET['status'] == "alreadyexists"){
          echo "<div class = 'alert alert-warning'>Username already exists</div>";
        }
        ?>
        <form action="createUser.php" method="post" autocomplete="off">
          <input type="text" name="name" class="form-control" placeholder="Name" required><br>
          <input type="password" name="password" class="form-control" placeholder="Password" required><br>
          <input type="submit" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
