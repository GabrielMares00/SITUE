<?php 
  // If upload button is clicked ... 
  if (isset($_POST['upload'])) { 
    $ID_name = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 1, 12);
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "situe";

    $filename = $_FILES['uploadimage']['name'];
    $tempname = $_FILES['uploadimage']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $folder = "uploads/images/".$ID_name.".".$ext;
          
    $db = mysqli_connect($servername, $username, $password, $database); 
  
    // Get all the submitted data from the form 
    $sql = "INSERT INTO images (ORIGINAL_NAME, ID_NAME, IMAGE_PATH) VALUES ('$filename', '$ID_name', '$folder')"; 
  
    // Execute query
    if ($filename != "")
        mysqli_query($db, $sql); 
          
    // Now let's move the uploaded image into the folder: image 
    if (move_uploaded_file($tempname, $folder)) {
        
        $sharepageredirect = "uploads/".$ID_name.".html";
        $sharenohtml = "uploads/".$ID_name;
        $sharepage = fopen($sharepageredirect, "w") or die("Unable to create share links page. Your code is bad");
        $htmltemplate = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>SITUE - Upload Finished</title>

                <link rel="icon" href="Style/favicon.ico">

                <link href="../Style/reset.css" rel="stylesheet">
                <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
                <link href="../Style/index.css" rel="stylesheet">
                <link href="../Style/upload.css" rel="stylesheet">
                <link href="../Style/popup.css" rel="stylesheet">

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            </head>
            <body>
                <main>
                <div id="main-page">
                    <div id="pseudo-nav-bar">
                    <ul class="nav-bar">
                    <li><a href="home" class="left">Home</a></li>
                    <li><a href="about" class="left">About</a></li>

                    <li><a href="login" class="right">Log In</a></li>
                    <li><a href="signup" class="right">Sign Up - It is Free</a></li>

                    <script src="Change-Nav-Bar-Opacity.js"></script>
                    </ul>
                    </div>

                    <br><br><br><br><br><br>

                    <header>Your image has been uploaded</header>
                    <p>Here are your share links</p>

                    <br><br><br>

                    <center>
                    <div class="popup" id="linksContainer">
                        <p>Image Share Page Link</p>
                        <div onclick="myFunction()">
                            <input type="text" class="shareLink" id="copy-text-share" value="'.'localhost/uploads/'.$ID_name.'" readonly><br><br>
                        </div>

                        <p>Direct Link</p>
                        <div onclick="myFunction()">
                            <input type="text" class="shareLink" id="copy-text-direct" value="'.'localhost/uploads/images/'.$ID_name.".".$ext.'" readonly><br><br>
                        </div>

                        <p>BBCode (Forums)</p>
                        <div onclick="myFunction()">
                            <input type="text" class="shareLink" id="copy-text-bbcode" value="'.'[img]http://localhost/uploads/images/'.$ID_name.".".$ext.'[/img]'.'" readonly><br><br>
                        </div>

                        <p>Markdown (Reddit)</p>
                        <div onclick="myFunction()">
                            <input type="text" class="shareLink" id="copy-text-markdown" value="'.'[SITUE](http://localhost/uploads/images/'.$ID_name.".".$ext.')'.'" readonly><br><br>
                        </div>
                    </div>
                    </center>

                    <div class="popup">
                    <span class="popuptext" id="popupSucces">Link copied succesfully</span>
                    </div>

                    <script>
                        function myFunction() {
                        var popup = document.getElementById("popupSucces");
                        popup.classList.toggle("show");
                    }
                    </script>

                    <script src="../copy-on-click.js"></script>
                </div>
            </main>
            </body>
            </html>
            ';
            fwrite($sharepage, $htmltemplate);

        header("Location: $sharenohtml");
    }
    else { 
        $msg = "Failed to redirect to image sharing utility page"; 
        echo $msg;
    } 
  } 
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