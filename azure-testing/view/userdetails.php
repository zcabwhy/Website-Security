<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);

?>
<?php
  include_once('header.php');
  include_once('navbar.php');
?>
  <div class="container">
    <div class="container-fluid text-center">
      <h2><center><?php echo htmlspecialchars($_GET['linkname']); ?></center></h2>
      <div class="col-md-6 col-md-offset-3">


      <?php
      if(mysqli_num_rows($result_validUser) == 0) {
        echo "<h4>User does not exist!</h4>";
      }
      else {
      echo '
        <table class="table">
          <thead>
            <tr>
              <th style="text-align: left;">Snippets (Starting with Most Recent)</th>
            </tr>
          </thead>
          <tbody>';
          if (mysqli_num_rows($result_snippets) > 0) {
            while($row = mysqli_fetch_assoc($result_snippets)) {
              $linkname = $row['name'];
              echo "<tr><td style='text-align:left;'>" . $row["message"]. "</td></tr>";
            }
          } else {
            echo "<tr><td>The user has posted no snippets!</td></tr>";
          }
          echo "</tbody></table>";
        }
      // <div class="col-md-6 col-md-offset-3">
      //   <table class="table">
      //     <thead>
      //       <tr>
      //         <th style="text-align: left;">Snippets (Starting with Most Recent)</th>
      //       </tr>
      //     </thead>
      //     <tbody>';
      //     <?php
      //     if (mysqli_num_rows($result_snippets) > 0) {
      //       while($row = mysqli_fetch_assoc($result_snippets)) {
      //         $linkname = $row['name'];
      //         echo "<tr><td style='text-align:left;'>" . $row["message"]. "</td></tr>";
      //       }
      //     } else {
      //       echo "<tr><td>The user has posted no snippets!</td></tr>";
      //     }
      //
      //     </tbody>
      //     </table>
      ?>
      </div>
    </div>
  </div>
  <?php include_once('footer.php');?>
