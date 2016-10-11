 
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
 
</script>

<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
<div class="edit_customer">  
<div align="center" class="td-caption-top">Информация о Заказе
   <!-- <a href="<?php echo base_url();?>manage_bills/order_print/<?=$order_id?>" target="_blank">
 <img src="<?php echo base_url();?>media/images/print.png" align="middle" height="30" style="border: 0pt none ;" title='Вывести на страницу для печати' />
</a> -->
</div>
  <div id="general">
  <div id="edit_customer_info" class="jGrowl middle-right"> </div>

  <?php if (!empty($order)): ?>
  <?php foreach($order as $ord):?> 

  <table width="90%" border="0" cellspacing="0" cellpadding="1" class="listtable">
  <tr>
    <td class="td-caption caption-nt" width="150">Номер заказа
    <a href="<?php echo base_url();?>manage_bills/order_edit_f_one/<?php echo $ord['id']; ?>" target="_blank">
 <img src="<?php echo base_url();?>media/images/action-edit.png" align="center" height="20" style="border: 0pt none ;" title='Редактировать' />
</a>
    </td>
    <td class="column"><?=$ord['id']?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Дата заказа</td>
    <td class="column"><?=$ord['date_order']?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Пользователь</td>
    <td class="column"><?php echo $ord['surname']." ". $ord['name']." ".$ord['byfather']; ?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Страна, город </td>
    <td class="column"><?php echo $ord['country']."<br>". $ord['town'] ; ?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Email</td>
    <td class="column"><?=$ord['email']?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Телефон</td>
    <td class="column"><?=$ord['phone']?></td>
  </tr>
  
  <tr>
    <td class="td-caption caption-nt">Тур</td>
    <td class="column"><?php 
	  foreach($offers as $of){
		if($of['id'] == $ord['tour']) {echo $of['menu_name'];}
	}  
	//echo $ord['tour'];
	?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Дата тура</td>
    <td class="column"><?=$ord['tour_date']?></td>
  </tr>
    <tr>
    <td class="td-caption caption-nt">Колличество людей в поездке</td>
    <td class="column"><?=$ord['people']?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Экипировка</td>
    <td class="column"><?php if($ord['equipment'] == '0') {echo "Экипировка ЕСТЬ ";} else {'Нужна экипировка, размер = '.$ord['size'];}?></td>
  </tr>
  
  <tr>
    <td class="td-caption caption-nt">Примечание</td>
    <td class="column"><?=$ord['note']?></td>
  </tr>
    <tr>
    <td class="td-caption caption-nt">Откуда узнали о проекте</td>
    <td class="column"><?=$ord['know_from']?></td>
  </tr>
   
  <tr>
    <td class="td-caption caption-nt">Статус заказа</td>
    <td class="column"> 
    
     <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,1)">
                 <?php if (!empty($order_satuses)){ foreach($order_satuses as $order_satus){?> 
                 
          <option value="<?php  echo base_url()."manage_bills/update_order_status_fo/".$ord['id_user']."/".$ord['id']."/".$order_satus['id']?>"  
		  <?php  if (isset($ord['order_status']) && $ord['order_status']==$order_satus['id']){echo '  selected="selected" ';} ?>><?=$order_satus['name']?></option> 	  <?php  } } ?>
                   
                    </select>
    
    </td>
  </tr>
  
</table> 
 <?php endforeach ?>
 <?php endif ?> 
</div>
 