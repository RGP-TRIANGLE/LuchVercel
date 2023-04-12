<?php

    include 'connect.php';

    //echo "Контекст установлен!<br>";

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
        $result = $db->query('SELECT COUNT(*) as count FROM Baskets WHERE user_id = '.$UserID.'');
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
        <section class="u-clearfix u-section-1" id="sec-c039">
        <div class="u-clearfix u-sheet u-sheet-1">
            <h3 class="u-align-left u-text u-text-default u-text-1">Моя корзина</h3>
            <p class="u-align-left u-text u-text-default u-text-2">Ваша корзина пуста.</p>
        </div>

        </section>
        ';
    }
    else
    {
        echo '
        <section class="u-clearfix u-section-1" id="sec-c039">
        <div class="u-clearfix u-sheet u-sheet-1">
            <h3 class="u-align-left u-text u-text-default u-text-1">Моя корзина</h3>';

        
            $result= $db->query('SELECT * FROM Baskets WHERE user_id = '.$UserID.'');

            $totalSum = 0;
            $orderComposition = "";

            foreach($result as $row) 
            {
                $orderComposition = $orderComposition.$row['product_name']." - ".$row['product_count']." шт./".$row['product_price']." руб. - ".$row['basket_sum']." руб.<br>";
                $totalSum = $totalSum + $row['basket_sum'];
            }

            $today = date("d.m.y");

            $result= $db->query('SELECT * FROM Baskets WHERE user_id = '.$UserID.'');

            foreach($result as $row) 
            {

                $result2 = $db->query('SELECT * FROM Products WHERE product_name = "'.$row['product_name'].'"');

                foreach($result2 as $row2) 
                {
                    echo '
                    <div class="u-clearfix u-layout-wrap u-layout-wrap-1" >
                        <div class="u-layout">
                            <div class="u-layout-row">
                            <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1">
                                <div class="u-container-layout u-container-layout-1">
                                <div class="u-border-2 u-border-grey-75 u-container-style u-expanded-width u-group u-shape-rectangle u-group-1">
                                    <div class="u-container-layout u-container-layout-2">


                                    <form action="basketeditlogic.php" method="post">
                                        <button type="submit" name="Plus" class="u-border-2 u-border-grey-75 u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">+</button>
                                        <input type="hidden" name="productName" value="'.$row['product_name'].'"/>
                                        <input type="hidden" name="editType" value="plus"/>
                                    </form>
                                    
                                    
                                    <img class="u-image u-image-1" src="'.$row2['product_photo'].'" data-image-width="1024" data-image-height="692">
                                    <h4 class="u-text u-text-3" style="white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;">'.$row['product_name'].'</h4>

                                    <form action="basketeditlogic.php" method="post">
                                        <input type="hidden" name="productName" value="'.$row['product_name'].'"/>
                                        <input type="hidden" name="editType" value="delete"/>
                                        <button type="submit" name="Delete" class="u-active-grey-90 u-border-2 u-border-grey-75 u-btn u-button-style u-grey-40 u-hover-grey-60 u-btn-2">Удалить</button>
                                    </form>
                                    
                                    <p class="u-text u-text-default u-text-4">Кол-во: '.$row['product_count'].'&nbsp; &nbsp; &nbsp;Цена: '.$row['product_price'].' руб.&nbsp; &nbsp; Сумма: '.$row['basket_sum'].' руб.</p>
                                    
                                    <form action="basketeditlogic.php" method="post" style="width: 100pt; float: right;">
                                        <input type="hidden" name="productName" value="'.$row['product_name'].'"/>
                                        <input type="hidden" name="editType" value="minus"/>
                                        <button type="submit" name="Minus" class="u-border-2 u-border-grey-75 u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-3">-</button>
                                    </form>
                                    
                                    
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }

        echo '
        <h4 class="u-text u-text-default u-text-5">Итого: '.$totalSum.' руб.</h4>

                <form action="addorder.php" method="post" style="width: 100pt;">
                    <input type="hidden" name="userID" value="'.$UserID.'" />
                    <input type="hidden" name="orderSum" value="'.$totalSum.'" />
                    <input type="hidden" name="orderDate" value="'.$today.'" />
                    <input type="hidden" name="orderStatus" value="В обработке" />
                    <input type="hidden" name="orderInfo" value="Ваш заказ обрабатывается. Пожалуйста, подождите..." />
                    <input type="hidden" name="orderComposition" value="'.$orderComposition.'" />

                    <button type="submit" class="u-active-custom-color-13 u-border-2 u-border-grey-75 u-btn u-btn-round u-button-style u-custom-color-1 u-hover-custom-color-12 u-btn-4">Оформить и оплатить</button>
                </form>
            
                <p class="u-text u-text-default u-text-6">Более подробную информацию можно узнать по номеру телефона:&nbsp;+78434247322.<br>
                </p>
        </div>

        </section>
        ';
    }
?>