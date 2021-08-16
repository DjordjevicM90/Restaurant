<?php
session_start();
require_once("require.php");

if(login() AND $_SESSION['employee_status']=="Кувар"){
    header("location: cook.php");
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
    

    <title>Anterija restoran</title>
</head>
<body>
    <?php include_once("_header.php")?>

    <?php
    if(!login()) /* if user not login show div with inputs for email and password*/
    {
    ?>
        <div id="wrapper-login">

            <h2>Prijavite se</h2>

                <i class="fas fa-user"></i><input type="text" id="email" placeholder="Унесите Вашу е-адресу"><br><br>

                <i class="fas fa-unlock"></i> <input type="password" id="password" placeholder="Унесите Вашу лозинку"><br><br>

                <input type="checkbox" id="remember"> <span>Запамти ме</span><br><br>

                <button type="button" id="login">Улогуј се</button>

            <p id="loginError"></p>

        </div><!-- END of wrapper-login --->
        
    <?php
    }

    else/* if user login show section with tables*/
    {
    ?>
<div id="session-name-table">
    <div id="session-name" data-name="<?=$_SESSION['employee_id']?>" >
        <h3><?=$_SESSION['employee_name']. " - (".$_SESSION['employee_status'].")"?></h3>   
    </div>
    <div id="title-table"></div>
</div>
<hr> 

<div id="wrapper-all-orders">

    <div id="wrapper-orders">

        <div id="temp-orders">

            <h3>Поруџбине:</h3>
          
            <h4>Име артикла</h4>
            <h4>Цена артикла</h4> 
            <h4>Количина </h4>
            <h4>Укупна вредност</h4>
            
            <div id="temp-order-name"></div>

            <div id="total-amount"></div>
            <!-- <textarea id=textarea rows="5" cols="75" placeholder="Унесите коментар"></textarea> -->
            
            <div id="btn-temp-orders">

                <button id="btn-save">Одштампај рачун</button>

            </div><!-- end btn-temp-orders-->

        </div><!-- end temp-orders--> 

    </div><!-- end wrapper-orders--> 

    <div id="wrapper-tables"> <!-- this div appears or hides on $(.tables).click function in JQuery  --> 

        <div class="tables" id="1"><h2>1</h2></div>
        <div class="tables" id="2"><h2>2</h2></div>
        <div class="tables" id="3"><h2>3</h2></div>
        <div class="tables" id="4"><h2>4</h2></div>
    </div> <!-- end wrapper-tables-->
    
    <div id="bill"></div>
    

</div><!-- end wrapper-all-orders--> 

<div class="add-orders"> <!-- this div appears or hides on $(.tables).click function in JQuery  -->  
    
    <div id="wrapper-food-drinks">

        <div class="food-drinks" id="food-order">

            <div id="food-grill">
                <h3>Јела са роштиља</h3>
            </div>

            <div id="food-breakfast">
                <h3>Доручак</h3>
            </div>

            <div id="food-salad">
                <h3>Салате</h3>
            </div>

            <div id="food-soup">
                <h3>Супе и чорбе</h3>
            </div>

        </div>  <!-- food-order-->

        <div class="food-drinks" id="drinks-order">

            <div id="drinks-beer">
                <h3>Пиво</h3>
            </div>

            <div id="drinks-whiskey">
                <h3>Виски</h3>
            </div>

            <div id="drinks-juice">
                <h3>Сокови</h3>
            </div>

        </div>  <!-- drinks-order-->

    </div><!-- wrapper-food-drinks--> 
    
</div> <!-- endadd-orders--> 
    <?php
    }
    ?>
      
</body>
</html>