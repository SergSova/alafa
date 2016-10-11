<script type="text/javascript">
function change_count_items(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script> 
<script type="text/javascript">
 
function confirmDelete(id) {
	if (confirm("Вы уверены, что хотите удалить ВСЮ Информацию о запросе ???")) {
		//return true;
		do_delete_feedback(id);
	} else {
		return false;
	}
} 

//****************************************	
 	function do_delete_feedback(id_product){	 
                $.ajax({  
                    type: "POST",  
                    url:   "/manage_statistic/delete_feedbackt/"+id_product,
					cache: false, 
			     	 success: function(response){
					    if(response == 1){ 
					 $('#prod_row_'+id_product).html('<td class="loaded_alert" colspan="9">удален</td>');
					 $('#prod_row_'+id_product).hide(700); 
					  }
					  else{
					 	 $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
					  }
						}				
                });  
	}
//****************************************

</script> 
 
 <script> 
$(document).ready(function(){
    $('.checkAll').click(function(){
    if($(this).attr('checked')){
        $('input.delete:checkbox').attr('checked',true);
    }
    else{
        $('input.delete:checkbox').attr('checked',false);
    } 
});
////
    $('.checkAll_move').click(function(){
    if($(this).attr('checked')){
        $('input.move:checkbox').attr('checked',true);
    }
    else{
        $('input.move:checkbox').attr('checked',false);
    } 
	
	
});
 

});
  </script>

<div id="base_list">
<!-- ------------------------  начало------------------------- -->
<?php 
//print_r($products['groupslist']);
 // echo "<pre>"; print_r( $products['groupslist']); echo "</pre>";         
 ?>
<?php if (empty($list['list'])){
	echo '<br>
	<div class="search_alert">По данному запросу данных в базе не обнаружено </div>';
	} ?>
<div id="add_edit_item"></div>
<?php if  (isset($list['total'])){?>
<div class="filter_alert">По данному запросу найдено Совпадений:  <b><?=$list['total']?></b></div>
<?php  } ?>
<?php if (!empty($list['list'])):  ?>

<div class="paging_top"><?php echo $pages_code; ?></div>
<form method="post" action="<?php echo base_url();?>manage_shop/update_wait_goods_info/" enctype="multipart/form-data">
  
  <table width="100%" height="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
    <tr> 
    			<td class="td-caption-h"> № </td>
                <td class="td-caption-h"> Пользователь </td> 
                <td class="td-caption-h"> Телефон  </td> 
                <td class="td-caption-h"> Почта  </td> 
                <td class="td-caption-h"> Тема  </td> 
                <td class="td-caption-h"> Текст  </td> 
                <td class="td-caption-h"> Дата </td> 
                <td class="td-caption-h"> Комментарий </td> 
				<td class="td-caption-h"> Операции </td>  
                
                
    </tr>
              
             <?php $count = 0; foreach($list['list'] as $prds): $count++;?>
              <tr id="prod_row_<?=$prds['id']?>"> 
                  <td class="column name" align="left">
                       
                   <?=$count?> 
                    <input name="products[<?=$prds['id']?>][id]" type="hidden" id="id"  value="<?=$prds['id']?>"  />
                  </td>
                    <td class="column" align="left"><?=$prds['name']?></td> 
                    <td class="column" align="left"><?=$prds['phone']?></td> 
                    <td class="column" align="left"><?=$prds['email']?></td>  
                    <td class="column" align="left"><?=$prds['topic']?></td>  
                    <td class="column" align="left"><?=$prds['text']?></td>  
                    <td class="column" align="left"><?=$prds['date_add']?></td> 
   		 
               <td class="column" align="left" width="150"> 
              <div class="set_comment_list_popular list_comment_<?=$prds['id']?>"  onclick="change_list_comment_do(<?=$prds['id']?>);"> 
                        <?php if (isset($prds['comment']) && $prds['comment']!='' ) { echo "<span style='color: #28a129;' >".$prds['comment']."</span>"; } else { echo "<span style='color: #900; font-size:9px;' >не указан</span>";}?> 
                       </div>
                       
                        <div class="set_list_comment_text" id="set_list_comment<?=$prds['id']?>">
                        Текст комментария<br>
                         <textarea name="comment" id="comment_<?=$prds['id']?>" cols="30" rows="4"><?=$prds['comment']?></textarea>    <br> 
                        <button onclick="save_list_feedback(<?=$prds['id']?>); return false;" style="color: #333; font-size:8px;">Применить</button> 
                        </div>
              
              </td> 
                 <td align="center" class="column edit-panell">
                <a onclick="confirmDelete('<?=$prds['id']?>');"> 
                <img src="<?php echo base_url();?>media/images/action-delete.png" align="center" height="16" style="border: 0pt none ;" title='Удалить' />
                </a>
                </td>      
              </tr>
               <?php endforeach ?>
          
  </table>
  
  
  <div id="save_product_new_info" align="right">
  
    
  
  
   <div style="float:right">
  <input type="hidden" name="product_redirect_url" value="<?=$_SERVER['REQUEST_URI']?>" />
   <!-- <input name="btn"  type="submit" class="button"  value="Сохранить изменения" /> -->
  </div> 
  
 
</form>
<br clear="all" />
<?php echo $pages_code; ?>

     
  <!--</form> -->


<?php endif ?> 
<!-- ------------------------Продукция конец------------------------- -->      
</div>
<?php
//echo "<pre>";
//print_r($customers); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('customers_admin_page', $_SERVER['REQUEST_URI']);

 
?>