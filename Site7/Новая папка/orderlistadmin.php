<?php
    include 'connect.php';

    $result= $db->query('SELECT * FROM Orders WHERE order_visible = "true"');

    foreach($result as $row)
    {
        $result2 = $db->query('SELECT * FROM Users WHERE user_id = '.$row['user_id'].'');

        foreach($result2 as $row2)
        {
            echo '
            <div>
                <input id="ac-'.$row['order_id'].'" name="accordion-1" type="checkbox"/>
                <label for="ac-'.$row['order_id'].'">Заказ от '.$row['order_date'].' / ('.$row['order_status'].')
                </label>
                <article>
                <section style="margin: 10pt;">
                    <div class="bblock" style="width: 300pt;">
                        <h5>Заказ от '.$row['order_date'].'</h5>
                        <p >Клиент:<br>'.$row2['user_name'].'.<br>
                        '.$row2['user_address'].'<br>
                        '.$row2['user_phone'].' / '.$row2['user_email'].'</p>

                        <h5>Состав заказа:</h5>
                        <p>'.$row['order_composition'].'</p>
                        <h5>Итого: '.$row['order_sum'].' руб.</h5>
                    </div>
            
                    <div class="bblock">
                        <h5>Статус:</h5>
                        <form action="orderedit.php" method="post">
                            <input type="hidden" name="editType" value="saveStatus"/>
                            <input type="hidden" name="orderID" value="'.$row['order_id'].'"/>
                            <select name="orderStatus">';

                            $status = $row['order_status'];

                            switch($status)
                            {
                                case "В обработке": 
                                    echo '<option selected>В обработке</option>
                                    <option>Выполняется</option>
                                    <option>Готово</option>
                                    <option>Получено</option>
                                    <option>Отменен</option>';
                                    break;
                                case "Выполняется": 
                                    echo '<option>В обработке</option>
                                    <option selected>Выполняется</option>
                                    <option>Готово</option>
                                    <option>Получено</option>
                                    <option>Отменен</option>';
                                    break;
                                case "Готово": 
                                    echo '<option>В обработке</option>
                                    <option>Выполняется</option>
                                    <option selected>Готово</option>
                                    <option>Получено</option>
                                    <option>Отменен</option>';
                                    break;
                                case "Получено": 
                                    echo '<option>В обработке</option>
                                    <option>Выполняется</option>
                                    <option>Готово</option>
                                    <option selected>Получено</option>
                                    <option>Отменен</option>';
                                break;
                                case "Отменен": 
                                    echo '<option>В обработке</option>
                                    <option>Выполняется</option>
                                    <option>Готово</option>
                                    <option>Получено</option>
                                    <option selected>Отменен</option>';
                                break;
                            }
                                
                            echo '</select>
                            <button type="submit">Применить</button>
                        </form>
                    </div>
            
                    <div class="bblock">
                        <h5>Комментарий к заказу:</h5>
                        <form action="orderedit.php" method="post">
                            <input type="hidden" name="editType" value="saveInfo"/>
                            <input type="hidden" name="orderID" value="'.$row['order_id'].'"/>
                            <textarea name="orderInfo" cols="24" rows="4" style="max-width: 200pt; max-height: 200pt;">'.$row['order_info'].'</textarea>
                            <button type="submit">Сохранить изменения</button>
                        </form>
                    </div>
            
                    <div class="bblock">
                        <h5>Действие:</h5>

                        <form action="orderedit.php" method="post">
                            <input type="hidden" name="editType" value="hide"/>
                            <input type="hidden" name="orderID" value="'.$row['order_id'].'"/>
                            <button type="submit">Скрыть заказ</button>
                        </form>

                        <form action="orderedit.php" method="post">
                            <input type="hidden" name="editType" value="delete"/>
                            <input type="hidden" name="orderID" value="'.$row['order_id'].'"/>
                            <button type="submit">Удалить</button>
                        </form>
                    </div>
                </section>
                </article>
            </div>
        ';
        }
    }
?>