  
 <?php   if (isset($target_info) && $target_info!='') { ?>
<div align="center">
    <!-- =========    -->
 
  <div class="inorm">
  <?=$target_info['text']?>
  </div>
<label>  <input type="checkbox" id="agree_benef" name="agree_benef"> Согласен с публичным договором Оферты *</label>
  <div class="like_button reg" onClick="confirm_go_pay_reg('usd');">Подтверждаю регистрацию за 5 USD </div>
  или 
  <div class="like_button reg" onClick="confirm_go_pay_reg('uah');">Подтверждаю регистрацию за 100 UAH</div>
 
    <!-- =========  info_go_to_pay_page  -->
    <div id="pay_reg"> </div>
</div>

<?php } ?>