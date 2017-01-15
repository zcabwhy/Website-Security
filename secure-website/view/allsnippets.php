<?php
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);
?>
<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>All Snippets</h2>
      <h4><a href='/?action=newsnippet'>Add Snippet</a> | <a href='/?action=snippets'>Your Snippets</a></h4>
      <div class="col-md-10 col-md-offset-1">
            <?php
              if (mysqli_num_rows($result_allsnippets) > 0) {
                echo '<table class="table">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Names</th>
                      <th style="text-align: left;">Snippets</th>
                    </tr>
                  </thead>
                  <tbody>';
                while($row = mysqli_fetch_assoc($result_allsnippets)) {
                  $linkname = $row['name'];
                  $message = $row['message'];
                  if ($message == NULL){
                    $message = "<i>No one has posted a snippet yet!</i>";
                  }
                  echo "<tr><th style='width: 175px;text-align:center;'><a href='userdetails.php?linkname=" . $linkname . "'>" . $row["name"]. "</a></th><td style='text-align:left;'>" . $message . "</td></tr>";
                }
                echo "</tbody>
                  </table>";
              } else {
                  echo "<i>No one has posted a snippet yet!</i>";
              }
            ?>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
