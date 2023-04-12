<?php
try 
{
    include 'connect.php';
    
    //echo "Контекст установлен!<br>";

    //$db = new SQLite3("C:\Program Files\Ampps\www\Site2\database.db");

    if(isset($_POST['userID']) && isset($_POST['orderSum']))
    {
        //echo "Условия выполнены!<br>";

        try 
        {
            $UserID = $_POST['userID'];
            $orderSum = $_POST['orderSum'];
            $orderDate = $_POST['orderDate'];
            $orderStatus = $_POST['orderStatus'];
            $orderInfo = $_POST['orderInfo'];
            $orderComposition = $_POST['orderComposition'];

            try 
            {
                $db->query('INSERT INTO Orders (order_composition, order_date, order_sum, order_status, order_info, user_id) VALUES ("'.$orderComposition.'","'.$orderDate.'",'.$orderSum.',"'.$orderStatus.'","'.$orderInfo.'",'.$UserID.')');
            } 
            catch (\Throwable $th) 
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

            try
            {
                $db->query('DELETE FROM Baskets WHERE user_id = '.$UserID.'');
            } 
            catch (\Throwable $th) 
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

            echo '<script language="javascript">';
            echo 'alert("Продукция успешно добавлена!")';
            echo '</script>';

            header("Location: http://localhost/Site7/Site7/payfiles/Cloudpayments.html");
            die();
            // Code
            // if (file_exists($image_filename_cleaned)) 
            // {
            //     echo "Вхождение в блок IF<br>";

            //     $query = $db->prepare('UPDATE Products SET product_photo=? WHERE product_name="'.$productName.'"');
            //     $image=file_get_contents($image_filename_cleaned);
            //     $query->bindValue(1, $image, SQLITE3_BLOB);
            //     $run=$query->execute();

            //     echo "Запрос UPDATE выполен!<br>";
            // }
            // else{
            //     echo "Файла не существует!<br>";
            // }
            

            //echo "Готово!<br>";
        }
        catch (Throwable $th)
        {
            echo '<script language="javascript">';
            echo 'alert("Произошла ошибка: '.$th.'!!!")';
            echo '</script>';
        }
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Вы заполнили не все поля!")';
        echo '</script>';
    }
}
catch (Throwable $th) 
{
    echo $th;
}

?>