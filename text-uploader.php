<?php 
  // If upload button is clicked ... 
  if (isset($_POST['upload'])) { 

    $ID_name = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 1, 12);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "situe";
  
    $title = $_POST['title'];
    $folder = "uploads/texts/".$ID_name.".txt";

    if (!file_exists($folder)) {
        $fh = fopen($folder, 'w') or die("Can't create file");
    }

    $text = $_POST['textwall'];
          
    $db = mysqli_connect($servername, $username, $password, $database);
  
    // Get all the submitted data from the form 
    $sql = "INSERT INTO texts (TITLE, ID_NAME, TEXT_PATH) VALUES ('$title', '$ID_name', '$folder')"; 
  
    // Execute query
    if ($text != "")
        mysqli_query($db, $sql); 
          
    // Now let's move the uploaded image into the folder: image 
    if (file_put_contents($folder, $text, FILE_APPEND | LOCK_EX)) { 
        header("Location: $folder");
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
              <textarea type="text" placeholder="Write your title (optional)" name="title" style="min-height: 2vh;"></textarea>
              <br>
              <br>

              <label for="textwall"><b>Text</b></label>
              <br>
              <textarea id="textwall" type="text" placeholder="Write your text" name="textwall" style="min-height: 25vh;"></textarea>
              <br>
              <br>

              <input name='upload' type="submit" value="Upload your text">
        </form> 
        </center>

    <div id="social-media"></div>
</main>
</body>
</html>