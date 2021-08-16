<?php
session_start();
require_once("require.php");

$db= new Base();
if(!$db->connect()){
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

<div id="title-reservation">
    <h2>Резервације</h2>
    <h4>Сва поља маркирана са * су обавезна</h4>
</div><!--title-reservation-->

<div id="wrapper-reservation">
    <h3>Име *</h3>
    <input type="text" placeholder="Унесите име" id="name" class="input-reservation"><br>
    <h3>Презиме *</h3>
    <input type="text" placeholder="Унесите презиме" id="lastName" class="input-reservation"><br>
    <h3>Е-адреса *</h3>
    <input type="text" placeholder="Унесите е-адресу" id="email" class="input-reservation"><br>
    <h3>Телефон *</h3>
    <input type="text" placeholder="Унесите телефон" id="phone" class="input-reservation"><br>
    <h3>Број гостију *</h3>
    <input type="text" placeholder="Унесите бр. гостију" id="numCustomer" class="input-reservation"><br>
    <h3>Датум *</h3>
    <input type="date" placeholder="Унесите датум" id="date" class="input-reservation"><br>
    <h3>Време *</h3>
    <input type="time" placeholder="Унесите време" id="time" class="input-reservation"><br>
    <h3>Напомена</h3>
    <textarea type="text" id="note" rows="10" cols="70" placeholder="Уколико имате неки захтев, молимо Вас унесите у ово поље" ></textarea><br><br>

    <button type="button" id="btn-reservation" class="input-reservation">Резервишите</button><br><br>

    <h5 id="output-reservation" style="color: red"></h5>
    
</div><!--end wrapper-reservation-->

</body>
</html>