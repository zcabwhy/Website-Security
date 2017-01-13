<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);
?>
<?php include_once('header.php');?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2>Your Snippets</h2>
      <h4><a href='newsnippet.php'>Add Snippet</a> | <a href='allsnippets.php'>View All Snippets </a></h4>
      <div class="col-md-10 col-md-offset-1">
            <?php
            $name = $_SESSION["name"];
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            if(!$conn){
                die("Connection failed: ".mysqli_connect_error());
            }
            $sql = "SELECT * FROM messages WHERE name = '$name'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              echo '<table class="table">
                <thead>
                  <tr>
                    <th style="text-align: left;">Snippet</th>
                    <th style="text-align: center;">Delete</th>
                  </tr>
                </thead>
                <tbody>';
              while($row = mysqli_fetch_assoc($result)) {
                $message = $row['message'];
                if ($message == NULL){
                  $message = "<i>You haven't posted a snippet yet!</i>";
                }
                echo "<tr><td style='text-align:left;'>" . $row["message"] . "</td><td style='width: 175px;text-align:center;'><a href='deletesnippet.php?a=" . $row["ID"] . "'>[X]</a></td></tr>";
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
