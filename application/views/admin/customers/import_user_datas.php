<script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script>
 
<div class="td-caption-top">Импорт некоторых данных по клиентам</div>
         
          <?php  if (empty($cust_files)) { ?>
           <div class="list-alert"> В списке нет файлов . Предоставьте список разработчику</div>
          <?php	} ?>
 <div class="add_new_price">
  
    <form action="<?php echo base_url();?>manage_customers/add_upload_cust_file" method="post" enctype="multipart/form-data"  id="form1" name="form1">   
            <div class="td-caption-top"> <span>Загрузить файл </span> 
             <input type="file" name="file_cust" required />  
             <input name="btn"  type="submit" class="button"  value="Загрузить" />     
            </div>
    </form>
  
</div>
<?php if(isset($alert)) {  ?>
 
<div class="sync_import_ready"><?=$alert?></div>
 
<?php	}   ?>


 <?php if (!empty($cust_files)): ?>
 
<table cellpadding="0" cellspacing="0" width="100%" class="listtable">
    <tr> 
      <td  class="td-caption" width="10%">Название</td>
      <td  class="td-caption" width="45%" colspan="2">Файл</td>  
    </tr> 
 <?php foreach($cust_files as $cats):
 $file = $cats['file_name'];
 $global_import_dir = 'impex/customer_files/';
 ?>
 
 <tr> 
 
         <!-- LIST Begin -->
    
               <td  class="column sync_item" > 
                <span class="name"><?php echo $cats['name'];?> </span> 
 </td>
               
               <td class="column"><div class="text_data">
                 <div><em>Имя файла </em> -  <strong><?php echo $cats['file_name'];?></strong> </div> 
                 <?php $ves = 0; if( file_exists($global_import_dir.$file) && is_readable($global_import_dir.$file) ){
					$ves_bytes = filesize($global_import_dir.$file);
					$ves = round($ves_bytes /1024, 2) ;
					//$filesize = round($filesize, 1); 
					 } ?>
                 <div><em>Размер</em> -  <strong> <?=$ves?> Кб</strong> </div>
               
               </div></td>
               
               <td class="column"><div class="apply_block">
                 <?php // echo $cats['price_name'];
				 $ves = ' - ';
				 if($cats['file_name']==''){
				 ?> 
                 <div class="sync_item_alert">
                   <img src="<?php echo base_url();?>media/css/admin/img/warning.png" width="35" height="33" alt="Warning" />Файл <i><?=$cats['file_name']?></i> не указан
                 </div>
                 
                 <!-- 00000000000000000000 -->
                 <?php	} else { 

				// $file = $cats['price_name'];
				// $global_import_dir = 'impex/cust_files/';
				if( file_exists($global_import_dir.$file) && is_readable($global_import_dir.$file) ){
				//	$ves = filesize($global_import_dir.$file); ?>
                 
<div class="sync_item"> 
          <a href="javascript:void(0);" class="upload" id="<?=$cats['method']?>" onclick="apply_customer_file('<?=$cats['method']?>')"  filepath="<?=$file?>" title="<?=$global_import_dir.$file?> - Импортировать информацию о клиентах"> 
          Импортировать данные "<?php echo $cats['name'];?>" </a> 
          
   <div class="last_update">Последнее применение - <span><?php echo $cats['file_date_upd'];?></span></div>
                 </div>
                 <?php	} else { ?>
                 <div class="sync_item_alert">
                   <img src="<?php echo base_url();?>media/css/admin/img/warning.png" width="35" height="33" alt="Warning" />Файл <i><?=$cats['file_name']?></i> не найден или закрыт для чтения
                   </div>
                 <?php	}   ?>
                 <?php	}   ?> 
<!-- 1111111111111111111111111 --></div></td>
               
        <!-- LIST End -->
 
  <?php endforeach ?>

          </tr>
  
  <?php endif ?> 
  </table>
<div class="clear"></div>

<div class="server_log"></div>
