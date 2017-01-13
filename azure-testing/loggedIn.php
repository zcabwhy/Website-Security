<?php
  include 'dbconnection.php';
  session_start();

  if(!(isset($_SESSION["name"]) && $_SESSION["name"] != '')){
    header ("Location: notLogged.php");
  }

  $name = htmlspecialchars($_SESSION["name"]);
?>
<?php include_once('header.php');?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>Welcome <?php echo $name?> to Snippets!</h2>
      <?php
      $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      $sql = "SELECT name , password FROM users WHERE name = '$name'";
      // $sql = $conn->prepare("SELECT name , password FROM users WHERE name = :name");
      // //
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

          echo "<h3>User Link</h3><h4>http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?uid=" . $row['name'] . "&pw=" . $row['password'] . "</h4>";
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
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT u.name , n.message FROM users as u LEFT JOIN (SELECT * FROM messages WHERE (name , id) IN (SELECT name , MAX(id) FROM messages GROUP BY name)) AS n ON u.name = n.name ORDER BY u.name";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $linkname = $row['name'];
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>The user hasn't posted a snippet yet!</i>";
                }
                echo "<tr><th style='width: 175px;text-align:center;'><a href='userdetails.php?linkname=" . $linkname . "'>" . $row["name"]. "</a></th><td style='text-align:left;'>" . $message . "</td></tr>";
              }
            }
            mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
