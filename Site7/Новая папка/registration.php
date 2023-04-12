<?php

include 'connect.php';

try 
{
    if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['address'])  && isset($_POST['email']))
    {
        //echo "Условия выполнены!<br>";

        try 
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            
            //echo "Переменные инициализированы!<br>";

            $db->query('INSERT INTO Users (user_name,user_email,user_phone,user_address, user_admin, user_logged, user_password) VALUES ("'.$name.'","'.$email.'","'.$phone.'","'.$address.'","false","true","'.$password.'")');
            
            header("Location: http://localhost/Site7/Site7/Профиль.phtml");
            die();
            //header("Refresh:0");
            //echo "Готово!<br>";
        }
        catch (Throwable $th)
        {
            echo "Произошлая ошибка:\n".$th."<br>";
        }
    }
} 
catch (\Throwable $th) 
{
    echo "Произошлая ошибка:\n".$th."<br>";
}

?>