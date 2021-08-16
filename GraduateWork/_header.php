<?php
require_once("require.php");
?>

<div id="header" class="backgroundHeader">

    <div class="toggle-btn" onclick="functionShow();">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div id="logo">

        <img src="images/logoImg/img1.jpg">    

    </div><!--end logo-->

    <h2 id="text-h2">Ресторан Антерија</h2>

    <?php
    if(!login())
    {
    ?>
        <div id="nav">
            <ul>
                <li><a href="index.php#wrapperIMG1">Насловна</a></li>
                <li><a href="index.php#aboutUs">О нама</a></li>
                <li><a href="index.php#menu">Мени</a></li>
                <li><a href="index.php#gallery">Галерија</a></li>
                <li><a href="reservation.php">Резервације</a></li>
                <li><a href="index.php#footer">Контакт</a></li>
                <li><a href="tables.php">Пријави се</a></li>
            </ul> 
        </div><!--end nav-->

    <?php
    }
    else if($_SESSION['employee_status']=="Администратор" OR $_SESSION['employee_status']=="Асистент"){
    ?>
           <div id="nav">
           <ul>
                <li class='reserv-li'><a href="index.php#wrapperIMG1">Насловна</a></li>
                <li class='reserv-li'><a href="res_employee.php">Резервације </a></li>
                <li><img src="images/logoImg/img99.jpg" class='excl-mark'></li>
                <li class='reserv-li'><a href="administrator.php">Администрација</a></li>
                <li class='reserv-li'><a href="tables.php">Поруџбине</a></li>
                <li class='reserv-li'><a href="cook.php">Кухиња</a></li>
                <li class='reserv-li'><a href="sql_query.php?logoff">Одјави се</a></li>
            </ul> 
        </div><!--end nav-->
    <?php
    }
    else{

        if($_SESSION['employee_status']=="Конобар"){
        ?>
            <div id="nav">
                <ul>
                    <li class='reserv-li'><a href="res_employee.php">Резервације</a></li>
                    <li class='reserv-li'><a href="tables.php">Поруџбине</a></li>
                    <li class='reserv-li'><a href="sql_query.php?logoff">Одјави се</a></li>
                </ul> 
            </div><!--end nav-->
        <?php
        }
        else{
        ?>   
            <div id="nav">
                <ul>
                    <li class='reserv-li'><a href="res_employee.php">Резервације</a></li>
                    <li class='reserv-li'><a href="cook.php">Кухиња</a></li>
                    <li class='reserv-li'><a href="sql_query.php?logoff">Одјави се</a></li>
                </ul> 
            </div><!--end nav-->
        
        <?php
            }
        ?>
    <?php
    }
    ?>
    
</div>   <!--end header--> 

<script>

    function functionShow(){
        let navBar= document.getElementById("nav");
        navBar.classList.toggle("show");
    }

</script>

