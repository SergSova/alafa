<script type="text/javascript">
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить заказ ???")) {
		return true;
	} else {
		return false;
	}
}
function confirmDeleteCat() {
	if (confirm("Вы уверены, что хотите удалить запись??")) {
		return true;
	} else {
		return false;
	}
}
</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

 <div class="td-caption-top">Новые заказы : 
 <?php if  (isset($total)){?>
<div class="filter_alert" style="display:inline">  <?=$total?> </div>
<?php  } ?> 
 </div>
<div id="base_list">
<!-- ------------------------ начало------------------------- -->
 
 
<?php
//echo "<pre>";
//print_r($orders);

 if (empty($orders['orders'])){
	echo '<br>
	<div class="search_alert">Новых заказов нет </div>';
	} ?>    
 <!--
 
 '#privatbank_status#',  
 '#privatbank_transaction_id#',
 '#privatbank_sender_phone#',
 '#privatbank_pay_way#',      
  -->

<table width="100%" height="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
    <tr>
                <td class="td-caption-h">Номер заказа</td>
                <td class="td-caption-h">Дата</td>
                <td class="td-caption-h">Клиент</td>
                <td class="td-caption-h">Email</td>
                <!--<td class="td-caption-h">Способ оплаты</td> -->
                <td class="td-caption-h">Состояние</td>
                <td colspan="2" class="td-caption-h">Операции</td> <!-- 10 -->
    </tr>
              <?php if (!empty($orders['orders'])): ?>
        <form name="form" id="form">       
             <?php foreach($orders['orders'] as $cs):?>
              
              <tr>
                   <td class="column" align="center"><b>
                   <a href="<?php echo base_url();?>manage_bills/order/<?php  print ($cs['id']);?>" target="_blank" class="tlink" title="Перейти к полной информации о заказе" > Заявка # <?php  print ($cs['id']);?></a>
                   </b></td>
                   <td class="column" align="center"><?php  print ($cs['date_order']);?></td> 
                    
                  <td class="column"> 
                    <?php   echo $cs['surname']." ".$cs['name'];?>  
                  </td>
                  <td class="column">
          <a href="mailto:<?=$cs['email']?>"><?=$cs['email']?></a>
                  </td>
                
          <!--<td class="column"><?php  if ($cs['payment_method']=='1') {echo "Квитанция";}   ?></td> -->
                <td class="column"> 
                <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,1)">
                 <?php if (!empty($order_satuses)){ foreach($order_satuses as $order_satus){?> 
                 
          <option value="<?php  echo base_url()."manage_bills/update_order_status/".$cs['id_user']."/".$cs['id']."/".$order_satus['id']?>"  
		  <?php  if (isset($cs['order_status']) && $cs['order_status']==$order_satus['id']){echo '  selected="selected" ';} ?>><?=$order_satus['name']?></option>
                 
				 <?php  /*if ($cs['order_status'] == $order_satus['id']){?>
                  <?=$order_satus['name']?> 
                  <?php } */ ?>
				  <?php  } } ?>
                   
                    </select>
               </td>
                <td width="5%" align="center" class="column edit-panell"> 
               <a href="<?php echo base_url();?>manage_bills/order_edit/<?php echo $cs['id']; ?>" target="_blank">
                <img src="<?php echo base_url();?>media/images/action-edit.png" align="center" height="20" style="border: 0pt none ;" title='Редактировать' />
               </a>
                </td>
                <td width="5%" align="center" class="column edit-panell">
                <a href="<?php echo base_url();?>manage_bills/delete_order_fn/<?php echo $cs['id']; ?>"  onclick="return confirmDelete();">
                <img src="<?php echo base_url();?>media/images/action-delete.png" align="center" height="20" style="border: 0pt none ;" title='Удалить' />
                </a>
                </td>
              </tr>
               <?php endforeach ?>
         </form>
              <?php endif ?> 
  </table>

 
<!-- ------------------------  конец------------------------- -->      
</div>