<script type="text/javascript">
function confirmChangeVisibleOff() {
	if (confirm("Вы уверены, что хотите сделать страницу невидимой?")) {
		return true;
	} else {
		return false;
	}
}
function confirmChangeVisibleOn() {
	if (confirm("Вы уверены, что хотите сделать страницу видимой пользователю?")) {
		return true;
	} else {
		return false;
	}
}
function confirmChangeshow_topOff() {
	if (confirm("Вы уверены, что хотите сделать страницу невидимой сверху в меню?")) {
		return true;
	} else {
		return false;
	}
}
function confirmChangeshow_topOn() {
	if (confirm("Вы уверены, что хотите сделать страницу видимой сверху в меню?")) {
		return true;
	} else {
		return false;
	}
}
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить страницу?")) {
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
 	  function slideout(){
  setTimeout(function(){
  $("#info").slideUp("slow", function () {
      });
    
}, 2000);}
	
   $("#info").hide();				   
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
            url:        "<?php echo base_url();?>manage_pages/update_page_number",
            data:       {order: order.toString()},
            success:    function(response) {
        	 // $('#info').html(response);
			  //$('#info').slideDown('slow');
             //    slideout();
			  $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
            },//end success function
            error: function(response){
               // $('#info').html(response);
				 $.jGrowl(response, { header: 'Уведомление' , life: 4000  });
            }
        }) //end ajax call

    } 
  }); 
}); 
</script>


<div class="td-caption-top">
 <a href="<?php echo base_url();?>manage_pages/add_page">
  <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить страницу" height="25" align="top" title="Добавить страницу"  border="0"/></a>
  Пункты главного меню (Страницы)</div>
   <?php  if (empty($pages)) { ?>
           <div class="list-alert"> В этом списке нет страниц. Вы их можете добавить нажав плюс</div>
   <?php	} ?>
   <table cellpadding="0" cellspacing="0" width="100%">
	<tr> 
      <td  class="td-caption" width="50%">Название пункта в меню</td> 
      <td  class="td-caption" width="15%">Подключенный Раздел </td>
      <td  class="td-caption" width="15%">Подключена форма</td>
      <td  class="td-caption" width="50"> Вид в верхнем меню</td>
      <td  class="td-caption" width="50"> Видимость</td>
      <td  class="td-caption" colspan="2" width="20" align="right"> Операции</td>
     </tr>
</table>
<!--<div id='info'></div> -->
<ul id="sortable">
 <?php if (!empty($pages)): ?>
 <?php foreach($pages as $a):?>
 
  <li id="<?php  echo $a['id'];?>" class="ui-state-default" >
         <!-- LIST Begin -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" <?php if ($a['module']!='') {echo '  style="background-color:#ffeac1;" ';} ?> >
          <tr>
            <td width="25"><img src="<?php echo base_url();?>media/images/arrow-list-move.png" alt="move" width="20" height="20" class="handle" align="left" /></td>
            <td width="50%" >  <?php if ($a['module']=='404') {  echo "<span style='color:red;'>".$a['menu_name']."</span>"; } else { echo $a['menu_name']; } ?>
            <?php // if ($a['module']=='') {echo '  style="background-color:#EEE69B;" ';} ?>
              </td>
            <td width="15%"> <?php  
			if ($a['module']=='news') {echo 'Новости';} 
			if ($a['module']=='reviews') {echo 'Отзывы';}
			if ($a['module']=='documents') {echo 'Документы';} 
			
			if ($a['module']=='404') { ?> 
            <img src="<?php  echo base_url();?>media/images/404min.jpg"  height="30"  alt="404" title="404"  border="0"/>  
			<?php  } ?> </td>
            <td width="10%" class="f_9_px"> 
			<?php  if (isset($a['note']) && $a['note']=='contacts') {echo 'Форма обратной связи';} ?>
            <?php  if (isset($a['note']) && $a['note']=='order') {echo 'Форма заявки ';} ?> 
             </td>
             <td width="35"> 
                <?php	  if($a['show_top'] == '1'){  ?>
                         <a href="<?php echo base_url();?>manage_pages/edit_page_show_top/<?php echo $a['id']; ?>/<?php echo $a['show_top']; ?>/" onclick="return confirmChangeshow_topOff();">
                         <img src="<?php  echo base_url();?>media/images/default-app.png"  height="20"  alt="Видимая. Сделать невидимой вверху" title="Видимая. Сделать невидимо вверху"  border="0"/></a><?php } 
                            if($a['show_top'] == '0') {?>
                         <a href="<?php echo base_url();?>manage_pages/edit_page_show_top/<?php echo $a['id']; ?>/<?php echo $a['show_top']; ?>/" onclick="return confirmChangeshow_topOn();">
                          <img src="<?php  echo base_url();?>media/images/gtk-remove.png"  height="20"  alt="Невидимая. Сделать видимой вверху" title="Невидимая. Сделать видимой вверху"  border="0"/></a>
                         <?php } ?> 
                     </td>
            <td width="35">
            <?php if($a['id']!='1'){ ?>
                <?php	  if($a['visible'] == '1'){  ?>
                         <a href="<?php echo base_url();?>manage_pages/edit_page_visible/<?php echo $a['id']; ?>/<?php echo $a['visible']; ?>/" onclick="return confirmChangeVisibleOff();">
                         <img src="<?php  echo base_url();?>media/images/globe_32.png"  height="20"  alt="Видимая. Сделать невидимой" title="Видимая. Сделать невидимой"  border="0"/></a><?php } 
                            if($a['visible'] == '0') {?>
                         <a href="<?php echo base_url();?>manage_pages/edit_page_visible/<?php echo $a['id']; ?>/<?php echo $a['visible']; ?>/" onclick="return confirmChangeVisibleOn();">
                          <img src="<?php  echo base_url();?>media/images/minus-white.png"  height="20"  alt="Невидимая. Сделать видимой" title="Невидимая. Сделать видимой"  border="0"/></a>
                         <?php } ?>
                          <?php } ?>
                     </td>
            <td width="35">
            <a href="<?php echo base_url();?>manage_pages/edit_page/<?php  echo $a['id'];?>">  
             <img src="<?php echo base_url();?>media/images/action-edit.png"   height="20" border="0" title='Редактировать' />
              </a>
            </td>
            <td width="35">
            <?php if($a['id']!='1'){ ?>
            <a href="<?php echo base_url();?>manage_pages/delete_page/<?php echo $a['id']; ?>"  onclick="return confirmDelete();">
               <img src="<?php echo base_url();?>media/images/action-delete.png"  height="20" border="0" title='Удалить' />  </a>
            <?php } ?>
            </td>
          </tr>
        </table>
        <!-- LIST End -->
  </li>
  <?php endforeach ?>
  <?php endif ?> 
</ul>
<div class="clear"></div>


<div class="notes" style="margin: 20px;">

<h3>Условные обозначения</h3>

<table width="600" cellspacing="0" class="note_table">
  <tr>
    <td><div style="background-color:#ffeac1; padding:10px;">такой фон</div></td>
    <td> <p>- это обозначиение того, что к странице подключен вами раздел. 
      Тогда в главном меню на сайте пользователь сможет попасть при клике на этот пункт на раздел, который указан в управлении соответствующей страницей.</p>
      <p>Управление самим же разделом, который вы указали, и его материалами находится в левом меню панели управления.</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>
