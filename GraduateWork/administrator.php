<?php
session_start();
require_once("require.php");

$db= new Base();
if(!$db->connect()){
    exit();
}
if(!login() OR $_SESSION['employee_status']!="Администратор"){
    header("location: tables.php");
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

    <div id="employee-add-delete" class="section-adm">Запослени (додај - избриши)</div>
    <div id="gallery-add-delete" class="section-adm">Галерија-Слике (додај - избриши)</div>
    <div id="menu-add-delete" class="section-adm">Мени (додај - избриши)</div>
    <div id="orders-overview" class="section-adm">Преглед свих поруџбина</div>
    <div id="reservation-overview" class="section-adm">Преглед свих резервације</div>
    <div id="employee-statistics" class="section-adm">Статистика</div>

<!-- section for add, update or delete employee -->

    <div id="wrapper-employee">

        <div id="wrapper-employee-btn">
            <div id="all-employee"></div>
            <div class="btn-back">Назад</div>  
        </div>
        
        <div id="data-employee">
            <h3>Додај или измени запосленог</h3>
            <form>
                <p>Редни бр. запосленог</p>
                <input type="text" id="empId" disabled><br>
                <p>Име</p>
                <input type="text" id="empName" placeholder="Унесите име"><br>
                <p>Презиме</p>
                <input type="text" id="empLastName" placeholder="Унесите презиме"><br>
                <p>Е-адреса</p>
                <input type="text" id="empEmail" placeholder="Унесите е-адресу"><br>
                <p>Лозинка</p>
                <input type="password" id="empPassword" placeholder="Доделите шифру кориснику"><br>
                <p>Телефон</p>
                <input type="text" id="empNumber" placeholder="Унесите број тел."><br>
                <p>Статус запосленог</p>
                <select name="empStatus" id="empStatus">
                    <option value="0">Изаберите статус</option>
                    <option value="Администратор">Администратор</option>
                    <option value="Асистент">Асистент</option>
                    <option value="Конобар">Конобар</option>
                    <option value="Кувар">Кувар</option>
                </select><br><br>
                <button type="button" id="btn-save-employee">Додај корисника</button>
                <button type="button" id="btn-delete-employee">Обриши корисника</button>
                <button type="button" id="btn-clean-input">Очисти поља</button>
            </form><br>
            <div id="answer"></div>
        </div><!-- end of data-employee-->
    
    </div> <!-- end of wrapper-employee-->

<!-- end of section for add, update or delete employee -->


<!-- section for gallery -->

    <div id="wrapper-gallery">
        <div id="all-images"></div>
        <form action="" method="" id="add-img"> 
            <input type="file" name="image" id="image" multiple><br><br>
            <button type="button" id="btn-addImg">Додај слику</button> 
            <button type="button" id="btn-deleteImg">Обриши слику/е</button> 
        </form>
        <div id="answer-image"></div>  
    </div>

<!-- end of section for gallery -->


<!-- section for menu -->

    <div id="wrapper-menu">

        <div class="wrapper-menu-btn">
            <h3>Храна</h3>
            <div id="all-menu"></div> 
        </div>

        <div id="data-menu">
            <h4>Додај или измени артикал</h4>
            <form>
                <p>Шифра артикла</p>
                <input type="text" id="itemId" disabled><br>
                <p>Назив</p>
                <input type="text" id="itemName" placeholder="Унесите назив артикла"><br>
                <p>Цена</p>
                <input type="text" id="itemPrice" placeholder="Унесите цену артикла"><br><br>
                <select name="itemStatus" id="itemStatus">
                    <option value="0" data-type="0">Изаберите категорију</option>
                <?php
                    $sql="SELECT * FROM category";
                    $results=$db->query($sql);
                    while($row=$db->fetch_object($results)){
                        echo "<option value='{$row->category_id}' data-type='{$row->category_type}'>$row->category_name</option>";
                    }
                ?>
                </select><br><br>
                      
                <button type="button" id="btn-save-item">Додај артикал</button>
                <button type="button" id="btn-delete-item">Обриши артикал</button>
                <button type="button" id="btn-clean-input-item">Очисти поља</button>
            </form><br>

            <div id="answer-menu"></div>

        </div><!-- end of data-menu-->

        <div class="wrapper-menu-btn">
            <h3>Пића</h3>
            <div id="all-menu-drinks"></div> 
        </div>

    </div> <!-- end of wrapper-menu-->

<!-- end of section for menu -->



<!-- section for orders overview -->

    <div id="wrapper-select">
        <select name="select" id="select">
            <option class="option" value="1">Преглед свих поруџбина</option>
            <option class="option" value="2">Преглед по столовима</option>
            <option class="option" value="3">Преглед хране</option>
            <option class="option" value="4">Преглед пића</option>
        </select> <button type="button" id="btn-select">Прегледај</button>
    </div> <!--end of wrapper-select-->

    <div id="wrapper-tables-admin"> <!-- this div appears or hides on $(.tables).click function in JQuery  --> 

        <div class="tables-admin" id="1"><h2>1</h2></div>
        <div class="tables-admin" id="2"><h2>2</h2></div>
        <div class="tables-admin" id="3"><h2>3</h2></div>
        <div class="tables-admin" id="4"><h2>4</h2></div>

    </div> <!-- end wrapper-tables-->
  
    <div id="all-orders"></div>
    <div id="total-amount-admin"></div>

<!-- end of orders overview -->

<!-- section for reservations overview -->

    <div id="wrapper-reservation" style="display:none">
            
    </div> <!--end of wrapper-select-->

<!-- end of reservations overview -->

<!-- section for statistics -->

    <div id="wrapper-statistics">
     
        <?php
        $outputUsers="";
        $outputAdmin="";
            if(file_exists("statistics/employee_users.log")){
                $outputUsers=file_get_contents("statistics/employee_users.log");
                $outputUsers=nl2br($outputUsers);
            }
            if(file_exists("statistics/employee_admin.log")){
                $outputAdmin=file_get_contents("statistics/employee_admin.log");
                $outputAdmin=nl2br($outputAdmin);
            }
            if(file_exists("statistics/reservation.log")){
                $outputReservation=file_get_contents("statistics/reservation.log");
                $outputReservation=nl2br($outputReservation);
            }
        ?>
        <div class="all-statistics"><h3>Статистика запослених</h3><?=$outputUsers?></div>
        <div class="all-statistics"><h3>Статистика администратора</h3><?=$outputAdmin?></div>
        <div class="all-statistics"><h3>Статистика реѕервација</h3><?=$outputReservation?></div>
    </div><!-- end of wrapper-statistics-->

<!-- end of section for statistics -->

</body>
</html>