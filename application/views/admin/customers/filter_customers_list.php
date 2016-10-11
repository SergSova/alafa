<?php  $admin = $this->session->userdata;
$power = explode(",", $admin['power']);

if (in_array("see_only", $power)) $see_only = true; 
if (in_array("see_orders", $power)) $see_orders = true; 
if (in_array("see_customers", $power)) $see_customers = true; 
if (in_array("write_customers_comm", $power)) $write_customers_comm = true; 
if (in_array("prod_comments", $power)) $prod_comments = true; 

?>

<script type="text/javascript">
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить ВСЮ Информацию о клиенте ???")) {
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
 
	///=========


</script>

<?php
// echo "<pre>"; print_r($customerslistall['customers']); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('products_filter_admin_page', $_SERVER['REQUEST_URI']);
 $sort_by = $this->session->userdata('sort_cust_result_adm'); 
?>
<div id="base_list">
<!-- ------------------------Клиенты начало------------------------- -->


<!-- <div align="left"><a href="<?php echo base_url();?>manage_customers/add_customer" class="tlink">
    <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить клиента " title="Добавить клиента" height="30"  align="left" border="0"/>Добавить клиента</a></div> -->
 
</span>
 
<?php if (empty($customerslistall['customers'])){
	echo '<br>
	<div style="color:#900;">По данному запросу данных в базе не обнаружено </div>';
	} ?>    
 
<?php if  (isset($customerslistall['customers'])){?>
<div class="filter_alert">По данному запросу найдено Совпадений:  <b><?=$customerslistall['total']?></b></div>
<?php  } ?> 
<table width="100%" height="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
    <tr>
               <td width="8%" class="td-caption-h"> <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='id') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_customers <?=$sort_by_border?>" title="Сортировать по id" sort_name="id" sort_type="<?=$sort_type_attr?>">ID
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
                <td class="td-caption-h">
                 <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='surname') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_customers <?=$sort_by_border?>" title="Сортировать по фамилии" sort_name="surname" sort_type="<?=$sort_type_attr?>">Клиент
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
<td class="td-caption-h">Отрытые уровни</td>
<td class="td-caption-h">Кол-во партнеров</td>
<td class="td-caption-h">
        <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='email') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
        <div class="sort_by_customers <?=$sort_by_border?>" title="Сортировать по email" sort_name="email" sort_type="<?=$sort_type_attr?>">Email
          <span class="sort_arrow"><?=$arrow?></span>
</div></td>
                
                <td class="td-caption-h">Телефон<br> моб.</td>
                <td class="td-caption-h">
                <?php 
				$sort_type_attr = 'ASC';
				$arrow = '&darr; &uarr;';  
				$sort_by_border = '';
					if($sort_by['sort_name']=='town') { 
					$sort_by_border = ' sort_by_border '; 
					if($sort_by['sort_type']=='ASC'){$sort_type_attr='DESC'; $arrow = '&darr;'; }
					if($sort_by['sort_type']=='DESC'){$sort_type_attr='ASC'; $arrow = '&uarr;'; }
					}
				?>
                <div class="sort_by_customers <?=$sort_by_border?>" title="Сортировать по Город" sort_name="town" sort_type="<?=$sort_type_attr?>">Город
                <span class="sort_arrow"><?=$arrow?></span>
</div></td>
                 
                <td class="td-caption-h">Дата регистрации/<br>Последний вход</td> 
                <td class="td-caption-h">Последний IP</td>
         <!-- <td class="td-caption-h">Важный<br> комент.</td> -->
          
                <td colspan="2" class="td-caption-h">Операции</td>
    </tr>
             <?php if (!empty($customerslistall['customers'])): ?>
             <?php foreach($customerslistall['customers'] as $cs):?>
             <?php // if (!empty($customers)): ?>
             <?php // foreach($customers as $cs):?>
              <tr>
                  <td class="column" align="center"><?php  print ($cs['id']);?></td>
                  <td class="column">
                  <a href="<?php echo base_url();?>manage_customers/customer/<?php  print ($cs['id']);?>" target="_blank" class="tlink" title="Просмотреть карточку клиента &quot;<?php  print ($cs['surname']." ".$cs['name']);?>&quot; " >

                    <?php echo $cs['surname']." ".$cs['name'];?> <em>(Id <?=$cs['id']?>)</em><?php // echo "<pre>"; print_r($cs['online'])?>
                    <?php $time = time();   
        				  $time = $time - 300 ;
						    ?>
                    <?php if (!empty($cs['online']) && $cs['online']['last_activity'] > $time){?>
					<img src="<?=base_url()?>media/images/online1.jpg"  align="right">	
					<?php	} ?>
                    </a>
        
                  </td>
                  <td class="column"> <?php  if(!empty($cs['my_actual_levels'])) {
					  
					$main_levels = array();
              
                  foreach($cs['my_actual_levels'] as $level){
                    $main_levels[] = $level['target'];  
                  }
					//$main_levels = array_unique($main_levels);  
					  $my_actual_levels =  implode(", ",$main_levels );  echo $my_actual_levels;} ?>   </td>
                  <td class="column"> <?=$cs['count_of_referals']?>   </td>
                  <td class="column">
          <a href="mailto:<?=$cs['email']?>"><?=$cs['email']?></a>
           
          
                  </td>
                   <td class="column" id="cust_phone_td<?=$cs['id']?>"><?=$cs['phone']?>  </td>
                   <td class="column"> <?=$cs['town']?>   </td>
                
                <td class="column" style="font-size:80%;"> <?=$cs['date_reg']?>  / <br> <?=$cs['last_visit']?> </td>
               <td class="column">  <!--<?=$cs['history_sums']?>   --> 
                <?php 
				 if(isset($cs['order_sum'])) {
					echo "<b>".$cs['order_sum']."</b>";
					 
				} 
				?> </td>
                
                 <td width="5%" align="center" class="column edit-panell">
                <?php if (!isset($see_only)){ ?>
                <a href="<?php echo base_url();?>manage_customers/edit_customer/<?php echo $cs['id']; ?>"  >
                <img src="<?php echo base_url();?>media/images/action-edit.png" align="center" height="20" style="border: 0pt none ;" title='Редактировать' />
                </a>
                <?php } ?>
                </td>
                
               
                <td width="5%" align="center" class="column edit-panell">
                <?php if (!isset($see_only)){ ?>
                <a href="<?php echo base_url();?>manage_customers/delete_customer/<?php echo $cs['id']; ?>"  onclick="return confirmDelete();">
                <img src="<?php echo base_url();?>media/images/action-delete.png" align="center" height="20" style="border: 0pt none ;" title='Удалить' />
                </a>
                <?php } ?>
                </td>
                
               
                
              </tr>
               <?php endforeach ?>
              <?php endif ?> 
  </table>

  <div style="float:left;">   
     <?php /* if(isset($dowload_query) && !empty($dowload_query) && !empty($customerslistall['customers']) ) { ?>  
<div class="dowload_query"><a href="<?php echo base_url();?>manage_customers/download_query/<?=$dowload_query?>" target="_blank" title="Выгрузить всю эту выборку клиентов в CSV " >Выгрузить всю эту выборку клиентов в CSV  </a>  </div>
     <?php } */ ?>  
  </div>
  
  <div><?php echo $pages_code; ?></div>

  <!-- ------------------------ конец------------------------- -->      
</div>