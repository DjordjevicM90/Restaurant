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

/*------------------------------
administrator.php - query 
------------------------------- */

//shows all employee users from base
if(isset($_GET['select-employee'])){ 
    $sql="SELECT * FROM employee_users";
    $results=$db->query($sql);
    
    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC); 
}

//insert new employee user in table employee_users
if(isset($_GET['insert-employee'])){
    $name=$db->escape_string($_POST['name']);
    $lastName=$db->escape_string($_POST['lastName']); 
    $email=$db->escape_string($_POST['email']);
    $password=$db->escape_string($_POST['password']);
    $phone=$db->escape_string($_POST['phone']);
    $status=$db->escape_string($_POST['status']);

    $salt="GrJXCV3p44Vlo";

    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    $password=filter_var($password,FILTER_SANITIZE_STRING);
    $phone=filter_var($phone,FILTER_SANITIZE_STRING);

    if($name!="" AND $lastName!="" AND $email!="" AND $password!="" AND $phone!="" AND $status!=""){
        if(validationStr($name) AND validationStr($lastName) AND validationStr($email) AND validationStr($password) AND validationStr($phone) AND validationStr($status)){
            
            $password=$password.$salt;
            $password=password_hash($password, PASSWORD_BCRYPT);

            $sql="INSERT INTO employee_users (employee_name, employee_lastname, employee_email, employee_password, employee_phone, employee_status) VALUES ('{$name}', '{$lastName}', '{$email}', '{$password}', '{$phone}', '{$status}')";
            $result=$db->query($sql);
    
            if($db->error()){
                $output['error']="Грешка у систему";
                $output['data']="";
                
            }
            else
            $output['data']="Успешно додат корисник.";
            Statistics::writeNote("statistics/employee_admin.log", " Успешно додат корисник. (".$name." ".$lastName.").");
        }
        else{
            $output['error']="Неки од података садрже недозвољени карактер.";
            $output['data']="";
        }
    }
    else{
        $output['error']="Сви подаци су обавеѕни.";
        $output['data']="";
    }

    
}

//update employee user in table employee_users
if(isset($_GET['update-employee'])){
    $id=$_POST['id'];
    $name=$db->escape_string($_POST['name']);
    $lastName=$db->escape_string($_POST['lastName']);
    $email=$db->escape_string($_POST['email']);
    $password=$db->escape_string($_POST['password']);
    $phone=$db->escape_string($_POST['phone']);
    $status=$db->escape_string($_POST['status']);

    $salt="GrJXCV3p44Vlo";

    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    $password=filter_var($password,FILTER_SANITIZE_STRING);
    $phone=filter_var($phone,FILTER_SANITIZE_STRING);

    if($name!="" AND $lastName!="" AND $email!="" AND $password!="" AND $phone!="" AND $status!=""){
        if(validationStr($name) AND validationStr($lastName) AND validationStr($email) AND validationStr($password) AND validationStr($phone) AND validationStr($status)){

            $password=$password.$salt;
            $password=password_hash($password, PASSWORD_BCRYPT);

            $sql="UPDATE employee_users SET employee_name='{$name}', employee_lastname='{$lastName}', employee_email='{$email}', employee_password='{$password}', employee_phone='{$phone}', employee_status='{$status}' WHERE employee_id=$id";
            $result=$db->query($sql);
        
            if($db->error()){
                $output['error']="Грешка у систему";
                $output['data']="";
            }
            else
            $output['data']="Успешно измењен корисник.";
            Statistics::writeNote("statistics/employee_admin.log", "Успешно измењен корисник. (".$name." ".$lastName.").");
        }
        else{
            $output['error']="Неки од података садрже недозвољени карактер.";
            $output['data']="";
        }
    }
    else{
        $output['error']="Сви подаци су обавеѕни.";
        $output['data']="";
    }

}

//delete employee user in table employee_users
if(isset($_GET['delete-employee'])){
    $id=$_POST['id'];

    $sql="DELETE FROM employee_users WHERE employee_id=$id";
    $result=$db->query($sql);

    if($db->error()){
        $output['error']="Грешка у систему";
        $output['data']="";
    }
    else
    $output['data']="Успешно обрисан корисник.";
}

//shows all images in div all-images
if(isset($_GET['selectAll-images'])){
    $sql="SELECT * FROM gallery";
    $results=$db->query($sql);

    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
}

//add images in table gallery
if(isset($_GET['add-image'])){
    $id=$db->insert_id();
    $images=$_FILES['image']['name'];
    $temp=$_FILES['image']['tmp_name'];
    
    if($images!=""){
        $nameImg=microtime(true);
        $destination="images/".$nameImg;
        $img=getimagesize($temp);

        if($img)
        {
            if(@move_uploaded_file($temp, $destination))
            {
                $sql="INSERT INTO gallery (gallery_id, gallery_name) VALUES ($id, '{$nameImg}')";
                $db->query($sql);
                $output['data']="Успешао додата слика.";     
            }  
        }
        else
        $output['error']="Недозвољена датотека.";
    }
    else
    $output['error']="Нисте одабрали слику.";
    
}

//delete images
if(isset($_GET['delete-image'])){
    $deleteImg=$_POST['imgForDelete'];
    $nameImg=$_POST['nameImg'];

    if($deleteImg!=""){
        $sql="DELETE FROM gallery WHERE gallery_id=$deleteImg";
        $result=$db->query($sql);

        if($db->error()){
            $output['error']="Грешка у систему";
            $output['data']="";
        }
        else
        unlink("images/".$nameImg);
        $output['data']="Успешно обрисана/е слика/е.";
    }
    else
    $output['error']="Нисте одабрали слику за брисање.";
    
}

//insert new item in table food or drunks
if(isset($_GET['insert-item'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $categoryType=$_POST['categoryType'];
 
    $name=filter_var($name,FILTER_SANITIZE_STRING);
    $price=filter_var($price,FILTER_SANITIZE_STRING);


    if($name!="" AND $price!="" AND $category!="0"){
        if(validationStr($name) AND validationStr($price)){
            if($categoryType=="food"){
                $sql="INSERT INTO food (food_name, food_price, food_category_id) VALUES ('{$name}', '{$price}', '{$category}')";
                $result=$db->query($sql);
        
                if($db->error()){
                    $output['error']="Грешка у систему";
                    $output['data']="";
                    
                }
                else
                $output['data']="Успешно додат артикал.";
                Statistics::writeNote("statistics/employee_admin.log", " Успешно додат артикал. (".$name." ".$price.").");
            }
            else{
                $sql="INSERT INTO drinks (drinks_name, drinks_price, drinks_category_id) VALUES ('{$name}', '{$price}', '{$category}')";
                $result=$db->query($sql);
        
                if($db->error()){
                    $output['error']="Грешка у систему";
                    $output['data']="";
                    
                }
                else
                $output['data']="Успешно додат артикал.";
                Statistics::writeNote("statistics/employee_admin.log", " Успешно додат артикал. (".$name." ".$price.").");
            }
            
        }
        else{
            $output['error']="Неки од података садрже недозвољени карактер.";
            $output['data']="";
        }
    }
    else{
        $output['error']="Сви подаци су обавеѕни.";
        $output['data']="";
    }  
}

//update item in table food or drunks
if(isset($_GET['update-item'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $categoryType=$_POST['categoryType'];

    $name=filter_var($name,FILTER_SANITIZE_STRING);
    $price=filter_var($price,FILTER_SANITIZE_STRING);

    if($name!="" AND $price!="" AND $category!="0"){
        if(validationStr($name) AND validationStr($price)){
            if($categoryType=="food"){
                $sql="UPDATE food SET food_name='{$name}', food_price='{$price}', food_category_id='{$category}'WHERE food_id=$id";
                $result=$db->query($sql);
            
                if($db->error()){
                    $output['error']="Грешка у систему";
                    $output['data']="";
                }
                else
                $output['data']="Успешно измењен арикал.";
                Statistics::writeNote("statistics/employee_admin.log", "Успешно измењен арикал. (".$name." ".$price.").");
            }
            else{
                $sql="UPDATE drinks SET drinks_name='{$name}', drinks_price='{$price}', drinks_category_id='{$category}'WHERE drinks_id=$id";
                $result=$db->query($sql);
            
                if($db->error()){
                    $output['error']="Грешка у систему";
                    $output['data']="";
                }
                else
                $output['data']="Успешно измењен арикал.";
                Statistics::writeNote("statistics/employee_admin.log", "Успешно измењен арикал. (".$name." ".$price.").");
            }
            
        }
        else{
            $output['error']="Неки од података садрже недозвољени карактер.";
            $output['data']="";
        }
    }
    else{
        $output['error']="Сви подаци су обавеѕни.";
        $output['data']="";
    }

}

//delete food or drink in tables food or drinks
if(isset($_GET['delete-item'])){
    $id=$_POST['id'];
    $categoryType=$_POST['categoryType'];

    if($categoryType=="food"){
        $sql="DELETE FROM food WHERE food_id=$id";
        $result=$db->query($sql);

        if($db->error()){
            $output['error']="Грешка у систему";
            $output['data']="";
        }
        else
        $output['data']="Успешно обрисан арикал.";
    }
    else{
        $sql="DELETE FROM drinks WHERE drinks_id=$id";
        $result=$db->query($sql);

        if($db->error()){
            $output['error']="Грешка у систему";
            $output['data']="";
        }
        else
        $output['data']="Успешно обрисан арикал.";
    }
    
}

//shows all orders for overview-orders
if(isset($_GET['all-orders'])){
    $sql="SELECT * FROM orders_view WHERE order_active=1 ORDER BY section_id ASC";
    $results=$db->query($sql);

    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC); 
}

//shows all orders admin tables
if(isset($_GET['order-tables-admin'])){
    $tableNum=$_POST['numTable'];
    $sql="SELECT * FROM orders_view WHERE section_id='{$tableNum}' AND order_active=1";
    $results=$db->query($sql);

    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
}

//shows all food from order by food_quantity DESC, for overview-orders by food 
if(isset($_GET['food-admin'])){
    $sql="SELECT * FROM food  ORDER BY food_quantity DESC";
    $results=$db->query($sql);

    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC); 
}

//shows all drinks from order by drinks_quantity DESC, for overview-orders by drinks
if(isset($_GET['drinks-admin'])){
    $sql="SELECT * FROM drinks  ORDER BY drinks_quantity DESC";
    $results=$db->query($sql);

    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC); 
}


//shows all reservation
if(isset($_GET['admin-reservation'])){
    $sql="SELECT * FROM reservation WHERE reservation_delete=1  ORDER BY reservation_date DESC";
    $results=$db->query($sql);

    $output['data']=mysqli_fetch_all($results, MYSQLI_ASSOC);
}

/*------------------------------
end of administrator.php - query 
------------------------------- */

echo JSON_encode($output, 256);
?>