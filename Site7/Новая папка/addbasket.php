<?php
try 
{
    include 'connect.php';
    
    //echo "Контекст установлен!<br>";

    //$db = new SQLite3("C:\Program Files\Ampps\www\Site2\database.db");

    if(isset($_POST['productName']) && isset($_POST['productPrice']))
    {
        //echo "Условия выполнены!<br>";

        try 
        {
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productCount = 1;
            $UserID = 0;

            try 
            {
                $db->query('UPDATE Products SET product_count = product_count - 1 WHERE product_name = "'.$productName.'"');
            } 
            catch (\Throwable $th) 
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }


            //$result = $db->query('SELECT product FROM Products WHERE product_name = "'.$productName.'"');


            try 
            {
                $result = $db->query('SELECT * FROM Users WHERE user_logged = "true"');
            }
            catch (\Throwable $th)
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

            foreach($result as $row) 
            {
                $UserID = $row['user_id'];
            }

            
            try 
            {
                $result = $db->query('SELECT COUNT(*) as count FROM Baskets WHERE product_name = "'.$productName.'"');
            }
            catch (\Throwable $th)
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = $row['count'];

            if($count <= 0)
            {
                try 
                {
                    $db->query('INSERT INTO Baskets (user_id, product_name, product_price, product_count, basket_sum) VALUES ('.$UserID.',"'.$productName.'",'.$productPrice.','.$productCount.','.$productCount*$productPrice.')');
                } 
                catch (\Throwable $th) 
                {
                    echo 'Произошла ошибка: '.$th.'!!!)';
                }
            }
            else
            {
                try 
                {
                    $db->query('UPDATE Baskets SET product_count = product_count + 1 WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');
                    $db->query('UPDATE Baskets SET basket_sum = product_count * product_price WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');
                } 
                catch (\Throwable $th) 
                {
                    echo 'Произошла ошибка: '.$th.'!!!)';
                }
            }

            
            
            echo '<script language="javascript">';
            echo 'alert("Продукция успешно добавлена!")';
            echo '</script>';

            $Type = $_POST['productType'];

            switch($Type)
            {
                case "Бакалея": 
                    header("Location: http://localhost/Site7/Site7/Бакалея.phtml");
                    die();
                    break;
                case "Молочная продукция": 
                    header("Location: http://localhost/Site7/Site7/МолочнаяПродукция.phtml");
                    die();
                    break;
                case "Сырая продукция": 
                    header("Location: http://localhost/Site7/Site7/СыраяПродукция.phtml");
                    die();
                    break;
                case "Комбикорм": 
                    header("Location: http://localhost/Site7/Site7/Комбикорм.phtml");
                    die();
                    break;
                case "С/Х животные и птица": 
                    header("Location: http://localhost/Site7/Site7/Животные.phtml");
                    die();
                    break;
            }
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