<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="col-md-6 col-md-offset-3">
    <table class="table">
      <thead>
        <tr>
          <th style="text-align: center;">Names</th>
          <th style="text-align: left;">Messages</th>
        </tr>
      </thead>
      <tbody>
<?php

$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "blog_app";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM (SELECT u.name , m.message , id FROM users as u INNER JOIN messages as m ON m.name = u.name ORDER BY id DESC) AS temp GROUP BY name ORDER BY name";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><th style='width: 175px;text-align:center;'>" . $row["name"]. "</th><td style='text-align:left;'>" . $row["message"]. "</td></tr>";
     }
} else {
     echo "0 results";
}

mysqli_close($conn);
?>
</tbody>
</table>
</div>
</div>
</body>
</html>
