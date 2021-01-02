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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITUE - Image Search</title>

    <link href="Style/reset.css" rel="stylesheet">
    <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="Style/index.css" rel="stylesheet">
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

        <center><img src="Style/Logo.png" class="logo"></center>
        <header>Text searcher</header>

    <center>
        <form action="" method="POST" style="border-radius: 5px; border-color: rgba(60,59,63,0.6);">
              <h2>Write the keywords you are looking for</h2>
              <br>
              <br>
              <textarea id="textwall" type="text" placeholder="Keyword" name="textwall" style="max-width: 25vw; min-height: 1vh; text-align: center;"></textarea>
              <br>
              <br>

              <input name='upload' type="submit" value="Search">
        </form> 
        <br>
        <p><strong>Note:</strong> Leave the text blank if you are looking for texts not keyworded.</p>
    </center>

        <div id="social-media"></div>
    </div>
</main>
</body>
</html>