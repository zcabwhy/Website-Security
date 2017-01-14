<?php
  include 'dbconnection.php';
  session_start();
  // $name = $_SESSION["name"];
  $name = htmlspecialchars($_SESSION["name"]);

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
<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>New Snippet</h2>
      <h4><a href='/?action=snippets'>Your Snippets</a> | <a href='/?action=allsnippets'>View All Snippets </a></h4>
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
  <?php include_once('footer.php');?>
