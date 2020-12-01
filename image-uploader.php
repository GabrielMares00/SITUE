<?php 
error_reporting(0); 
?> 
<?php 
  $msg = "";
  
  // If upload button is clicked ... 
  if (isset($_POST['upload'])) { 

    $ID_name = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 1, 12);
  
    $filename = $_FILES['uploadimage']['name'];
    $tempname = $_FILES['uploadimage']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $folder = "uploads/images/".$ID_name.".".$ext;
          
    $db = mysqli_connect("localhost", "root", "", "situe"); 
  
    // Get all the submitted data from the form 
    $sql = "INSERT INTO images (ORIGINAL_NAME, ID_NAME, IMAGE_PATH) VALUES ('$filename', '$ID_name', '$folder')"; 
  
    // Execute query
    if ($filename != "")
        mysqli_query($db, $sql); 
          
    // Now let's move the uploaded image into the folder: image 
    if (move_uploaded_file($tempname, $folder)) { 
        header("Location: $folder");
    }else { 
        $msg = "ma pis"; 
    } 
  } 
  $result = mysqli_query($db, "SELECT * FROM image"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload your image</title>
    <link rel="icon" href="Style/favicon.ico">

    <link href="Style/reset.css" rel="stylesheet">
    <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="Style/index.css" rel="stylesheet">
    <link href="Style/image-uploader.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Load-Nav-Bar.js"></script>
    <script src="Load-Footer.js"></script>
</head>

<body>
<main>
    <div id="main-page">
        <div id="nav-bar"></div>
    </div>

    <center><img src="Style/Logo.png" class="logo"></center>
    <header>Select Image</header>

    <form action="" method="POST" enctype="multipart/form-data">
    <br>
    <input type="file" name="uploadimage" class="uploadbutton" id="selectedFile" accept="image/*" style="display: none;">
    <input type="button" value="Browse..." onclick="document.getElementById('selectedFile').click();">
    <br><br>
    <input type="submit" name="upload">
    </form>

    <br>

    <p><strong>Note:</strong> You will be able to share your image after uploading it.</p>

    <div id="social-media"></div>
</main>
</body>
</html>