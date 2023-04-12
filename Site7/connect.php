<?php

try
{
   //echo "Подключение к БД! <br>";

   $db = new PDO('sqlite:database.db');

   //echo "Путь установлен! <br>";
   
   $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (\PDOException $e) 
{
   echo "Ошибка при подключении к БД: ".$e->getMessage()."<br>"; // выводим сообщение 
}

$profile_page_reason = "enter";

?>