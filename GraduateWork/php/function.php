<?php
function validationStr($str)
{
    if(strpos($str, "=")!==false) return false;
    if(strpos($str, "(")!==false) return false;
    if(strpos($str, ")")!==false) return false;
    if(strpos($str, "/")!==false) return false;
    if(strpos($str, "|")!==false) return false;
    if(strpos($str, ";")!==false) return false;
    if(strpos($str, ",")!==false) return false;
    if(strpos($str, "<")!==false) return false;
    if(strpos($str, ">")!==false) return false;
    if(strpos($str, "!")!==false) return false;
    if(strpos($str, "$")!==false) return false;
    return true;
}

function login(){
    if(isset($_SESSION['employee_id']) AND isset($_SESSION['employee_name']) AND isset($_SESSION['employee_status'])){
        return true;
    }
    else if(isset($_COOKIE['id']) and isset($_COOKIE['name']) and isset($_COOKIE['status'])){
        $_SESSION['employee_id']=$_COOKIE['id'];
        $_SESSION['employee_name']=$_COOKIE['name'];
        $_SESSION['employee_status']=$_COOKIE['status'];
        return true;
    }
    return false;
}

function createSession($id, $name, $lastname, $email, $status, $remember)
{
    $_SESSION['employee_id']=$id;
    $_SESSION['employee_name']="$name $lastname";
    $_SESSION['employee_email']=$email;
    $_SESSION['employee_status']=$status;

    if($remember=="1")
    {
        setcookie("id", $id, time()+86400, "/");
        setcookie("name", "$name $lastname", time()+86400, "/");
        setcookie("email", $email, time()+86400, "/");
        setcookie("status", $status, time()+86400, "/");
    }
}

function destroySession()
{
    session_unset();
    session_destroy();
    setcookie("id", "", time()-1,"/");
    setcookie("name", "", time()-1,"/");
    setcookie("email", "", time()-1,"/");
    setcookie("status", "", time()-1,"/");
    header("location: tables.php");
}
?>
