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
    $actual_page = $_SERVER['REQUEST_URI'];

    $sql = "INSERT INTO tracking (DOMAIN, PAGE_ACCESSED, FULL_LINK, IP) VALUES ('$short_link', '$actual_page', '$actual_link', '$ip')";

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
        This is a work in progress image and text uploader. Stay tuned! 
        </header>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Quisque malesuada pretium sapien. 
            Pellentesque ut magna id sem ultrices tincidunt in quis arcu. 
            Quisque sed elementum diam. 
            Morbi venenatis nec enim vel aliquet. 
            Cras magna massa, euismod quis libero dictum, 
            bibendum malesuada magna. Vivamus efficitur vitae dolor a viverra. 
            Aliquam mattis ante at orci maximus gravida. 
            Nam dictum orci ac leo accumsan facilisis. 
            Cras magna massa, euismod quis libero dictum, 
            bibendum malesuada magna. Vivamus efficitur vitae dolor a viverra. 
            Aliquam mattis ante at orci maximus gravida. 
            Nam dictum orci ac leo accumsan facilisis. 
            Cras magna massa, euismod quis libero dictum, 
            bibendum malesuada magna. Vivamus efficitur vitae dolor a viverra. 
        </p>

        <p id="subtitle">
            Image and text uploading has never been easier.
        </p>
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