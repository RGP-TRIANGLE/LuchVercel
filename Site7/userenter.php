<?php

include 'connect.php';

try 
{
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        //echo "Условия выполнены!<br>";

        try 
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            //echo "Переменные инициализированы!<br>";

            $db->query('UPDATE Users SET user_logged = "true" WHERE user_password = "'.$password.'"');
            
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