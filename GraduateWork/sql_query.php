<?php
session_start();
require_once("require.php");

$db=new Base();
if(!$db->connect()){
   exit();
}

$output['error']="";
$output['location']="";
$output['data']="";


if(isset($_SESSION['time'])) 
{
    if(time()-60>$_SESSION['time']){ //If is passed 1 minute, destroy these sessions.
        unset($_SESSION['time']);
        unset($_SESSION['mistake']);
    }
}

//if the user entered the wrong e-mail or password 5 times , then disaloow log for 1 minute, for that user and create session['time'].
if(isset($_SESSION['mistake']) and $_SESSION['mistake']==5) 
{
    $output['error']="Унели сте више од 5 пута погрешне податке, морате сачекати 1 минут да бисте се улоговали.";
    Statistics::writeNote("statistics/employee_users.log", "Корисник са IP  адресе - ". $_SERVER['REMOTE_ADDR'] ." је добио забрану на 1 минут");

    if(!isset($_SESSION['time']))
    {
        $_SESSION['time']=time();
    }
    echo JSON_encode($output, 256);
    exit();   
}

/*------------------------------
tables.php and menu - query 
------------------------------- */

    //login.php

    if(isset($_GET['login'])){
        $email=$db->escape_string($_POST['email']);
        $password=$db->escape_string($_POST['password']);
        $remember=$_POST['remember'];

        $salt="GrJXCV3p44Vlo";

        $email=filter_var($email, FILTER_SANITIZE_EMAIL);
        $password=filter_var($password,FILTER_SANITIZE_STRING);

        if($email!="" AND $password!=""){
            if(validationStr($email) AND validationStr($password)){
                $sql="SELECT * FROM employee_users WHERE employee_email='{$email}'";
                $results=$db->query($sql);

                if($db->num_rows($results)==1)
                {
                    $row=$db->fetch_object($results);
        
                    if(password_verify($password.$salt, $row->employee_password))
                    {
                        createSession($row->employee_id, $row->employee_name, $row->employee_lastname, $row->employee_email, $row->employee_status, $remember);
                        
                        if($_SESSION['employee_status']=="Кувар")
                        {
                            $output['location']="cook.php";
                        }
                        else
                        $output['location']="tables.php";

                        Statistics::writeNote("statistics/employee_users.log", $_SESSION['employee_name']." се успешно пријавио/ла.");
                    } 
                    else
                    {
                        $output['error']="Погрешно унет е-адреса или лозинка.";
                        Statistics::writeNote("statistics/employee_users.log", "Погрешно унет емаил или лозинка."."(".$email."), захтев послат са IP адресе - ".$_SERVER['REMOTE_ADDR']);

                        if(!isset($_SESSION['mistake'])){ //After first wrong user input, create session['mistake'].
                            $_SESSION['mistake']=1;
                        }
                        else{
                            ++$_SESSION['mistake']; //If session['mistake'] alredy exists, then increase its value by 1.
                        }
                    }
                }
                else
                {
                    $output['error']="Корисник са е-адресом " .$email. " не постоји.";
                    Statistics::writeNote("statistics/employee_users.log", "Корисник са е-адресом " .$email. " не постоји. Захтев послат са IP адресе - ".$_SERVER['REMOTE_ADDR']);

                    if(!isset($_SESSION['mistake']))
                    {
                        $_SESSION['mistake']=1;
                    }
                    else
                    {
                        ++$_SESSION['mistake'];
                    }
                }
            }
            else
            {
                $output['error']="Неки од података садрже недозвољени карактер.";
                Statistics::writeNote("statistics/employee_users.log", "Неки од података садрже недозвољени карактер. (".$email." ".$password.")");
            }
        }
        else
        {
            $output['error']="Сви подаци су обавезни.";
            Statistics::writeNote("statistics/employee_users.log", "Корисник ".$email." Није унео све податке.");
        }    
    }

    if(isset($_GET['logoff']))
    {
        Statistics::writeNote("statistics/employee_users.log", $_SESSION['employee_name']." се успешно одјавио/ла.");
        destroySession();
        header("location: tables.php");
    }
    // end of login.php


    /*food query for tables.php and MENU section*/
    if(isset($_GET['food']))
    {
        $sql="SELECT * FROM food ORDER BY food_category_id ASC";
        $results=$db->query($sql);

        $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC); 
    }

    /*drinks query for tables.php*/

    if(isset($_GET['drink']))
    {
        $sql="SELECT * FROM drinks  ORDER BY drinks_category_id ASC";
        $results=$db->query($sql);

        $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC); 
    }

    //all orders for one table
    if(isset($_GET['order']))
    {
        $tableNum=$_POST['numTable'];
        $sql="SELECT * FROM orders_view WHERE section_id='{$tableNum}' AND order_active=0";
        $results=$db->query($sql);

        $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
    }

    //select all from orders table
    if(isset($_GET['selectAll-order']))
    {
        $sql="SELECT * FROM orders";
        $results=$db->query($sql);

        $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
    }

    // set new qunatity for food or drink item
    if(isset($_GET['update-order']))
    {
        $id=$_POST['id'];
        $valInputNum=$_POST['valInputNum'];
        $comment=$_POST['comment'];
        $foodName=$_POST['foodName'];
        $table=$_POST['table'];
        $category=$_POST['category'];
        $decerase=$_POST['decerase'];

        if($category=="food")
        {
            if($decerase!="decerase")
            {
                $sql="UPDATE food SET food_quantity=food_quantity+1 WHERE food_name='{$foodName}'";
                $result=$db->query($sql); 
            }
            else
            {
                if($valInputNum==0)
                {
                    $sql="UPDATE food SET food_quantity=food_quantity-1 WHERE food_name='{$foodName}'";
                    $result=$db->query($sql);

                    $sql="DELETE FROM orders WHERE order_item='{$foodName}' AND order_quantity=1 AND section_id='{$table}' AND order_active=0";
                    $result=$db->query($sql);

                    $output['data']="remove";

                    echo JSON_encode($output, 256);
                    
                    return false;
                }
                else
                {
                    $sql="UPDATE food SET food_quantity=food_quantity-1 WHERE food_name='{$foodName}'";
                    $result=$db->query($sql);
                }
                 
            }
            
        }
        else
        {
            if($decerase!="decerase")
            {
                $sql="UPDATE drinks SET drinks_quantity=drinks_quantity+1 WHERE drinks_name='{$foodName}'";
                $result=$db->query($sql);
            }
            else
            {
                if($valInputNum==0)
                {
                    $sql="UPDATE drinks SET drinks_quantity=drinks_quantity-1 WHERE drinks_name='{$foodName}'";
                    $result=$db->query($sql);

                    $sql="DELETE FROM orders WHERE order_item='{$foodName}' AND order_quantity=1 AND section_id='{$table}' AND order_active=0";
                    $result=$db->query($sql);

                    $output['data']="remove";

                    echo JSON_encode($output, 256);

                    return false;
                }
                else
                {
                    $sql="UPDATE drinks SET drinks_quantity=drinks_quantity-1 WHERE drinks_name='{$foodName}'";
                    $result=$db->query($sql);
                }
                
            }          
        }
        
        $sql="UPDATE orders SET order_quantity='{$valInputNum}', order_comment='{$comment}'  WHERE order_id=$id AND order_item='{$foodName}' AND section_id=$table AND order_active=0";
        $result=$db->query($sql);

        if($db->error())
        {
            $output['error']="Грешка у систему."; 
            $output['data']="";  
        }
        else
        $output['data']="*";
    }

    //insert orders for a table
    if(isset($_GET['insert-order']))
    {
        $foodName=$_POST['foodName'];
        $price=$_POST['price'];
        $orderQuantity=$_POST['orderQuantity'];
        $comment=$_POST['comment'];
        $employeeName=$_POST['employeeName'];
        $numTable=$_POST['table'];
        $category=$_POST['category'];

        if($category=="food")
        {
            $sql="UPDATE food SET food_quantity=food_quantity+1 WHERE food_name='{$foodName}'";
            $result=$db->query($sql);
        }
        else
        {
            $sql="UPDATE drinks SET drinks_quantity=drinks_quantity+1 WHERE drinks_name='{$foodName}'";
            $result=$db->query($sql);
        }
        
        $sql="INSERT INTO orders (order_item, order_price, order_quantity, order_comment, employee_id, section_id, order_category) VALUES ('{$foodName}', '{$price}', '{$orderQuantity}' , '{$comment}', $employeeName,  $numTable, '{$category}')";
        $result=$db->query($sql);

        if($db->error())
        {
            $output['error']="Грешка у систему."; 
            $output['data']="";  
        }
        else
        $output['data']="*";
    }

    //update order_active on 1 when the button "btn-save" is pressed 
    if(isset($_GET['print-bill']))
    { 
        $table=$_POST['numTable'];
        $sql="UPDATE orders SET order_active=1 WHERE section_id=$table";
        $result=$db->query($sql);

        if($db->error())
        {
            $output['error']="Грешка у систему."; 
            $output['data']="";  
        }
        else
        $output['data']="Рачун је одштампан.";
    }

////////////////////////////////////////////////////////////

    ////reservation.php

    if(isset($_GET['reservation']))
    {  
        $name=$db->escape_string($_POST['name']);
        $lastName=$db->escape_string($_POST['lastname']);
        $email=$db->escape_string($_POST['email']);
        $phone=$db->escape_string($_POST['phone']);
        $numCustomer=$db->escape_string($_POST['numcustomer']);
        $date=$db->escape_string($_POST['date']);
        $time=$db->escape_string($_POST['time']);
        $note=$db->escape_string($_POST['note']);

        $name=filter_var($name,FILTER_SANITIZE_STRING);
        $lastName=filter_var($lastName,FILTER_SANITIZE_STRING);
        $email=filter_var($email, FILTER_SANITIZE_EMAIL);
        $phone=filter_var($phone,FILTER_SANITIZE_STRING);
        $numCustomer=filter_var($numCustomer,FILTER_SANITIZE_NUMBER_INT);
        $note=filter_var($note,FILTER_SANITIZE_STRING);

        if($name!="" && $lastName!="" && $email!="" && $phone!="" && $numCustomer!="")
        {
            if(validationStr($name) AND validationStr($lastName) AND validationStr($email) AND validationStr($phone) AND validationStr($numCustomer)){
                $sql="INSERT INTO reservation (reservation_name, reservation_lastname, reservation_email, reservation_phone, reservation_num_customer, reservation_date, reservation_time, reservation_note) VALUES ('{$name}', '{$lastName}', '{$email}', '{$phone}', $numCustomer, '{$date}', '{$time}', '{$note}' )";
                $results=$db->query($sql);
                
                if($db->error())
                {
                    $output['error']="Грешка у систему. Молим вас пробајте касније."; 
                    $output['data']="";
                }
                else
                {
                    $output['data']="Резервација је сачувана, ускоро ће Вас контактирати неко из нашег ресторана.";
                    Statistics::writeNote("statistics/reservation.log", $name." ".$lastName." (".$email.") je успешно проследио резервацију.");
                }    
            }
            else
            {
                $output['error']="Неки од података садрже недозвољени карактер.";
                Statistics::writeNote("statistics/reservation.log", "Неки од података садрже недозвољени карактер. (".$name." ".$lastName." ".$email." ".$phone." ".$numCustomer.")");
            }
        }
        else
        {
            $output['error']="Сви подаци су обавезни.";
            Statistics::writeNote("statistics/reservation.log", "Корисник ".$email." Није унео све податке.");
        }    
    }

    //shows all reservations
    if(isset($_GET['all-reservation']))
    {
        $sql="SELECT * FROM reservation WHERE reservation_delete=0 ORDER BY reservation_date ASC";
        $results=$db->query($sql);

        $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
    }

    //confirm reservation
    if(isset($_GET['confirm']))
    { 
        $id=$_POST['nameid'];
        $empName=$_POST['empname'];
        $email=$_POST['email'];

        $sql="UPDATE reservation SET reservation_confirm=1 WHERE reservation_id=$id";
        $result=$db->query($sql);

        if($db->error())
        {
            $output['error']="Грешка у систему."; 
            $output['data']="";  
        }
        else
        $output['data']="Резервација је потврђена.";
        Statistics::writeNote("statistics/reservation.log", $empName." је потврдио/ла резервацију за госта са е-адресом (".$email.").");
    }

       //delete reservation
       if(isset($_GET['delete-reservation']))
       {
        $id=$_POST['id'];
        $empName=$_POST['empname'];
        $email=$_POST['email'];

        $sql="UPDATE reservation SET reservation_delete=1 WHERE reservation_id=$id";
        $result=$db->query($sql);

        if($db->error())
        {
            $output['error']="Грешка у систему."; 
            $output['data']="";  
        }
        else
        $output['data']="Резервација је обрисана.";
        Statistics::writeNote("statistics/reservation.log", $empName." је обрисао/ла резервацију госта са е-адресом (".$email.")");
    }


    //shows all food orders for the cook
    if(isset($_GET['cook']))
    {
        $sql="SELECT * FROM orders_view WHERE order_active=0 AND order_done=0 AND order_category='food' ORDER by order_time ASC";
        $results=$db->query($sql);

        $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
    }

    //update order_done on 1
    if(isset($_GET['cook-delete']))
    {
        $id=$_POST['id'];

        $sql="UPDATE orders SET order_done=1 WHERE order_id=$id";
        $result=$db->query($sql);

        if($db->error())
        {
            $output['error']="Грешка у систему."; 
            $output['data']="";  
        }
        else
        $output['data']="Поруџбина готова.";
        
    }

/*------------------------------
END tables.php and menu - query 
------------------------------- */

echo JSON_encode($output, 256);

?>