<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "situe";
    
    $db = mysqli_connect($servername, $username, $password, $database);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $ip = $_SERVER['REMOTE_ADDR'];
    $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $short_link = $_SERVER['HTTP_HOST'];

    $sql = "INSERT INTO tracking (PAGE_ACCESSED, FULL_LINK, IP) VALUES ('$short_link', '$actual_link', '$ip')";

    mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITUE - About SITUE</title>
    <link rel="icon" href="Style/favicon.ico">

    <link href="Style/reset.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="https://www.w3schools.com/w3css/3/w3.css" rel="stylesheet">
    <link href="Style/index.css" rel="stylesheet">
    <link href="Style/about.css" rel="stylesheet">
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Load-Nav-Bar.js"></script>
    <script src="Load-Footer.js"></script>
</head>

<body>
    <main>
        <div id="main-page">
            <div id="nav-bar"></div>
        </div>

        <center><img src="Style/Logo.png" class="logo">
            <p id="subtitle">
                Image and text uploading has never been easier.
            </p>

            <br>

        <button type="button" class="collapsible" style="text-decoration: none;">What is SITUE?</button>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>

        <button type="button" class="collapsible">How it works?</button>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>

        <button type="button" class="collapsible">How do I upload an image?</button>
            <div class="content">
                <button type="button" class="collapsible" style="width:60vw; text-align:center">Watch video tutorial</button>
                    <div class="content-video sizer embed-responsive embed-responsive-16by9">
                        <p> <center><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/UNpaOO6pHks" allowfullscreen style="border:none"></iframe></center></p>
                    </div>
                    
                    <p>This is a test.</p>
            </div>

        <button type="button" class="collapsible">How do I upload a text?</button>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>

        </center>

        <script src="Collapsible-Buttons.js"></script>

        <div id="social-media"></div>
    </main>
</body>
</html>