<?php
session_start();
require_once("require.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/style.css" rel="stylesheet">

    <!--------------------
        GOOGLE FONTS 
    ----------------------->
    <link href="css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
    

    <!--------------------
        JAVA SCRIPT
    ----------------------->
    <script src="JavaScript/jquery-3.6.0.js"></script>
    <script src="JavaScript/function.js"></script>
    <script src="JavaScript/config.js"></script>
    <script src="JavaScript/administrator.js"></script>

    <title>Ресторан Антерија</title>
</head>
<body>

<div id="wrapper">

    <div class="wrapperIMG1" id="wrapperIMG1">
        <p>Пуних 15 година са Вама, Ваша Антерија</p>

        <?php include_once("_header.php")?>

    </div> <!-- end wrapperIMG1-->
    
    <div class="aboutUs" id="aboutUs">

        <div class="aboutUs-img">
            <img class="AU-img" src="images/logoImg/img3.jpg">
            <img class="AU-img" src="images/logoImg/img4.jpg">
            <img class="AU-img" src="images/logoImg/img11.jpg">
        </div><!-- end aboutUs-img-->

        <div class="aboutUs-text">

            <img src="images/logoImg/img1.jpg">

            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, perferendis corrupti ea nulla nesciunt, eius soluta in culpa veniam fugit odio distinctio expedita facere dolorum fugiat provident mollitia autem. Hic.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, perferendis corrupti ea nulla nesciunt, eius soluta in culpa veniam fugit odio distinctio expedita facere dolorum fugiat provident mollitia autem. Hic.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, perferendis corrupti ea nulla nesciunt, eius soluta in culpa veniam fugit odio distinctio expedita facere dolorum fugiat provident mollitia autem. Hic.</p>
              
        </div><!-- end aboutUs-text-->

    </div> <!-- end aboutUs-->

    <?php include_once("_menu.php")?>

    <?php include_once("_gallery.php")?>

    <?php include_once("_map.php")?>

    <?php include_once("_footer.php");?>

</div> <!-- end wrapper-->
</body>
</html>