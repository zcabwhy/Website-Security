<?php include_once('header.php');?>
  <div class="container">
    <div class="container-fluid text-center">
      <h1>Current Members</h1>
      <div class="col-md-10 col-md-offset-1">
            <?php
              include 'dbconnection.php';

              $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }
              $sql = "SELECT u.name , n.message FROM users as u LEFT JOIN (SELECT * FROM messages WHERE (name , id) IN (SELECT name , MAX(id) FROM messages GROUP BY name)) AS n ON u.name = n.name ORDER BY u.name";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                echo "<table class='table'>
                  <thead>
                    <tr>
                      <th style='text-align: center;'>Names</th>
                      <th style='text-align: left;'>Snippet (Most Recent)</th>
                    </tr>
                  </thead>
                  <tbody>";
                while($row = mysqli_fetch_assoc($result)) {
                  $linkname = $row['name'];
                  $message = $row['message'];
                  if ($message == NULL){
                    $message = "<i>The user hasn't posted a snippet yet!</i>";
                  }
                  echo "<tr><th style='width: 175px;text-align:center;'><a href='userdetails.php?linkname=" . $linkname . "'>" . $row["name"]. "</a></th><td style='text-align:left;'>" . $message . "</td></tr>";
                }
              } else {
                echo "There are no member! Be the first!";
              }
              mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <br>
  <br>
  <?php include_once('footer.php');?>
