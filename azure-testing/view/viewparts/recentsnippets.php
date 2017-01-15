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
      echo "<tr><th style='width: 175px;text-align:center;'><a href='/?action=userdetails&linkname=" . $linkname . "'>" . $row["name"]. "</a></th><td style='text-align:left;'>" . $message . "</td></tr>";
    }
    echo "</tbody>
      </table>";
  } else {
    echo "There are no member! Be the first!";
  }
?>
