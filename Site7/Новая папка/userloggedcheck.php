<?php

include 'connect.php';

//echo "Контекст установлен!<br>";

try 
{
    //$count = $db->query('SELECT COUNT(*) as count FROM Users WHERE user_logged = "true"');

    $result = $db->query('SELECT COUNT(*) as count FROM Users WHERE user_logged = "true"');
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $count = $row['count'];

    //echo "Запрос выполнен!<br>";

if ($count > 0)
{
    //echo "Вхождение в цикл<br>";

    $result = $db->query('SELECT * FROM Users WHERE user_logged = "true"');

        foreach ($result as $row)
        {
            if($row['user_admin'] == "true")
            {
              echo '
              <section class="u-clearfix u-section-4" id="carousel_9732">
              <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
              <h3 class="u-text u-text-default u-text-1">' . $row['user_name'] . '<br>
              </h3>
              <p class="u-text u-text-default u-text-2">Электронная почта: ' . $row['user_email'] . '<br>Телефон: ' . $row['user_phone'] . '<br>Адрес: ' . $row['user_address'] . '
              </p>
              <div class="u-clearfix u-group-elements u-group-elements-1">
              <a href="Корзина.phtml" class="u-active-custom-color-10 u-border-2 u-border-grey-75 u-btn u-button-style u-custom-color-4 u-hover-custom-color-9 u-btn-1">Моя корзина</a>
              <a href="Заказы.phtml" class="u-active-custom-color-5 u-border-2 u-border-grey-75 u-btn u-button-style u-custom-color-1 u-hover-custom-color-12 u-btn-2">мои заказы</a>
              <a href="Администрирование.phtml" class="u-active-custom-color-2 u-border-2 u-border-grey-75 u-btn u-button-style u-grey-90 u-hover-grey-50 u-btn-4">Администрирование<br>
              </a>
              <br>
              <br>
              <form action="userexit.php" method="post">
  
                    <button type="submit" class="u-active-grey-90 u-border-2 u-border-grey-75 u-btn u-button-style u-grey-25 u-hover-grey-40 u-btn-2">Выйти из аккаунта</button>
                  
              </form>
              </div>
              </div>
              </section>
              ';
            }
            else
            {
              echo '
              <section class="u-clearfix u-section-4" id="carousel_9732">
              <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
              <h3 class="u-text u-text-default u-text-1">' . $row['user_name'] . '<br>
              </h3>
              <p class="u-text u-text-default u-text-2">Электронная почта: ' . $row['user_email'] . '<br>Телефон: ' . $row['user_phone'] . '<br>Адрес: ' . $row['user_address'] . '
              </p>
              <div class="u-clearfix u-group-elements u-group-elements-1">
              <a href="Корзина.phtml" class="u-active-custom-color-10 u-border-2 u-border-grey-75 u-btn u-button-style u-custom-color-4 u-hover-custom-color-9 u-btn-1">Моя корзина</a>
              <a href="Заказы.phtml" class="u-active-custom-color-5 u-border-2 u-border-grey-75 u-btn u-button-style u-custom-color-1 u-hover-custom-color-12 u-btn-2">мои заказы</a>
              <br>
              <br>
              <form action="userexit.php" method="post">
  
                    <button type="submit" class="u-active-grey-90 u-border-2 u-border-grey-75 u-btn u-button-style u-grey-25 u-hover-grey-40 u-btn-2"">Выйти из аккаунта</button>
                  
              </form>
              </div>
              </div>
              </section>
              ';
            }
        }
}
else
    {
        echo '
        <section class="u-align-center u-clearfix current-section u-block-0782-1" custom-posts-hash="T" data-style="Form-Basic-heading" id="carousel_1501" data-source="Sketch" style="">
        <div class="u-clearfix u-sheet u-block-0782-2" style="min-height: 459px;" data-block-type="Sheet">
        <h2 class="u-text u-text-default u-block-control u-block-0782-15" style="font-weight: 700; margin-top: 62px; margin-left: auto; margin-right: auto; margin-bottom: 0" data-block="27" data-block-type="Text">Авторизация</h2>
        <div class="u-form u-block-control u-block-0782-16" style="width: 570px; margin: 29px auto 0px;" data-block="28" data-block-type="Form">

      <form action="userenter.php" method="post" style="padding: 10px" name="form">
        
        <div class="u-form-email u-form-group u-block-control ui-draggable ui-draggable-handle u-label-none u-block-0782-20" style="" data-block="30" data-block-type="FormField">
          <label for="email-3b9a" class="u-label u-block-0782-21" style="">Email</label>
          <input type="email" placeholder="Электронная почта" id="email-3b9a" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-block-0782-22" required="" style="">
        </div>
        
        <div class="u-form-address u-form-group u-block-control ui-draggable ui-draggable-handle u-label-none u-block-0782-31" style="margin-left: 0" data-block="32" data-block-type="FormField">
          <label for="address-aaa7" class="u-label u-block-0782-32" style="">Адрес</label>
          <input type="text" placeholder="Пароль" id="address-aaa7" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-block-0782-33" required="" style="" data-block-type="FormChild">
        </div>

        <button type="submit" class="u-active-custom-color-10 u-border-none u-btn u-btn-submit u-button-style u-custom-color-4 u-hover-custom-color-9 u-block-control ui-draggable ui-draggable-handle u-block-0782-27" style="background-image: none" data-block="34">Войти</button>
      </form>

    </div>

    <form action="ПрофильРегистрация.phtml">

      <button type="submit" class="u-btn u-button-style u-border-grey-75 u-border-2 u-block-control u-grey-40 u-hover-grey-70 u-active-grey-90 u-block-0782-34" data-block="53" style="border-style: none; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 29px auto 60px 293.65px; background-image: none;" >РЕГИСТРАЦИЯ</button>
          
    </form>
        ';
    }
    
} 
catch (\Throwable $th) 
{
    echo "<br>Ошибка: ".$th."<br><br>";
}

?>
