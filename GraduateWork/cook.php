<?php
session_start();
require_once("require.php");

$db= new Base();
if(!$db->connect()){
    exit();
}

if(!login() OR $_SESSION['employee_status']=="Конобар"){
    header("location: tables.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/style.css" rel="stylesheet">

    <!--------------------
        GOOGLE FONTS SIZE
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
    
    <title>Anterija restoran</title>

</head>
<body>

    <?php include_once("_header.php")?>

    <div id="session-name-table">
    <div id="session-name" class="session-name-status" data-name="<?=$_SESSION['employee_id']?>" >
        <h3><?=$_SESSION['employee_name']. " - (".$_SESSION['employee_status'].")"?></h3>
    </div>
    </div>
    
    <hr>
    
    <div id="cook-allOrders">
        <h3>Поруџбине</h3>
   
    </div>
</body>
</html>