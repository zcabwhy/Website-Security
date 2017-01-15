<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);
  if ((!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== TRUE)) {
       header('Location: /?action=login');
       exit();
  }
  $del_token = md5(uniqid(rand(), TRUE)); //creates csrf token
  $_SESSION['del_token'] = $del_token;
  $_SESSION['del_token_time'] = time();
?>
<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>Your Snippets</h2>
      <h4><a href='/?action=newsnippet'>Add Snippet</a> | <a href='/?action=allsnippets'>View All Snippets </a></h4>
      <div class="col-md-10 col-md-offset-1">
            <?php
            if (mysqli_num_rows($result_snippets) > 0) {
              echo '<table class="table">
                <thead>
                  <tr>
                    <th style="text-align: left;">Snippet</th>
                    <th style="text-align: center;">Delete</th>
                  </tr>
                </thead>
                <tbody>';
              while($row = mysqli_fetch_assoc($result_snippets)) {
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>You haven't posted a snippet yet!</i>";
                }
                echo "<tr><td style='text-align:left;'>" . $row["message"] . "</td><td style='width: 175px;text-align:center;'><a href='deletesnippet.php?a=" . $row["ID"] . "&del_token=" . $del_token . "'>[X]</a></td></tr>";
              }
              echo "</tbody>
                </table>";
            }
            else {
              echo "<i>You haven't posted a snippet yet!</i>";
            }

            mysqli_close($conn);
            ?>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
