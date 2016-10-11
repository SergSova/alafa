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
function confirmDelete_comment_written(id) {
	if (confirm("Вы уверены, что хотите удалить комментарий к товару ???")) {
		//return true;
		do_delete_comment_written(id);
	} else {
		return false;
	}
}
//****************************************	
 	function do_delete_comment_written(id_comment){	 
                $.ajax({  
                    type: "POST",  
                    url:   "/manage_customers/delete_customer_comment_written/"+id_comment,
					cache: false, 
			     	 success: function(response){
					    if(response == 1){ 
					 $('#row_written_'+id_comment).html('удалено');
					 $('#row_written_'+id_comment).hide(700);  
					  }
					  else{
					 	 $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
					  }
						}				
                });  
	}
//****************************************
</script>

<h3> Комментарии пользователя к товарам <?php if (isset($comments_writen['total'])) { echo "Всего: ".$comments_writen['total']." отзыва ";} ?> </h3>


<div id="base_comments_list">  
<?php
//echo "<pre>";
//print_r($orders);

 if (empty($comments_writen['list'])){
	echo '<br> <div style="color:#ffffff; font-size:16px;"> Нет комментариев </div>';
	} else{ ?>    
  
<table width="800" cellspacing="0" cellpadding="0" align="center" class="cart_table orders_tabl" >
    <tr>
                <th class="checkout-t-hd" width="100">Дата</th>
                <th class="checkout-t-hd" width="600">Текст</th> 
                <th class="checkout-t-hd" width="20">Одобрен</th> 
                <th class="checkout-t-hd">Группа товаров</th> 
                <th class="checkout-t-hd">Подписался именем</th> 
                 <th class="checkout-t-hd" width="40" colspan="2">операции</th> 
    </tr>
              <?php if (!empty($comments_writen['list'])): ?>
       
             <?php foreach($comments_writen['list'] as $prod_comm):?>
              
              <tr id="row_written_<?php echo $prod_comm['id']; ?>">
                <td class="column" ><?php  print ($prod_comm['date']);?></td> 
                    
                <td class="column"><?php 
				echo $prod_comm['text'] ;
				?></td>
                <td width="35" align="center" valign="middle">
                <?php if($prod_comm['yn'] == '0'){  ?>
     <img src="<?php  echo base_url();?>media/images/warning.png" width="20" alt="Не одобрен" title="Не одобрен" border="0"/> <?php } else { ?>
     <img src="<?php  echo base_url();?>media/images/approve.png" width="20" alt="одобрен" title="одобрен" border="0"/>
     <?php }  ?>  
            </td> 
            <td class="column" ><?php if(isset($prod_comm['group']['menu_name'])) { echo $prod_comm['group']['menu_name']; } else { echo " - группа не найдена - ";} ?></td> 
            <td class="column" ><?php  print ($prod_comm['user_name']);?></td> 
                <td width="5%" align="center" class="column edit-panell"> 
              
                </td>
                <td width="5%" align="center" class="column edit-panell">
              <?php if (!isset($see_only)){ ?>  <img onclick="return confirmDelete_comment_written('<?php echo $prod_comm['id']; ?>');" src="<?php echo base_url();?>media/images/action-delete.png" align="center" height="20" border="0" title='Удалить' /> <?php } ?>
             
                </td>
                
              </tr>
               <?php endforeach ?>
              <?php endif ?> 
  </table> 
  <?php } ?>
</div>