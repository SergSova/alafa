<?php  $admin = $this->session->userdata;
$power = explode(",", $admin['power']);

if (in_array("see_only", $power)) $see_only = true; 
if (in_array("see_orders", $power)) $see_orders = true; 
if (in_array("see_customers", $power)) $see_customers = true; 
if (in_array("write_customers_comm", $power)) $write_customers_comm = true; 
if (in_array("prod_comments", $power)) $prod_comments = true; 
  
?>

<script type="text/javascript">
function confirmDelete_comment(id) {
	if (confirm("Вы уверены, что хотите удалить комментарий  ???")) {
		//return true;
		do_delete_comment(id);
	} else {
		return false;
	}
}
//****************************************	
 	function do_delete_comment(id_comment){	 
                $.ajax({  
                    type: "POST",  
                    url:   "/manage_customers/delete_customer_comment/"+id_comment,
					cache: false, 
			     	 success: function(response){
					    if(response == 1){ 
					 $('#row_'+id_comment).html('удалено');
					 $('#row_'+id_comment).hide(700);  
					  }
					  else{
					 	 $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
					  }
						}				
                });  
	}
//****************************************
</script>

<h3> Комментарии администрации </h3>


<div id="base_comments_list">  
<?php
//echo "<pre>";
//print_r($orders);

 if (empty($comments['list'])){
	echo '<br> <div style="color:#ffffff; font-size:16px;"> Нет комментариев </div>';
	} else{ ?>    
  
<table width="800" cellspacing="0" cellpadding="0" align="center" class="cart_table orders_tabl" >
    <tr>
                <th class="checkout-t-hd" width="100">Дата</th>
                <th class="checkout-t-hd" width="600">Текст</th> 
                <th class="checkout-t-hd" width="20">Важность</th> 
                <th class="checkout-t-hd">Кто добавил</th> 
                <th class="checkout-t-hd">Изменения</th> 
                 <th class="checkout-t-hd" width="40" colspan="2">операции</th> 
    </tr>
              <?php if (!empty($comments['list'])): ?>
       
             <?php foreach($comments['list'] as $c_l):?>
              
              <tr id="row_<?php echo $c_l['id']; ?>" <?php if($c_l['important'] == '1'){echo 'style="background-color: #fffbcc;"'; } ?> >
                <td class="column" ><?php  print ($c_l['date']);?></td> 
                    
                <td class="column"><?php // br2nl($c_l['comment']);
				//echo str_replace("<br>", "\n", $c_l['comment']);
				//echo $c_l['comment'];
				echo "<u><i>".$c_l['hid_com']."</i></u><br>".$c_l['comment'] ;
				?></td>
                <td width="35" align="center" valign="middle">
                <?php if($c_l['important'] == '1'){  ?>
     <img src="<?php  echo base_url();?>media/images/warning.png" width="20" alt="Важный " title="Важный"  border="0"/> <?php }  ?> 
            </td> 
            <td class="column" ><?php  print ($c_l['add_by']);?></td> 
            <td class="column" ><?php  if($c_l['date_edit']!=='0000-00-00 00:00:00') { echo $c_l['date_edit']."/<br>".$c_l['last_edit_by']; } ;?></td> 
                <td width="5%" align="center" class="column edit-panell"> 
              <?php if (!isset($see_only)){ ?> <a href="<?php echo base_url();?>manage_customers/edit_customer_comment/<?php echo $c_l['id']; ?>" >
            <img src="<?php echo base_url();?>media/images/action-edit.png" align="center" height="20" style="border: 0pt none ;" title='Редактировать' />
               </a><?php } ?>
                </td>
                <td width="5%" align="center" class="column edit-panell"> 
               <?php if (!isset($see_only)){ ?> <img onclick="return confirmDelete_comment('<?php echo $c_l['id']; ?>');" src="<?php echo base_url();?>media/images/action-delete.png" align="center" height="20" border="0" title='Удалить' /><?php } ?>
              
                </td>
                
              </tr>
               <?php endforeach ?>
              <?php endif ?> 
  </table> 
  <?php } ?>
</div>