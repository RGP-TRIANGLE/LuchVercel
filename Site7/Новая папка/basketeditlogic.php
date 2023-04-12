<?php
try 
{
    include 'connect.php';
    
    //echo "Контекст установлен!<br>";

    //$db = new SQLite3("C:\Program Files\Ampps\www\Site2\database.db");

    if(isset($_POST['productName']) && ($_POST['editType'] == "plus"))
    {
        $productName = $_POST['productName'];
        $UserID = 0;
        
        $result = $db->query('SELECT * FROM Products WHERE product_name = "'.$productName.'"');

        $count = 0;

        foreach ($result as $row)
        {
            $count = $row['product_count'];
        }

        if($count > 0)
        {
            try 
            {

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
                    $db->query('UPDATE Products SET product_count = product_count - 1 WHERE product_name = "'.$productName.'"');
                } 
                catch (\Throwable $th) 
                {
                    echo 'Произошла ошибка: '.$th.'!!!)';
                }

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
            catch (\Throwable $th) 
            {
                echo '<script language="javascript">';
                echo 'alert("Произошла ошибка: '.$th.'!!!")';
                echo '</script>';
            }
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Продукция закончилась на складе.")';
            echo '</script>';
        }
    }
    else if(isset($_POST['productName']) && ($_POST['editType'] == "minus"))
    {
        try 
        {
            $productName = $_POST['productName'];
            $UserID = 0;

            try 
            {
                $db->query('UPDATE Products SET product_count = product_count + 1 WHERE product_name = "'.$productName.'"');
            } 
            catch (\Throwable $th) 
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

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
                $result = $db->query('SELECT product_count as count FROM Baskets WHERE product_name = "'.$productName.'"');
            }
            catch (\Throwable $th)
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = $row['count'];

            if($count < 1)
            {
                try
                {
                    $db->query('DELETE FROM Baskets WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');
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
                    $db->query('UPDATE Baskets SET product_count = product_count - 1 WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');
                    $db->query('UPDATE Baskets SET basket_sum = product_count * product_price WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');
                } 
                catch (\Throwable $th) 
                {
                    echo 'Произошла ошибка: '.$th.'!!!)';
                }
            }


        } 
        catch (\Throwable $th) 
        {
            echo '<script language="javascript">';
            echo 'alert("Произошла ошибка: '.$th.'!!!")';
            echo '</script>';
        }
    }
    else if(isset($_POST['productName']) && ($_POST['editType'] == "delete"))
    {
        try 
        {
            $productName = $_POST['productName'];
            $UserID = 0;

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

            //$result = $db->query('SELECT * FROM Baskets WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');

            $result = $db->query('SELECT * FROM Baskets WHERE user_id = '.$UserID.' AND product_name = "'.$productName.'"');

            $count = 0;

            //echo 'ID - '.$UserID.' Продукт - '.$productName.'<br>';
            
            foreach($result as $row)
            {
                $count = $row['product_count'];
            }

            //echo 'Определено кол-во - '.$count.'<br>';

            try 
            {
                // $statement = $db->prepare('SELECT * FROM table WHERE id = :id;');
                // $statement->bindValue(':id', $id);

                // $result = $statement->execute();

                $result = $db->query('UPDATE Products 
                SET product_count = product_count + '.$count.'
                WHERE product_name = "'.$productName.'"');
                //echo 'Сделан запрос на Update<br>';
            } 
            catch (\Throwable $th) 
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }
            
            try
            {
                $db->query('DELETE FROM Baskets WHERE product_name = "'.$productName.'" AND user_id = '.$UserID.'');
            } 
            catch (\Throwable $th) 
            {
                echo 'Произошла ошибка: '.$th.'!!!)';
            }

        } 
        catch (\Throwable $th) 
        {
            echo '<script language="javascript">';
            echo 'alert("Произошла ошибка: '.$th.'!!!")';
            echo '</script>';
        }
    }
    
    header("Location: http://localhost/Site7/Site7/Корзина.phtml");
    die();
}
catch 
(\Throwable $th) 
{
    echo '<script language="javascript">';
    echo 'alert("Произошла ошибка: '.$th.'!!!")';
    echo '</script>';
}

?>