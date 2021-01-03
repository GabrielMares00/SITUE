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

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    //SQL query to insert the tracking data
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
    <link href="Style/signup.css" rel="stylesheet">
    <link href="Style/text-uploader.css" rel="stylesheet">
    <link href="Style/search.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Load-Nav-Bar.js"></script>
    <script src="Load-Footer.js"></script>
</head>
<body>
<main>
    <div id="main-page">
        <div id="nav-bar"></div>

        <center><img src="Style/Logo.png" class="logo"></center>
        <header>Image searcher</header>

    <center>
        <div id="search">
            <?php 
                //Disable notices (breaks some first-visit on search)
                error_reporting( error_reporting() & ~E_NOTICE );

                //Reconnect to database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "situe";
            
                $db = mysqli_connect($servername, $username, $password, $database);

                //Retain keyword
                $keyword = $_POST['keyword'];

                //Perform search
                //Use NULL search if keyword is not provided
                if(isset($_POST['search']) && (strcmp($keyword, "") != 0 && strcmp($keyword, " ") != 0)) {
                    $sql = "SELECT * FROM images WHERE KEYWORD = '$keyword'";
                }
                else if (isset($_POST['search']) && (strcmp($keyword, "") == 0 || strcmp($keyword, " ") == 0))
                    $sql = "SELECT * FROM images WHERE KEYWORD IS NULL";
                else
                    $sql = "SELECT * FROM images where KEYWORD IS NULL";

                $results = mysqli_query($db, $sql);
            ?>
              <form action="" method="POST" style="border-radius: 5px; border-color: rgba(60,59,63,0.6);">
              <h2>Write the keywords you are looking for</h2>
              <br>
              <br>
              <input type="text" placeholder="Keyword" name="keyword" style="max-width: 15vw; min-height: 1vh; text-align: center;">
              <br>
              <p><strong>Note:</strong> Leave the text blank if you are looking for images not keyworded.</p>

              <input name='search' type="submit" value="Search">
        </form>

        <br><br>

        <table id="searchResults">
            <tr>
                <?php
                    //Output "not found" message if there are no images with provided keyword
                    if (mysqli_num_rows($results) == 0)
                    echo "No images with keyword ".$keyword." have been found";
                ?>
            </tr>
            <?php while($row = mysqli_fetch_object($results)) { ?>
            <tr>
                <!-- Outputs each image with a hyperlink to the old image share link -->
                <td><a href="uploads/<?php echo $row->ID_NAME ?>"><image src="<?php echo $row->IMAGE_PATH ?>" style="width: 25vw; height: auto;"></a></td>
            </tr>
            <?php }?>
        </table>
        <br>
        </div>
    </center>

        <div id="social-media"></div>
    </div>
</main>
</body>
</html>