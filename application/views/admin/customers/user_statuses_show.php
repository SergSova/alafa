<script type="text/javascript">
function confirmChangeVisibleOff() {
	if (confirm("Вы уверены, что хотите сделать статус невидимым?")) {
		return true;
	} else {
		return false;
	}
}
function confirmChangeVisibleOn() {
	if (confirm("Вы уверены, что хотите сделать статус видимым ?")) {
		return true;
	} else {
		return false;
	}
}
function confirmDelete(id) {
	
	var count_of_products=document.getElementById('count_of_products_bb_'+id).innerHTML; 
	//alert(count);
	if(count_of_products >= 1  ){
		alert('Вы не можете удалить статус,\n пока к нему привязаны пльзователи  .');
		return false;
		}
		else{
			if (confirm("Вы уверены, что хотите удалить статус???")) {
				//return true;
				do_delete_user_status(id);
			} else {
				return false;
			}
		}
}

//****************************************	
 	function do_delete_user_status(id_user_status){	
	
				//var serverName = SERVER_HTTP_HOST();
                $.ajax({  
                    type: "POST",  
                    url:   "/manage_customers/delete_user_status/"+id_user_status,
					cache: false, 
			     	 success: function(response){
						  if(response == 1){
						//	alert('#prod_row_'+id_product);
				     //  window.location = (response);
					 $('#'+id_user_status).html('<td class="loaded_alert" colspan="21">удален</td>');
					 $('#'+id_user_status).hide(700);
					 //$('#prod_row_'+id_product).remove();
					  }
					  else{
					 	 $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
					  }
					  /*  if(response.substring(0,4) == 'http'){
				       window.location = (response);
					  }
					  else{
					 	 $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
					  }*/
						}				
                });  
	}
//****************************************
</script>
 
<script>
	$(function() {
		$( "#sortable" ).sortable({
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).disableSelection();
	});

$(document).ready(function() { 
 						   
  $("#sortable").sortable({
	opacity: 0.6,
    handle : '.handle', 
    update : function () { 

       order = $('#sortable').sortable('toArray');
	
 $.ajax({
		/*
		beforeSend: function () {
                alert(order);
            },*/
            type:       "POST",
            url:        "<?php echo base_url();?>manage_customers/update_user_status_number",
            data:       {order: order.toString()},
            success:    function(response) { 
				 $.jGrowl(response, { header: 'Уведомление' , life: 4000  }); 
            },//end success function
            error: function(response){  
				 $.jGrowl(response, { header: 'Ошибка' , life: 4000  });
            }
        }) //end ajax call

    } 
  }); 
}); 
</script>
 
<div class="td-caption-top">
 <a href="<?php echo base_url();?>manage_customers/add_user_status">
   <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить статус" title="Добавить статус" width="25" align="top" border="0"/></a>
   Статусы пользователей <!--(<?=$user_statuss['total']?>) --> 
</div>
                   
 <?php  if (empty($user_statuss['list'])) { ?>
           <div class="list-alert"> В этом списке нет статусов. Вы их можете добавить нажав плюс</div>
 <?php	} ?>
 <?php if (!empty($user_statuss['list'])): ?>
  <div align="left" style="padding-left:10px;">
  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td class="td-caption" width="10"></td>
      <td class="td-caption" width="65%">Название</td>  
      <td class="td-caption" width="10%"> Пользователи</td>
      <td class="td-caption" width="35"> Видимость</td>
      <td class="td-caption" colspan="2" width="100" align="right"> Операции</td>
    </tr>
  </table>
  </div>

<ul id="sortable">

 <?php foreach($user_statuss['list'] as $user_status):?>
 
  <li id="<?=$user_status['id']?>" class="ui-state-default" <?php if($user_status['id']==0) { echo 'style=" color: #c40000; background-color: #fff8dc; "'; } ?>>
         <!-- LIST Begin -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35" valign="middle"><img src="<?php echo base_url();?>media/images/arrow-list-move.png" alt="move" width="20" height="20" class="handle" align="left" /></td>
             <td align="left" width="50%">  
           		 <?php echo $user_status['menu_name'];?>
                 
         </td>
          
              
               <td align="left" width="20%" >
               <?php if(!empty($user_status['preview'])) { ?> 
               <img src="<?php echo base_url().$user_status['preview'];?>" height="30" align="left" border="0" />
             
           		 <?php  } // echo $user_status['menu_name'];?> 
               </td>
                
                <td align="left" width="50"> 
                <div id="count_of_products_bb_<?php echo $user_status['id']; ?>"><?php echo $user_status['count_of_users'];?></div>
                </td>   
            <td width="35">
                <?php	  if($user_status['visible'] == '1'){  ?>
<a href="<?php echo base_url();?>manage_customers/edit_user_status_visible/<?php echo $user_status['id']; ?>/<?php echo $user_status['visible']; ?>/" onclick="return confirmChangeVisibleOff();">
                         <img src="<?php  echo base_url();?>media/images/globe_32.png" width="20"  alt="Видимая. Сделать невидимой" title="Видимая. Сделать невидимой"  border="0"/></a><?php } 
                            if($user_status['visible'] == '0') {?>
  <a href="<?php echo base_url();?>manage_customers/edit_user_status_visible/<?php echo $user_status['id']; ?>/<?php echo $user_status['visible']; ?>/" onclick="return confirmChangeVisibleOn();">
                          <img src="<?php  echo base_url();?>media/images/minus-white.png" width="20"  alt="Невидимая. Сделать видимой" title="Невидимая. Сделать видимой"  border="0"/></a>
                         <?php } ?>
            </td>
            <td width="50">
           <a href="<?php echo base_url();?>manage_customers/edit_user_status/<?php  echo $user_status['id'];?>">  
             <img src="<?php echo base_url();?>media/images/action-edit.png"  width="20" border="0" title='Редактировать' />
              </a>
            </td>
            <td width="50"> 
               <img src="<?php echo base_url();?>media/images/action-delete.png"   width="20" border="0" title='Удалить'  onclick="return confirmDelete(<?php echo $user_status['id']; ?>);" />   
            </td>
          </tr>
        </table>
        <!-- LIST End -->
  </li>
  <?php endforeach ?>

</ul>
  <?php endif ?> 
<div class="clear"></div> 