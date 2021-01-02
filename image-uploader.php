<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "situe";
    
    $db = mysqli_connect($servername, $username, $password, $database);

    $ip = $_SERVER['REMOTE_ADDR'];
    $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $short_link = $_SERVER['HTTP_HOST'];
    $actual_page = $_SERVER['REQUEST_URI'];

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $sqlTracking = "INSERT INTO tracking (DOMAIN, PAGE_ACCESSED, FULL_LINK, IP, USER_AGENT) VALUES ('$short_link', '$actual_page', '$actual_link', '$ip', '$user_agent')";

    mysqli_query($db, $sqlTracking);

  // If upload button is clicked ... 
  if (isset($_POST['upload'])) { 
    $ID_name = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 1, 12);

    $filename = $_FILES['uploadimage']['name'];
    $tempname = $_FILES['uploadimage']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $folder = "uploads/images/".$ID_name.".".$ext;

    $keyword = $_POST['keyword'];
          
    $db = mysqli_connect($servername, $username, $password, $database); 
  
    // Get all the submitted data from the form 
    if (!(strcmp($keyword, "") == 0 || strcmp($keyword, " ") == 0))
        $sql = "INSERT INTO images (ORIGINAL_NAME, ID_NAME, IMAGE_PATH, KEYWORD) VALUES ('$filename', '$ID_name', '$folder', '$keyword')";
    else
        $sql = "INSERT INTO images (ORIGINAL_NAME, ID_NAME, IMAGE_PATH) VALUES ('$filename', '$ID_name', '$folder')";

    // Execute query
    if ($filename != "")
        mysqli_query($db, $sql); 

    $sqlKeyword = "IF NOT EXISTS(SELECT * FROM keywords WHERE KEYWORD='$keyword')
                   BEGIN
                   INSERT INTO keywords (KEYWORD) VALUES ('$keyword')
                   END";

    mysqli_query($db, $sqlKeyword);
          
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

                <link rel="icon" href="../Style/favicon.ico">

                <link href="../Style/reset.css" rel="stylesheet">
                <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
                <link href="../Style/index.css" rel="stylesheet">
                <link href="../Style/upload.css" rel="stylesheet">
                <link href="../Style/popup.css" rel="stylesheet">

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="Load-Nav-Bar.js"></script>
            </head>
            <body>
                <main>
                <div id="main-page">
                    <div id="nav-bar"></div>

                    <br><br><br>

                    <header>Your image has been uploaded</header>
                    <p>Here are your share links</p>

                    <br><br><br>

                    <center>
                    <div id="imageContainer">
                    <a href="'.'images/'.$ID_name.".".$ext.'"><img src="'.'images/'.$ID_name.".".$ext.'" id="image"></a>
                    </div>

                    <br><br><br>

                    <div class="popup" id="linksContainer">
                        <p>Image Share Page Link</p>
                        <div onclick="myFunction()">
                            <input type="text" class="shareLink" id="copy-text-share" value="'.'http://localhost/uploads/'.$ID_name.'" readonly><br><br>
                        </div>

                        <p>Direct Link</p>
                        <div onclick="myFunction()">
                            <input type="text" class="shareLink" id="copy-text-direct" value="'.'http://localhost/uploads/images/'.$ID_name.".".$ext.'" readonly><br><br>
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

                    <script src="../copy-on-click.js"></script>

                    <br><br><br>

                </div>
            </main>
            </body>
            </html>
            ';
            fwrite($sharepage, $htmltemplate);

        header("Location: $sharenohtml");
    }
    else { 
        $msg = "Failed to redirect to image sharing utility page. Maybe you forgot to select an actual image to upload."; 
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
    <link href="Style/text-uploader.css" rel="stylesheet">

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
    <br><br><br><br>
    <p><strong>Insert a keyword (optional)</strong> <br> Inserting a keyword will help you find the image, should you need it later on.<br><br> <strong>Only write one keyword.</strong></p>
    <textarea placeholder="Keyword" name="keyword" style="max-width: 25vw; min-height: 1vh; text-align: center;" pattern="[A-Za-z0-9()[]-=_+!@#$%^&*]+"></textarea>
    <br><br><br><br>
    <input type="submit" name="upload" value="Upload">
    </form>

    <br>

    <p><strong>Note:</strong> You will be able to share your image after uploading it.</p>

    <div id="social-media"></div>
</main>
</body>
</html>