<div class="td-caption-top">Блокирование доступа по IP </div>

<table width="400"  cellspacing="0" cellpadding="0"  class="listtable border_rad_5">
  <tr>
    <td width="400" class="td-caption-h">Магазин  
    <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Быстрое добавление" title="Быстрое добавление" width="25" align="top" border="0" onclick="toggle_show('add_to_shop')"/> 
 
     <a href="<?php echo base_url();?>manage_ban/edit_ban_shop_page">  
        <img src="<?php echo base_url();?>media/images/action-edit.png"  width="25" border="0" title='Редактировать' />
    </a>   
    </td>  
    
  </tr>
 
 
 <?php // foreach($block as $a):?> 
  <tr>
      <td class="column_d" style="padding:10px; word-wrap:break-word;">
      
      <div id="add_to_shop" style="display:none">
      <fieldset>
      	<legend>
        <div class="td-caption">Быстрое добавление адресов для блокировки магазина</div>
        </legend>
      <form  method="post" action="<?php echo base_url();?>manage_ban/add_to_shop_ban/" enctype="multipart/form-data"    name="myform" id="myform">
<div>
  <div style="float:left;"><textarea name="ips" cols="40" rows="3"></textarea></div>
  <div style="float:right; width:250px;">Вводить  ip по очереди через запятую. Если данные будут введены неверно,
   то могут возникнуть проблемы в работе системы. Введенные значения будут добавлены к существующим.</div>
  <br> 
  <div style="clear: both;"></div>
</div>
<input name="btn"  type="submit" class="button"  value="Добавить" /> 
      </form>
      </fieldset>
      </div>
<?php if (!empty($ban_list_shop)):?>  
	    <?php echo $ban_list_shop;  ?> 
	  <?php  endif ?>
    </td>
  
  </tr>
  <tr>
    <td width="50%" class="td-white"><?php // print ($a['text']);?></td>
  
  </tr>
  <?php // endforeach ?>
   
</table>