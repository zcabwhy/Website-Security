<?php
  include 'dbconnection.php';
  session_start();
  // $name = $_SESSION["name"];
  $name = htmlspecialchars($_SESSION["name"]);

  if (mysqli_num_rows($result_authorstatus) > 0) {
    while($row = mysqli_fetch_assoc($result_authorstatus)) {
        $author = $row['author'];
    }
  }

  $csrf_token = md5(uniqid(rand(), TRUE)); //creates csrf token
  $_SESSION['csrf_token'] = $csrf_token;
  $_SESSION['csrf_token_time'] = time();

?>
<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>New Snippet</h2>
      <h4><a href='/?action=snippets'>Your Snippets</a> | <a href='/?action=allsnippets'>View All Snippets </a></h4>
      <div class="col-md-12">
        <form method="post" action="addsnippettodb.php">
          <div class="form-group">
            <input type="hidden" name = "csrf_form_token" value="<?php echo $csrf_token; ?>" />
            <textarea name='snippet' class="form-control" id="exampleTextarea" rows="3" placeholder=<?php echo (($author==0)?'"You are do not have permission to make a snippet!" disabled':'"Add a new snippet"');?>></textarea>
          </div>
          <?php echo (($author==1)?'<input type="submit" class="btn btn-block btn-primary">':'');?>
        </form>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
