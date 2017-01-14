<?php
  include 'dbconnection.php';
  session_start();
  $name = htmlspecialchars($_SESSION["name"]);
  if ((!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== TRUE)) {
       header('Location: http://localhost:8888/?action=login');
       exit();
  }

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

    $expensions= array("jpeg","jpg","png","gif","pdf","txt");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Extension not allowed, please choose a JPEG, JPG, PNG, GIF, PDF or TXT file.";
      }

      if($file_size > 2097152){
         $errors[]='File size must be less than or equal to 2 MB';
      }


    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"uploads/" . $name . "/" .$file_name);
       $fileMoveStatus = true;
       //echo "Success";
    }
    else{
      $fileMoveStatus = false;
      print($errors[0]);
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.js"></script>
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
  <?php include_once('navbar.php');?>
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
  <?php include_once('footer.php');?>
