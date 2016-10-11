 
 <?php if (isset($target_info) && $target_info!='') { ?>
<div align="center">
    <!-- =========    -->
 
  <div class="inorm">
  <?=$text?>
  </div>
  
  <div class="like_button" onClick="confirm_go_to_etap(<?=$target_info['id']?>);">Подтвердить</div>
 
    <!-- =========  info_go_to_pay_page  -->
</div>
<?php } ?>