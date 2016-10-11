
  
  <?php  $admin = $this->session->userdata;

$power = explode(",", $admin['power']);



if (in_array("see_only", $power)) $see_only = true; 
if (in_array("see_orders", $power)) $see_orders = true; 
if (in_array("see_order_vivods", $power)) $see_order_vivods = true; 
if (in_array("write_order_vivods_comm", $power)) $write_order_vivods_comm = true; 
if (in_array("prod_comments", $power)) $prod_comments = true; 

?>

<script type="text/javascript">
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить ВСЮ Информацию о записи ???")) {
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



////////////////////////
 

</script>

<?php
// echo "<pre>"; print_r($order_vivodslistall['order_vivods']); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('products_filter_admin_page', $_SERVER['REQUEST_URI']);
 $sort_by = $this->session->userdata('sort_paym_result_adm'); 
?>
<div id="base_list">
<!-- ------------------------Клиенты начало------------------------- -->


<!-- <div align="left"><a href="<?php echo base_url();?>manage_order_vivods/add_order_vivod" class="tlink">
    <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить клиента " title="Добавить клиента" height="30"  align="left" border="0"/>Добавить клиента</a></div> -->
 
</span>
 
<?php if (empty($order_vivodslistall['order_vivods'])){
	echo '<br>
	<div style="color:#900;">По данному запросу данных в базе не обнаружено </div>';
	} ?>    
 
<?php if  (isset($order_vivodslistall['order_vivods'])){?>
<div class="filter_alert">По данному запросу найдено Совпадений:  <b><?=$order_vivodslistall['total']?></b></div>
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
                <div class="sort_by_order_vivods <?=$sort_by_border?>" title="Сортировать по ID" sort_name="id" sort_type="<?=$sort_type_attr?>">№
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
 
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
                <div class="sort_by_order_vivods <?=$sort_by_border?>" title="Сортировать по Статус оплаты" sort_name="pay_status" sort_type="<?=$sort_type_attr?>">Статус оплаты
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
                <div class="sort_by_order_vivods <?=$sort_by_border?>" title="Сортировать по Назначение" sort_name="target" sort_type="<?=$sort_type_attr?>">Назначение
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
                <div class="sort_by_order_vivods <?=$sort_by_border?>" title="Сортировать по Дата создания счета" sort_name="datetime_create" sort_type="<?=$sort_type_attr?>">Дата создания запроса
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
                <div class="sort_by_order_vivods <?=$sort_by_border?>" title="Сортировать по Дата зачисления средств" sort_name="datetime_pay_done" sort_type="<?=$sort_type_attr?>">Дата отправки средств
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
                <div class="sort_by_order_vivods <?=$sort_by_border?>" title="Сортировать по Сумма" sort_name="price" sort_type="<?=$sort_type_attr?>">Сумма  (с формы)
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
 
 <td class="td-caption-h"> IP плательщика</td>
 <td class="td-caption-h">Реквизиты</td>
     </tr>
             <?php if (!empty($order_vivodslistall['order_vivods'])): ?>
             <?php foreach($order_vivodslistall['order_vivods'] as $cs):?>
             <?php // if (!empty($order_vivods)): ?>
             <?php // foreach($order_vivods as $cs):?>
              <tr>
             
                <td class="column"> <?=$cs['id']?>   </td>
                <td class="column"> <a href="/manage_customers/customer/<?=$cs['user_id']?>"><?php if(isset($cs['user_info']['name'])) {echo $cs['user_info']['name'].' '.$cs['user_info']['surname'] ;  if($cs['user_info']['urik_yn'] == 1) { echo "(ЮР. ЛИЦО)"; } }?></a> </td>
                <td class="column"> <a href="/manage_customers/customer/<?=$cs['referal_id']?>"><?php if(isset($cs['referal_info']['name'])) {echo $cs['referal_info']['name'].' '.$cs['referal_info']['surname'] ; }?></a> </td> 
                <td class="column" ><?php if($cs['pay_status']==0){ echo "ожидает отправки"; }  if($cs['pay_status']==1) {echo "отправлен";} ?>  </td>
                
                <td class="column" ><?php if ( isset($cs['target']) && !empty($targets)){ foreach($targets as $target){?> 
                     <?php if ($cs['target'] == $target['id']){ echo $target['menu_name'].' | с уровня '.$cs['from_level'] ;} ?>
                      <?php  }  ?>
                     <?php } else {echo" - ";}?> </td>
                     
                <td class="column"><?php echo date("d-M-Y H:i", $cs['datetime_create']); ?></td>
                <td class="column">
                 
				<?php if($cs['updated_by']!=0) { ?>
                 <?=date("d-M-Y H:i", $cs['updated_by'])?><br>
                 <?php
				 if($cs['pay_status']=='1'){ echo " <span class='readystatus sended'>Отправлена </span> ";}
				 if($cs['pay_status']=='2'){ echo " <span class='readystatus aborted'>Отказано </span> ";}
				 if($cs['pay_status']=='3'){ echo " <span class='readystatus wrong_anketa'>Неверные реквизиты </span> ";}
				  ?>
				 <?php } else { ?>
                	<a class="set_komiss_status sended" href="<?php echo base_url();?>manage_payments/do_komission_setstatus/<?=$cs['id']?>/1">Комиссия отправлена</a>
                    <a class="set_komiss_status aborted" href="<?php echo base_url();?>manage_payments/do_komission_setstatus/<?=$cs['id']?>/2">Отказано</a>
                    <a class="set_komiss_status wrong_anketa" href="<?php echo base_url();?>manage_payments/do_komission_setstatus/<?=$cs['id']?>/3">Неверные реквизиты получателя</a>
                <?php } ?>
                
                </td>
                <td class="column"> <?=$cs['price']?>  </td>
                <td class="column"> <?=$cs['ip_payer']?>  </td>
                
                <td class="column"> 
                ИНН <?=$cs['inn']?>,<br> 
                ADV Кошелек <?=$cs['adv_uid']?>
                </td>
                
              </tr>
               <?php endforeach ?>
              <?php endif ?> 
  </table>

 
  
  <div><?php echo $pages_code; ?></div>
  
  <br clear="all" />
  <div style="float:left;">   
     <?php if(isset($download_query) && !empty($download_query) && !empty($order_vivodslistall['order_vivods']) ) { ?>  
 <div class="dowload_query"><a href="<?php echo base_url();?>manage_payments/export_filter_orders/<?=$download_query?>" title="Выгрузить всю эту выборку в CSV " >Экспортировать  в CSV  </a>  </div> 
     <?php } ?>  
  </div>

  <!-- ------------------------ конец------------------------- -->      
</div>