<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 10/1/17
 * Time: 1:46 PM
 */
   if(isset($_FILES['file'])){
       $errors= array();
       $file_name = $_FILES['file']['name'];
       $file_size =$_FILES['file']['size'];
       $file_tmp =$_FILES['file']['tmp_name'];
       $file_type=$_FILES['file']['type'];
       $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));

      //  $expensions= array("html");
       //
      //  if(in_array($file_ext,$expensions)=== false){
      //      $errors[]="extension not allowed, please choose a file.";
      //  }

      //  if($file_size > 2097152){
      //      $errors[]='File size must be excately 2 MB';
      //  }

       if(empty($errors)==true){
          //  $target_dir = "uploads/";
          //  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          //  $uploadOk = 1;
          //  $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
           move_uploaded_file($file_tmp,"uploads/".$file_name);
           echo "Success";
          //  $dir = "/Users/Applications/MAMP/htdocs/uploads";
           // Sort in ascending order
          //  `$a = scandir($dir);
          //  print_r($a);`
//           if (is_dir($dir)){
//   if ($dh = opendir($dir)){
//     while (($file = readdir($dh)) !== false){
//       echo "filename:" . $file . "<br>";
//     }
//     closedir($dh);
//   }
// }
      //  }
        // $files = scandir("/htdocs");
        // foreach( $files as $file ){
        //   echo $file . "<br />";
        // }
//         $files = scandir( "MY_DIRECTORY" );
// foreach( $files as $file ){
//    echo $file . "<br />";
// }
      }
      else{
           print_r($errors);
       }
   }
?>
<html>
<head>
  <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
</head>
<body>

<h1>File Uploading</h1>

<h2>Files in Account</h1>

<?php
  //Use Session name to find folder and display files in folder
  $dir = "uploads";
  $files = scandir($dir);
  echo '<ul>';
  foreach( $files as $file ){
    if(($file != ".")&&($file != "..")){
     echo '<li><a href="http://localhost:8888/uploads/' . $file . '">' . $file . '</a></br>';
   }
  }
  echo '</ul>';
?>

<h2>Upload file</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <!--Upload file form.-->
    <input type="file" name="file" />
    <input type="submit"/>

    <ul>
        <li>Sent file: <?php echo $_FILES['file']['name'];  ?>
        <li>File size: <?php echo $_FILES['file']['size'];  ?>
        <li>File type: <?php echo $_FILES['file']['type'] ?>
        <li>File URL: <?php echo '<a href="http://localhost:8888/uploads/' . $_FILES['file']['name'] . '">' . $_FILES['file']['name'] . '</a>' ?>
    </ul>
</form>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      
<script src = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>


</body>
</html>
