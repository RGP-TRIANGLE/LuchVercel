<?php
    include 'connect.php';

    if(isset($_POST['orderID']) && ($_POST['editType'] == "saveStatus"))
    {
        $orderID = $_POST['orderID'];
        $orderStatus = $_POST['orderStatus'];

        try 
        {
            $result= $db->query('UPDATE Orders SET order_status = "'.$orderStatus.'" WHERE order_id = '.$orderID.'');
        } 
        catch (\Throwable $th) 
        {
            echo 'Ошибка: '.$th;
        }
    }
    else if(isset($_POST['orderID']) && ($_POST['editType'] == "saveInfo"))
    {
        $orderID = $_POST['orderID'];
        $orderInfo = $_POST['orderInfo'];

        try 
        {
            $result= $db->query('UPDATE Orders SET order_info = "'.$orderInfo.'" WHERE order_id = '.$orderID.'');
        } 
        catch (\Throwable $th) 
        {
            echo 'Ошибка: '.$th;
        }
    }
    else if(isset($_POST['orderID']) && ($_POST['editType'] == "delete"))
    {
        $orderID = $_POST['orderID'];

        try 
        {
            $result= $db->query('DELETE FROM Orders WHERE order_id = '.$orderID.'');
        } 
        catch (\Throwable $th) 
        {
            echo 'Ошибка: '.$th;
        }
    }
    else if(isset($_POST['orderID']) && ($_POST['editType'] == "hide"))
    {
        $orderID = $_POST['orderID'];

        try 
        {
            $result= $db->query('UPDATE Orders SET order_visible = "false" WHERE order_id = '.$orderID.'');
        } 
        catch (\Throwable $th) 
        {
            echo 'Ошибка: '.$th;
        }
    }

    header("Location: http://localhost/Site7/Site7/Администрирование.phtml");
    die();

?>