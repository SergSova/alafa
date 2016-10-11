  <?php include_once("resources/LiqPay.php") ; ?>
 <script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script> 
  <?php  $admin = $this->session->userdata;
$power = explode(",", $admin['power']);

/*
state 	Может принимать следующие значения: 
ok - успешный, 
fail - забракован,
 test - тестовый, 
 wait - в ожидании. 
 Статус wait устанавливается, если платеж находится в очереди на обработку более 60сек. 
 Для этих случаев необходимо ожидать ответа на адрес, указанный в поле server_url.
*/

$pb_statuses = array(
"ok" => "приват24 успешный",
"fail" => "приват24 забракован",
"test" => "приват24 тестовый",
"wait" => "приват24 в ожидании",

"success" => "успешный платеж",
"failure" => "НЕуспешный платеж",
"wait_secure" => "платеж на проверке",
"wait_accept" => "Деньги с клиента списаны, но магазин еще не прошел проверку",
"wait_lc" => "Аккредитив. Деньги с клиента списаны, ожидается подтверждение доставки товара",
"wait_processing" => "Платеж обрабатывается",
"sandbox" => "тестовый платеж",
"subscribed" => "Подписка успешно оформлена",
"unsubscribed" => "Подписка успешно деактивирована",
"reversed" => " Возврат клиенту после списания",
"hand_tranz_done" => "Внесено вручную"
);

if (in_array("see_only", $power)) $see_only = true; 
if (in_array("see_orders", $power)) $see_orders = true; 
if (in_array("see_payments", $power)) $see_payments = true; 
if (in_array("write_payments_comm", $power)) $write_payments_comm = true; 
if (in_array("prod_comments", $power)) $prod_comments = true; 


$merchant_id='i30240804689';
$public_key = 'i30240804689';
    $signature="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant    
	$private_key="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant    
	
    $url="https://liqpay.com/?do=clickNbuy";
	$method='card';
	


?>

<script type="text/javascript">

function fresh() {
location.reload();
}
setInterval("fresh()",100000);

function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить ВСЮ Информацию о записи ???")) {
		//return true;
		alert("удаление заблокировано разработчиком");
	} else {
		return false;
	}
}
function confirmDeleteCat() {
	if (confirm("Вы уверены, что хотите удалить запись??")) {
		//return true;
		alert("удаление заблокировано разработчиком");
	} else {
		return false;
	}
}



 //************************************************
  function init_dop_proverka(order_id) {  
  $.jGrowl("Идет проверка статуса оплаты", { header: 'Уведомление' , life: 2000  }); 
 
		 $.ajax({  
							type: "POST",  
							url:  "/manage_payments/ask_status_from_bank/"+order_id,
							cache: false,  
							success: function(response){ 
							  //=======
							   var response_obj = $.parseJSON(response);
								if(response_obj.status == 1) {
					   
										 		$("#payment_id_"+order_id).html(response_obj.payment_id); 
												$("#date_pay_"+order_id).html(response_obj.date_done); 
												$.jGrowl('данные оплаты ' +order_id+' обновлены' , { header: 'Уведомление' , life: 2000  }); 
					 
										   }
										 else{
												$.jGrowl(response_obj.message+"<br><br>("+response_obj.description+")", { header: 'Уведомление' , life: 4000  }); 
										 }			
							  //=======
							}
							//  "/"+main_lang+
		 }); 	 
  } 
//***********************************************************

////////////////////////
 

</script>

<?php
// echo "<pre>"; print_r($paymentslistall['payments']); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('products_filter_admin_page', $_SERVER['REQUEST_URI']);
 $sort_by = $this->session->userdata('sort_paym_result_adm'); 
?>
<div id="base_list">
<!-- ------------------------Клиенты начало------------------------- -->


<!-- <div align="left"><a href="<?php echo base_url();?>manage_payments/add_payment" class="tlink">
    <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить клиента " title="Добавить клиента" height="30"  align="left" border="0"/>Добавить клиента</a></div> -->
 
</span>
 
<?php if (empty($paymentslistall['payments'])){
	echo '<br>
	<div style="color:#900;">По данному запросу данных в базе не обнаружено </div>';
	} ?>    
 
<?php if  (isset($paymentslistall['payments'])){?>
<div class="filter_alert">По данному запросу найдено Совпадений:  <b><?=$paymentslistall['total']?></b></div>
<?php  } ?> 
<table width="100%" height="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
    <tr>
                <!--<td width="8%" class="td-caption-h">Id</td>-->
                <td class="td-caption-h">
                 <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='id') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по ID" sort_name="id" sort_type="<?=$sort_type_attr?>">№
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<!--<td class="td-caption-h">Пользователь </td>-->
<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='user_id') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по user_id" sort_name="user_id" sort_type="<?=$sort_type_attr?>">Пользователь
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='referal_id') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по referal_id" sort_name="referal_id" sort_type="<?=$sort_type_attr?>">Верхний реферал
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>



<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='pay_status') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Статус оплаты" sort_name="pay_status" sort_type="<?=$sort_type_attr?>">Статус оплаты
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>

<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='target') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Назначение" sort_name="target" sort_type="<?=$sort_type_attr?>">Назначение
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='pb_trans_id') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Transaction ID" sort_name="pb_trans_id" sort_type="<?=$sort_type_attr?>">Transaction ID
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='datetime_create') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Дата создания счета" sort_name="datetime_create" sort_type="<?=$sort_type_attr?>">Дата создания счета
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='datetime_pay_done') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Дата зачисления средств" sort_name="datetime_pay_done" sort_type="<?=$sort_type_attr?>">Дата зачисления средств
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
      <td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='pb_status') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Статус платежа" sort_name="pb_status" sort_type="<?=$sort_type_attr?>">Статус платежа
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='price') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_payments <?=$sort_by_border?>" title="Сортировать по Сумма" sort_name="price" sort_type="<?=$sort_type_attr?>">Сумма 
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
 
 <td class="td-caption-h">Свободная колонка</td> 
 <td class="td-caption-h"> IP плательщика</td>
     </tr>
             <?php if (!empty($paymentslistall['payments'])): ?>
             <?php foreach($paymentslistall['payments'] as $cs):?>
             <?php // if (!empty($payments)): ?>
             <?php // foreach($payments as $cs):?>
       <tr>
             
                  <td class="column">  <strong><?=$cs['id']?></strong>   </td>
                  
                <td class="column">   <a href="/manage_customers/customer/<?=$cs['user_id']?>"><?php if(isset($cs['user_info']['name'])) {echo $cs['user_info']['name'].' '.$cs['user_info']['surname'] ;  if($cs['user_info']['urik_yn'] == 1) { echo "(ЮР. ЛИЦО)"; } }?></a> </td>
                <td class="column">   <a href="/manage_customers/customer/<?=$cs['referal_id']?>"><?php if(isset($cs['referal_info']['name'])) {echo $cs['referal_info']['name'].' '.$cs['referal_info']['surname'] ; }?></a> </td>
                <td class="column" ><div class=" pay_status_<?=$cs['id']?>" >
                  <?php if($cs['pay_status']==0){ echo "не оплачен"; }  if($cs['pay_status']==1) {echo "оплачен";} ?> 
                </div></td>
                <td class="column" ><?php if ( isset($cs['target']) && !empty($targets)){ foreach($targets as $target){?> 
                     <?php if ($cs['target'] == $target['id']){ echo $target['menu_name'] ;} ?>
                      <?php  }  ?>
                      <?php } else {echo" - ";}?> </td>
                <td class="column" align="left">
                <div id="payment_id_<?=$cs['id']?>">
                
              <div class="dod_form_zap" >   
                <?php if(($cs['pb_trans_id']==0 || $cs['pb_trans_id']=='') && $cs['datetime_pay_done']==0 ) {?>
                
                     Данные транзакции отсутствуют
               
                <?php } /*<a href="/manage_payments/ask_status_from_bank/<?=$cs['id']?>">запросить результат повторно</a> */
				else { echo "КОД ТРАНЗАКЦИИ"; }  ?>
                
                
<!--<div class="dop_proverka" onClick="init_dop_proverka();">Доп. проверка</div>-->
   </div>
</div>

</td>  
                <td class="column"><?php echo date("d-M-Y H:i", $cs['datetime_create']); ?></td>
                <td class="column" id="date_pay_<?=$cs['id']?>">
				 <?php if($cs['datetime_pay_done']!=0) {echo date("d-M-Y H:i", $cs['datetime_pay_done']); } ?>
                
                <?php /* if($cs['datetime_pay_done']!=0) {echo date("d-M-Y H:i", $cs['datetime_pay_done']); } else { ?>
                	<a href="<?php echo base_url();?>manage_payments/do_pay_cash_received/<?=$cs['id']?>">Получено кешем</a>
                <?php } */?>
                
                </td>
                <td class="column"><?php // if($cs['pb_status']!='') echo $pb_statuses[$cs['pb_status']] ;
				//echo $cs['pb_status']."<br>";
				foreach($pb_statuses as $key=>$value) {
					if($cs['pb_status']==$key) echo $value;
					}
				
				?> 
                <?php if(  ($cs['pb_trans_id']==0 || $cs['pb_trans_id']=='') || $cs['pb_status']=='' || $cs['pb_status']=='hand_tranz_done' ) {?>
                <div class=" open_block_set_hand_tranz_link block_set_hand_tr_<?=$cs['id']?>"  onclick="open_block_set_hand_tranz(<?=$cs['id']?>);">Указать вручную  </div>
                 <?php } ?>  
                  <div class="set_list_hand_tr_text" id="set_list_hand_tr_<?=$cs['id']?>" align="left">
                        Данные транзакции<br><br>
                         номер транзакции<input name="tranz_id" id="tranz_id_<?=$cs['id']?>"  value="<?=$cs['pb_trans_id']?>" size="12" />     <br> 
                                <div class="ord_filt_col"> 
                                <span>Статус оплаты </span>
                                <select class="pay_status_<?=$cs['id']?>"  id="pay_status_<?=$cs['id']?>" name="payment_status"   required  > 
                                              <option value="0" <?php if (isset($cs['payment_status']) && $cs['payment_status'] =='0') {echo 'selected="selected" ';}?> >Ожидает оплаты</option>
                                              <option value="1" <?php if (isset($cs['payment_status']) && $cs['payment_status'] =='1') {echo 'selected="selected" ';}?>>Оплачен</option> 
                                 </select> 
                                 <br>
                                </div>  
                                <textarea name="comment" id="comment_<?=$cs['id']?>" cols="30" rows="4" placeholder="текст комментария"></textarea>    <br> 
                                
                                <input type="hidden" name="" value="hand_tranz_done">
                                
                         <button onclick="set_hand_tranz(<?=$cs['id']?>); return false;" style="color: #333; font-size:8px;">Применить</button> 
                    </div>
                    
         </td>
                <td class="column"> <?=$cs['price']?>  </td>
                <td class="column">  </td> 
                <td class="column"> <?=$cs['ip_payer']?>  </td>
                
              </tr>
               <?php endforeach ?>
              <?php endif ?> 
  </table>

 
  
  <div><?php echo $pages_code; ?></div>

  <!-- ------------------------ конец------------------------- -->      
</div>