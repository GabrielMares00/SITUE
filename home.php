<?php
    //Connecting to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "situe";
    
    $db = mysqli_connect($servername, $username, $password, $database);

    //Tracking data about user, containing his IP and User Agent
    $ip = $_SERVER['REMOTE_ADDR'];
    $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $short_link = $_SERVER['HTTP_HOST'];
    $actual_page = $_SERVER['REQUEST_URI'];

    //If the homepage is accessed as "SITUE.xyz" instead of "SITUE.xyz/home", write it in the database as "/home" instead of "/"
    if (strcmp("/", $actual_page) == 0) {
        $actual_page = '/home';
        $actual_link = $actual_link.'home';
    }

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    //SQL query to insert the tracking data
    $sql = "INSERT INTO tracking (DOMAIN, PAGE_ACCESSED, FULL_LINK, IP, USER_AGENT) VALUES ('$short_link', '$actual_page', '$actual_link', '$ip', '$user_agent')";

    mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITUE - The Simplest Image & Text Uploader Ever</title>
    <link rel="icon" href="Style/favicon.ico">

    <link href="Style/reset.css" rel="stylesheet">
    <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="Style/index.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Load-Nav-Bar.js"></script>
    <script src="Load-Footer.js"></script>
</head>

<body>
<main>
    <div id="main-page">
        <div id="nav-bar"></div>

        <center><img src="Style/Logo.png" class="logo"></center>

        <header>
        Welcome to SITUE - Simplest Image & Text Uploader Ever
        </header>

        <p id="subtitle">
            Image and text uploading has never been easier.
        </p>

        <p>
            With SITUE, image and text uploading has never been easier. You just select your image or write your text, upload it
            and that's it, simple as that.

            You can also search for your images and texts easier with keywords, should you wish to see your already uploaded images and texts.
            Also, because we use keywording instead of old fashioned logins, everything is centralized: we don't collect any data about you.
        </p>

        <center>
        <h4>
            So, what are you waiting for? Start uploading!
        </h4>
        </center>

        <br>
    </div>

    <center>
    <div>
            <a href="image-uploader" id="upload-button" style="text-decoration: none;"><input class="upload-button" type=button value='Upload Image'></a>

            <div class="divider"></div>

            <a href="text-uploader" id="upload-button" style="text-decoration: none;"><input class="upload-button" type=button value='Upload Text'></a></center>
    </div>
    </center>

    <div id="social-media"></div>

</main>
</body>

</html>