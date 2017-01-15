<?php
  include 'dbconnection.php';
  session_start();

  if(!(isset($_SESSION["name"]) && $_SESSION["name"] != '')){
    header ("Location: notLogged.php");
    exit;
  }

  $name = htmlspecialchars($_SESSION["name"]);
?>
<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>Welcome <?php echo $name?> to Snippets!</h2>
      <h3>Current Members</h3>
      <div class="col-md-10 col-md-offset-1">
        <?php
          include_once('viewparts/recentsnippets.php');
        ?>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
