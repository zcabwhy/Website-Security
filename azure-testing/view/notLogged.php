<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h1>Current Members</h1>
      <div class="col-md-10 col-md-offset-1">
            <?php
              if (mysqli_num_rows($result_recentsnippets) > 0) {
                echo "<table class='table'>
                  <thead>
                    <tr>
                      <th style='text-align: center;'>Names</th>
                      <th style='text-align: left;'>Snippet (Most Recent)</th>
                    </tr>
                  </thead>
                  <tbody>";
                while($row = mysqli_fetch_assoc($result_recentsnippets)) {
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
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <br>
  <br>
  <?php include_once('footer.php');?>
