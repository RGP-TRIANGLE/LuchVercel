<?php

    include 'connect.php';

    //echo "Контекст установлен!<br>";

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

    try 
    {
        $result = $db->query('SELECT COUNT(*) as count FROM Orders WHERE user_id = '.$UserID.'');
    }
    catch (\Throwable $th)
    {
        echo 'Произошла ошибка: '.$th.'!!!)';
    }

    $row = $result->fetch(PDO::FETCH_ASSOC);
    $count = $row['count'];

    if($count <= 0)
    {
        echo '
        <div class="u-clearfix u-sheet u-sheet-1">
            <p class="u-align-left u-text u-text-default u-text-2">У вас нет заказов.</p>
        </div>
        ';
    }
    else
    {
    
        $result= $db->query('SELECT * FROM Orders WHERE user_id = '.$UserID.'');

        foreach($result as $row) 
        {
            echo '
            <div class="u-border-2 u-border-grey-75 u-container-style u-group u-shape-rectangle u-group-1">
            <div class="u-container-layout u-container-layout-1">
            <h4 class="u-text u-text-default u-text-2">Заказ от '.$row['order_date'].'</h4>
            <div class="u-align-center u-container-style u-grey-50 u-group u-radius-30 u-shape-round u-group-2">
            <div class="u-container-layout">
                <p class="u-align-center u-text u-text-default u-text-3">'.$row['order_status'].'</p>
            </div>
            </div>
            <p class="u-text u-text-default u-text-4">Состав:<br>'.$row['order_composition'].'
            </p>
            <h4 class="u-text u-text-default u-text-5">Итого: '.$row['order_sum'].' руб.</h4>
            <p class="u-align-right u-text u-text-6">'.$row['order_info'].'
            </p>
            </div>
            </div>
            ';
        }
}
?>