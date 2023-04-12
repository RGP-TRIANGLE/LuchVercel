<?php
    echo '
        <section class="u-align-center u-clearfix u-section-1" id="sec-693c">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Регистрация</h2>
        <div class="u-form u-form-1">

          <form action="registration.php" method="post" style="padding: 10px" name="form">
            <div class="u-form-group u-form-name u-label-none">
              <label for="name-3b9a" class="u-label">Name</label>
              <input type="text" placeholder="ФИО" id="name-3b9a" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>

            <div class="u-form-email u-form-group u-label-none">
              <label for="email-3b9a" class="u-label">Email</label>
              <input type="email" placeholder="Электронная почта" id="email-3b9a" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>

            <div class="u-form-address u-form-group u-block-control ui-draggable ui-draggable-handle u-label-none u-block-0782-31" style="margin-left: 0" data-block="32" data-block-type="FormField">
                <label for="address-aaa7" class="u-label u-block-0782-32" style="">Адрес</label>
                <input type="text" placeholder="Пароль" id="address-aaa7" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-block-0782-33" required="" style="" data-block-type="FormChild">
            </div>

            <div class="u-form-group u-form-phone u-label-none u-form-group-3">
              <label for="phone-c402" class="u-label">Телефон</label>
              <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Телефон" id="phone-c402" name="phone" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>
            <div class="u-form-address u-form-group u-label-none u-form-group-4">
              <label for="address-aaa7" class="u-label">Адрес</label>
              <input type="text" placeholder="Адрес" id="address-aaa7" name="address" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>

            <button type="submit" class="u-active-custom-color-10 u-border-none u-btn u-btn-submit u-button-style u-custom-color-4 u-hover-custom-color-9 u-btn-1">Зарегистрироваться</button>

            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
            <input type="hidden" value="" name="recaptchaResponse">
            <input type="hidden" name="formServices" value="66f4465d5ce46b540a49f0ea3cc004c1">
          </form>
        </div>
      </div>
    </section>
        ';
?>