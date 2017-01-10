<?php
  session_start();
  $name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"/>
  <title>Snippets</title>
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
          <li>
            <a href="profile.php">Logged in as <?php echo $name; ?></a>
          </li>
          <li>
            <a href="snippets.php">Snippets</a>
          </li>
          <li>
            <a href="fileupload.php">Storage</a>
          </li>
          <li>
            <a href="logOut.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<h2>New Snippet</h2>
<h3>Add a new snippet.</h3>

<div style='width:600'>
<form method="get" action="addsnippettodb.php">
<textarea name='snippet' rows='5' style='width:100%'></textarea>
<br>
<table summary='' style='width:100%'>
<tr>
<td align='left' valign='top'>
  <i>Limited HTML is now supported in snippets (e.g., &lt;b&gt;, &lt;i&gt;,
  etc.)!</i>
</td>
<td align='right' valign='top'>
  <input type='submit' value='Submit'>
</td>
</tr>
</table>
</form>
</div>
</body>

</html>
