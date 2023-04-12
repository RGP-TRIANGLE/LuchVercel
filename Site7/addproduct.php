<?php
try 
{
    include 'connect.php';
    
    //echo "Контекст установлен!<br>";

    //$db = new SQLite3("C:\Program Files\Ampps\www\Site2\database.db");

    if(isset($_POST['productType']) && isset($_POST['productName']) && isset($_POST['productPrice'])  && isset($_POST['productInfo']))
    {
        //echo "Условия выполнены!<br>";

        try 
        {
            $productType = $_POST['productType'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productInfo = $_POST['productInfo'];
            $productCount = $_POST['productCount'];
            
            if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
            {
                $name = $_FILES["filename"]["name"];
                move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
                //echo "Файл загружен";
            
                $photoPath = $_FILES["filename"]["name"];
            }

            //echo "Переменные инициализированы!<br>";

            try 
            {
                $db->query('INSERT INTO Products (product_name,product_price,product_info,product_type, product_photo, product_count) VALUES ("'.$productName.'",'.$productPrice.',"'.$productInfo.'","'.$productType.'","'.$photoPath.'",'.$productCount.')');
            } 
            catch (\Throwable $th) 
            {
                echo '<script language="javascript">';
                echo 'alert("Произошла ошибка: '.$th.'!!!")';
                echo '</script>';
            }

            
            
            echo '<script language="javascript">';
            echo 'alert("Продукция успешно добавлена!")';
            echo '</script>';

            header("Location: http://localhost/Site7/Site7/Администрирование.phtml");
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