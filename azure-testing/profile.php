<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);
  $profileid = $_GET['uid'];
  if ($profileid == ''){
    $profileid = $name;
    $_SESSION["uid"] = $name;
  }
  else $_SESSION["uid"] = $_GET['uid'];
?>
<?php include_once('header.php');?>
  <div class="container">
    <h1>Profile Page</h1>
    <?php
    if ($_GET['status'] == "success"){
      echo "<div class = 'alert alert-success'>Successfully saved settings!</div>";
    } else if ($_GET['status'] == "failure" && $_GET['error'] == "incorrectpassword"){
      echo "<div class = 'alert alert-danger'>Incorrect password was entered.</div>";
    } else if ($_GET['status'] == "failure"){
      echo "<div class = 'alert alert-danger'>Error occurred!" . $_GET['error'] . "</div>";
    }
    ?>

    <p>
      <?php
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
      $sql = "SELECT iconURL FROM users WHERE name='$profileid'";
      foreach ($conn->query($sql) as $row) {
            if ($row['iconURL'] != ''){
              echo "<img style='display: block; margin-left: auto; margin-right: auto;height:300px; width:300px;' src={$row['iconURL']}/>";
            }
        }
      $conn = null;
      // $name = "Icon URL";
      // echo $name; ?>
    </p>
    <h2 style="text-align:center;"><?php echo "$profileid"; ?></h2>
    <h2>Change Username</h1>
    <form action="changename.php" method="post">
      <p><label> Current Username:</label><?php echo " $profileid"; ?></p>
      <input type="text" class="form-control" name="newName"><br>
      <input type="submit" class="btn btn-primary">
    </form>

    <h2>Change Password</h2>
    <form action="changepassword.php" method="post">
      <label>Current Password</label>
      <input type="password" class="form-control" name="currentPassword"><br>
      <label>New Password</label>
      <input type="password" class="form-control" name="newPassword"><br>
      <input type="submit" class="btn btn-primary">
    </form>

    <h2>Change Icon URL</h2>

    <form action="changeIconURL.php" method="post">
      <label>New Icon URL</label>
      <input type="text" class="form-control" name="newURL"><br>
      <input type="submit" class="btn btn-primary">
    </form>
<!--

    <form action="" method="post">
    New Icon URL: <input type="text" name="newURL"><br>
    <input type="submit">
    </form> -->



    <h2>Change Private Snippet</h2>

    <p> <label>Current Private Snippet:</label> <?php
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT snippet FROM users WHERE name='$name'";
      foreach ($conn->query($sql) as $row) {
            // print '<label>';
            print $row['snippet'];
            // print '</label>';
        }
      $conn = null;?>
    </p>


    <form action="changeSnippet.php" method="get">
      <label>New Snippet: </label><textarea name='newSnippet' rows='5' style='width:100%' class="form-control"></textarea><br>
      <!-- <input type="text" class="form-control" name="newName"><br> -->
      <input type="submit" class="btn btn-primary">
    </form>

    <?php
      $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      $sql = "SELECT admin FROM users WHERE name = '" . $name . "'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          if ($row['admin'] == 1){
            $sql = "SELECT admin , author FROM users WHERE name = '" . $profileid . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $admin = $row['admin'];
                $author = $row['author'];
              }
            }
            echo "<h2>Administrator</h2>
            <form action='makeadmin.php' method='get'>
              <fieldset id='group1'>
                <label class='radio-inline'>
                  <input type='radio' name='optradio' value=1" . (($admin==1)?' checked':'') . ">Yes
                </label>
                <label class='radio-inline'>
                  <input type='radio' name='optradio' value=0" . (($admin==0)?' checked':'') . ">No
                </label><br><br>
              </fieldset>
                <input type='submit' class='btn btn-primary'>
            </form>

            <h2>Author</h2>
            <form action='makeauthor.php' method='get'>
              <fieldset id='group2'>
                <label class='radio-inline'>
                  <input type='radio' name='optradio' value=1" . (($author==1)?' checked':'') . ">Yes
                </label>
                <label class='radio-inline'>
                  <input type='radio' name='optradio' value=0" . (($author==0)?' checked':'') . ">No
                </label><br><br>
              </fieldset>
                <input type='submit' class='btn btn-primary'>
            </form><br>";
          } else {
            echo "<br>";
          }
        }
      } else {
        echo "<tr><td>The user has posted no snippets!</td></tr>";
      }
      mysqli_close($conn);
    ?>
  </div>
  <?php include_once('footer.php');?>
