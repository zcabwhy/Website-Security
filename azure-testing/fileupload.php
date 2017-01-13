<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);

  if (!file_exists("uploads")){
    mkdir("uploads");
  }
  if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"uploads/" . $name . "/" .$file_name);
       $fileMoveStatus = true;
       //echo "Success";
    }
    else{
      $fileMoveStatus = false;
      print_r($errors);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="style.css" rel="stylesheet">
  <title>Snippets</title>
  <script>https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.js</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
    $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
  </script>
  <style>
    .file {
      visibility: hidden;
      position: absolute;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Snippets</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php
          if ($name == NULL) {
            echo "<li>
            <a href='signin.php'>Sign in</a></li><li><a href='register.php'>Register</a></li>";
          } else {
            echo "<li><a href='profile.php'>Logged in as $name</a></li><li><a href='snippets.php'>Snippets</a></li><li><a href='fileupload.php'>Storage</a></li><li><a href='logOut.php'>Logout</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <h1>File Storage</h1>
    <h2>Upload file</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <input type="file" name="file" class="file">
        <div class="input-group col-xs-12">
          <input type="text" class="form-control input-lg" disabled placeholder="Upload File">
          <span class="input-group-btn">
            <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
        </div>
      </div>
      <input type="submit" class="btn btn-block btn-primary" ><br>
      <ul>
          <li>Sent file: <?php echo $_FILES['file']['name'];  ?>
          <li>File size: <?php echo $_FILES['file']['size'];  ?>
          <li>File type: <?php echo $_FILES['file']['type'] ?>
          <li>File URL: <?php echo '<a href="http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $name . "/" . $_FILES['file']['name'] . '">' . $_FILES['file']['name'] . '</a>' ?>
      </ul>
    </form>
    <h2>Files in Account</h1>
      <?php
      $dir = "uploads/" . $name;
        if (!file_exists($dir)){
          mkdir($dir);
        } else {
        $files = scandir($dir);
      }
      if (!is_dir_empty($dir)) {
        echo '<table class="table">
          <thead>
            <tr>
              <th style="text-align: left;">Snippet</th>
              <th style="text-align: center;">Delete</th>
            </tr>
          </thead>
          <tbody>';
        foreach( $files as $file ){
          if(($file != ".")&&($file != "..")){
            echo '<tr><td style="text-align:left;"><a href="http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $name . '/' . $file . '">' . $file . '</a>' . '</td><td style="width: 175px;text-align:center;"><a href="deletefile.php?filename=' . $file . '">[X]</a></td></tr>';
          }
        }
        echo "</tbody>
          </table>";
      } else {
        echo "You haven't uploaded any files yet!";
      }

      function is_dir_empty($dir) {
        if (!is_readable($dir)) return NULL;
        return (count(scandir($dir)) == 2);
      }
      ?>
  </div>
  <br>
  <br>
  <div class="footer">
    <a href="https://github.com/zcabwhy/Website-Security">
      <img style='display: block; margin-left: auto; margin-right: auto;height:30px; width:30px; margin-bottom: 10px;' src="images/github.png"/>
    </a>
    Copyright © 2017 Kazuma Hochin, Sam Pham, William Lam, Zi Sim - Team K SW3
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"><\/script>')</script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
