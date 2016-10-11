
  <?php  
 
 $level_balls_arr = array(
	"1"=>  "1" ,
	"2"=>  "2" ,
	"3"=>  "3" ,
	"4"=>  "4" ,
	"5"=>  "5" ,
	"6"=>  "6" ,
	"7"=>  "7" ,
	"8"=>  "8" ,
	"9"=>  "9" ,
	"10"=>   "R"
	);         

 $level_word_arr = array(
	"1"=>   lang('main_level1') ,
	"2"=>   lang('main_level2') ,
	"3"=>   lang('main_level3') ,
	"4"=>   lang('main_level4') ,
	"5"=>   lang('main_level5') ,
	"6"=>   lang('main_level6') ,
	"7"=>   lang('main_level7') ,
	"8"=>   lang('main_level8') ,
	"9"=>   lang('main_level9') ,
	"10"=>   lang('main_level10') ,
	);         	
	    
	 
 ?>

 <?php  if (isset($user_id) || !empty($user_id)){    //if (!empty($user_info)){   ?>
 
<div class="m_howit"> <p class="big">История запросов<!--<?=lang('main_user_your_partner_progr')?>--></p>
 
            
            <div class="clear"></div>
 
<div > 
  <table class="refer" cellpadding="0" cellspacing="0" width="100%" >
    <tr>
      <td colspan="4"><p align="center">Сформированные запросы</p></td>
      <td colspan="2"> 
        
        </td>
      </tr>
    <?php if(isset($my_orders['list'])) {?>
    <tr>
      <td class="header_td" width="5%">#</td>
      <td class="header_td" width="25%">Дата создания<!--datetime_create--></td>
      <td class="header_td" width="25%">Дата оплаты<!--datetime_pay_done--> </td>
      <td class="header_td" width="10%">Стоимость, валюта<!--price--> </td> 
      <td class="header_td" width="15%">Назначение<!--target--> </td> 
      <td class="header_td" width="20%">Статус <!--pay_status--> </td>
      </tr>
    <?php  if(!empty($my_orders['list'])) { 
				   //echo "<pre>"; print_r($my_referals_all['list']); echo "</pre>";
					   foreach ($my_orders['list'] as $my_order){?>
    <tr>
      <td><div class="t_ref_id"> <?=$my_order['id']?> </div></td>
      <td><?php if($my_order['datetime_create']!='0') { echo date("d.m.Y H:i", $my_order['datetime_create'] ) ; }?></td> 
      <td><?php if($my_order['datetime_pay_done']!='0') { echo date("d.m.Y H:i", $my_order['datetime_pay_done'] ) ; }?></td>
      <td><?=$my_order['price']?> UAH</td> 
      <td><?=$my_order['target']?> </td> 
      <td class="ref_name"><?php if($my_order['pay_status']=="1") {echo "<span class='p_stat_payed'>Оплачен</span>";} else {echo "<span class='p_stat_notpayed'>Ожидает оплаты</span>";}?> </td>
      </tr>  
    <?php  } ?>
     
    <?php }  else { ?>
    <tr>
      <td colspan="4" align="center">Вы еще не производили оплат  </td>
      </tr> 
    <?php  } ?>
    <?php } 	 ?>
    
  </table>
  <t ble>
</div>

        </div><!--m_howit--><div class="clear"></div>
        
   <div class="separator_red_line"></div>
<?php } else { echo "Access denied"; }?> 
 <script> 
  
	 
</script>