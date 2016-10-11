<script type="text/javascript">
function confirmChangeVisibleOff() {
	if (confirm("Вы уверены, что хотите сделать новость невидимой?")) {
		return true;
	} else {
		return false;
	}
}
function confirmChangeVisibleOn() {
	if (confirm("Вы уверены, что хотите сделать новость видимой пользователю?")) {
		return true;
	} else {
		return false;
	}
}
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить новость?")) {
		return true;
	} else {
		return false;
	}
}
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
            url:        "<?php echo base_url();?>manage_news/update_news_number",
            data:       {order: order.toString()},
            success:    function(response) { 
			if(response!=''){
				 $.jGrowl(response, { header: 'Уведомление' , life: 4000  }); 
			}
            },//end success function
            error: function(response){  
				 $.jGrowl(response, { header: 'Ошибка' , life: 4000  });
            }
        }) //end ajax call

    } 
  }); 
}); 
</script>
<div class="td-caption-top"><a href="<?php echo base_url();?>manage_news/add_new">
  <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить новость" title="Добавить новость" align="top" height="25" border="0"/></a>
   Новости </div> 
   
        <?php  if (empty($news['list'])) { ?>
        <div class="list-alert"> В этом списке нет новостей. Вы их можете добавить нажав плюс</div>
        <?php	} ?>
  <?php if (!empty($news['list'])): ?>
<!-- LIST Begin -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
        <tr>
        <td  class="td-caption"> Дата </td>
        <td  class="td-caption">Заголовок рус</td>
        <!--<td  class="td-caption">Заголовок укр </td> -->
        <td  class="td-caption"> Видимость</td>
        <td  class="td-caption" colspan="2"> Операции</td>
        </tr>
        </table>

 <ul id="sortable">
 <?php foreach($news['list'] as $a):?>
 <li id="<?php  echo $a['id'];?>" class="ui-state-default">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td width="35" valign="middle"><img src="<?php echo base_url();?>media/images/arrow-list-move.png" alt="move" width="20" height="20" class="handle" align="left" /></td>
            <td width="45" class="column"><?php  echo $a['date'];?></td>
            <td width="70%" class="column"><?php  echo $a['h1-rus'];?></td>
            <!--<td width="35%" class="column"><?php  echo $a['h1-eng'];?></td> -->
            <td width="35" class="column" align="center">
                <?php	  if($a['visible'] == '1'){  ?>
                         <a href="<?php echo base_url();?>manage_news/edit_new_visible/<?php echo $a['id']; ?>/<?php echo $a['visible']; ?>" onclick="return confirmChangeVisibleOff();">
                         <img src="<?php  echo base_url();?>media/images/globe_32.png" height="20"  alt="Видимая. Сделать невидимой" title="Видимая. Сделать невидимой"  border="0"/></a><?php } 
                            if($a['visible'] == '0') {?>
                         <a href="<?php echo base_url();?>manage_news/edit_new_visible/<?php echo $a['id']; ?>/<?php echo $a['visible']; ?>" onclick="return confirmChangeVisibleOn();">
                          <img src="<?php  echo base_url();?>media/images/minus-white.png" height="20" alt="Невидимая. Сделать видимой" title="Невидимая. Сделать видимой"  border="0"/></a>
                         <?php } ?>
                     </td>
                    
            <td width="35" class="column">
            <a href="<?php echo base_url();?>manage_news/edit_new/<?php  echo $a['id'];?>">  
             <img src="<?php echo base_url();?>media/images/action-edit.png" height="20" border="0" title='Редактировать' />
              </a>
            </td>
            <td width="35" class="column">
            <a href="<?php echo base_url();?>manage_news/delete_new/<?php echo $a['id']; ?>"  onclick="return confirmDelete();">
               <img src="<?php echo base_url();?>media/images/action-delete.png" height="20" border="0" title='Удалить' />  </a>
            </td>
          </tr>
             </table>
        </li>
  <?php endforeach ?>

</ul>
  <?php endif ?> 
     
        <!-- LIST End -->
<?php echo $pages_code; ?> 

