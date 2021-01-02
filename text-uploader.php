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
  
    $title = $_POST['title'];
    $folder = "uploads/texts/".$ID_name.".txt";
    $keyword = $_POST['keyword'];

    if (!file_exists($folder)) {
        $fh = fopen($folder, 'w') or die("Can't create file");
    }

    $text = $_POST['textwall'];
            
    // Get all the submitted data from the form 
    if (!(strcmp($keyword, "") == 0 || strcmp($keyword, " ") == 0)) {
        $sql = "INSERT INTO texts (TITLE, ID_NAME, TEXT_PATH, KEYWORD) VALUES ('$title', '$ID_name', '$folder', '$keyword')";

        $sqlKeyword = "INSERT INTO keywords (KEYWORD)
                    SELECT '$keyword' WHERE NOT EXISTS(SELECT * FROM keywords WHERE KEYWORD='$keyword')";
        mysqli_query($db, $sqlKeyword);

        if ($filename != "")
            mysqli_query($db, $sql); 
    }
    else {
        $sql = "INSERT INTO texts (TITLE, ID_NAME, TEXT_PATH) VALUES ('$title', '$ID_name', '$folder')";
        if ($filename != "")
            mysqli_query($db, $sql); 
    } 
  
    // Execute query
    if ($text != "")
        mysqli_query($db, $sql); 
          
    // Now let's move the uploaded image into the folder: image 
    if (file_put_contents($folder, $text, FILE_APPEND | LOCK_EX)) {
        $sharepageredirect = "uploads/".$ID_name.".html";
        $sharenohtml = "uploads/".$ID_name;
        $sharepage = fopen($sharepageredirect, "w") or die("Unable to create share links page. Your code is bad");
        $htmltemplate = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SITUE - Upload complete</title>
        
            <link rel="icon" href="../Style/favicon.ico">
        
            <link href="../Style/reset.css" rel="stylesheet">
            <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
            <link href="../Style/index.css" rel="stylesheet">
            <link href="../Style/upload.css" rel="stylesheet">
            <link href="../Style/popup.css" rel="stylesheet">
        
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="Load-Nav-Bar-text.js"></script>
        </head>
        <body>
            <main>
                <div id="main-page">
                    <div id="nav-bar"></div>
        
                    <br><br><br><br><br><br>
        
                    <header>Your text has been uploaded</header>
                    <p>Here are your share links</p>
        
                    <br>
                    <p id="title">'.$title.'</p>
                    <br>
                    <div id="list">
                        <p><iframe id="iframeText" src="'.'http://localhost/uploads/texts/'.$ID_name.'.txt'.'" frameborder="0" height="400px" width="100%"></iframe></p>
                    </div>
        
                    <script>
                        var frame = document.getElementById("iframeText");
                            frame.onload = function () {
                                var body = frame.contentWindow.document.querySelector("body");
                                body.style.fontSize = "20px";
                                body.style.lineHeight = "20px";
                                body.style.font = "Sans-serif";
                    };
                    </script>
        
                    <center>
        
                    <div id="linksContainer">
                    <div class="popup" onclick="myFunction()">
                        <p style=>Text Share Page Link</p>
                        <input type="text" class="shareLink" id="copy-text-share" value="'.'http://localhost/uploads/'.$ID_name.'" readonly><br><br>
                    </div>
        
                    <div class="popup" onclick="myFunction()">
                        <p>Direct Link</p>
                        <input type="text" class="shareLink" id="copy-text-direct" value="'.'http://localhost/uploads/texts/'.$ID_name.'.txt'.'" readonly><br><br>
                    </div>
                    </div>
        
                    </center>
        
                    <script src="../copy-on-click.js"></script>
        
                </div>
                <br><br><br>
            </main>
        </body>
        </html>';

        fwrite($sharepage, $htmltemplate);
        header("Location: $sharenohtml");
    }else { 
        $msg = "Failed to redirect to text sharing utility page";
        echo $msg;
    } 
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write your text</title>
    <link rel="icon" href="Style/favicon.ico">

    <link href="Style/reset.css" rel="stylesheet">
    <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="Style/index.css" rel="stylesheet">
    <link href="Style/signup.css" rel="stylesheet">
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

    <center>
        <form action="" method="POST" style="border-radius: 5px; border-color: rgba(60,59,63,0.6);">
              <header>Write your Text</header>
              <br>

              <label for="title"><b>Title</b></label>
              <br>
              <textarea type="text" placeholder="Write your title (optional)" name="title" style="min-height: 2vh; text-align: center;"></textarea>
              <br>
              <br>

              <br><br>

              <label for="textwall"><b>Text</b></label>
              <br>
              <textarea id="textwall" type="text" placeholder="Write your text" name="textwall" style="min-height: 25vh; text-align: center;"></textarea>
              <br>
              <br>

              <p><strong>Insert a keyword (optional)</strong> <br> Inserting a keyword will help you find the image, should you need it later on.<br><br> <strong>Only write one keyword.</strong></p>
              <input type="text" name="keyword" style="background: rgba(60,59,63,0.6); max-width: 25vw; min-height: 1vh; text-align: center; border: none;" pattern="[A-Za-z0-9]+">
              <br><br>

              <input name='upload' type="submit" value="Upload your text">
        </form> 
        </center>

        <br>

        <p><strong>Note:</strong> You will be able to share your text after uploading it.</p>

    <div id="social-media"></div>
</main>
</body>
</html>