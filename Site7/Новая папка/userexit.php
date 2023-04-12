<?php

include 'connect.php';

try 
{
    $result = $db->query('UPDATE Users SET user_logged = "false"');

    header("Location: http://localhost/Site7/Site7/Профиль.phtml");
    die();
    //header("Refresh:0");
} 
catch (\Throwable $th) 
{
    echo "Произошлая ошибка:\n".$th."<br>";
}

?>