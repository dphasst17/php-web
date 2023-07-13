<?php
function CheckLogin($email,$pass)
{ 
    $DBH=connect(); 
    $query="SELECT * FROM users WHERE email='$email' OR idUser='$email' AND password = '$pass' AND roleUser != 2";
    $STH = $DBH->query($query);
    $rows_affected = $STH->rowCount();  
    if ($rows_affected == 0)
    {
        return false;
    }
    return true;
}

?>