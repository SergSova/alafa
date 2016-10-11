<?php /* ------- Confirmation information-------- = = = = Generator Privat banka  = = = ------
       <img src="/media/css/user/img/icons/good-mark.png" alt="ok" height="20"  align="middle"/>
         <?=lang('main_user_order_confirm_prod_qty_ok')?>
  </div>
   */
 $user_id = $this->session->userdata('user_id');
  ?> 
  <div align="center"><?=$text?> </div>

<div align="center" > 

<?php if (isset($form) && !empty($form) ) {echo $form;} //  || $_SERVER['REMOTE_ADDR']=='127.0.0.1' ?>

<?php // if (isset($form) && !empty($form)) {echo $form;} 
// && in_array($user_id, array(1,2,3,9,81))) ?>

</div>
 
<?php /* ------- Confirmation information-------------- */  ?>    