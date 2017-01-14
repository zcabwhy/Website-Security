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
      <?php
      if (mysqli_num_rows($result_namepassword) > 0) {
        while($row = mysqli_fetch_assoc($result_namepassword)) {

          echo "<h3>User Link</h3><h4>http://" . $_SERVER['HTTP_HOST'] . "/login.php" . "?uid=" . $row['name'] . "&pw=" . $row['password'] . "</h4>";
        }
      }
      mysqli_close($conn);
      ?>
      <h3>Current Members</h3>
      <div class="col-md-10 col-md-offset-1">
        <table class="table">
          <thead>
            <tr>
              <th style="text-align: center;">Names</th>
              <th style="text-align: left;">Snippet (Most Recent)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($result_recentsnippets) > 0) {
              while($row = mysqli_fetch_assoc($result_recentsnippets)) {
                $linkname = $row['name'];
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>The user hasn't posted a snippet yet!</i>";
                }
                echo "<tr><th style='width: 175px;text-align:center;'><a href='/?action=userdetails&linkname=" . $linkname . "'>" . $row["name"]. "</a></th><td style='text-align:left;'>" . $message . "</td></tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
