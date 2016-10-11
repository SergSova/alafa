<script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script>
 
<div class="td-caption-top">Уровни</div>
 
  <?php   if (!empty($levels)): ?>
 

<form id="edit_levels_done" name="edit_levels_done"  method="post" action="<?php echo base_url();?>manage_customers/edit_levels_done"  onsubmit = "return checkformnew(this)" enctype="multipart/form-data">
 
 <table width="500"  class="uchet listtable">
  <tbody>
    <tr>
      <td class="td-caption-h">Этап </td>
      <td class="td-caption-h">Номер</td> 
      <td class="td-caption-h">Название рус.</td>
      <td class="td-caption-h">Название укр.</td>
      <td class="td-caption-h">Название англ.</td> 
      <td class="td-caption-h">Цена регистрации, UAH</td> 
      <td class="td-caption-h">Цена регистрации, USD</td> 
      </tr>
    <?php foreach($levels as $level ){ ?>
    <tr>
      <td class="column"> <?=$level['etap']?>  
      <input name="levels[<?=$level['id']?>][id]" type="hidden"  value="<?=$level['id']?>"   />
      </td>
      <td class="column"><input name="levels[<?=$level['id']?>][level]" type="text"  value="<?=$level['level']?>"   onkeyup="return only_num(this);" onchange="return only_num(this);"  size="20" required />      </td>
      <td class="column"><input name="levels[<?=$level['id']?>][menu_name-rus]" type="text"  value="<?=$level['menu_name-rus']?>" size="20" required /></td>
      <td class="column"><input name="levels[<?=$level['id']?>][menu_name-ukr]" type="text"  value="<?=$level['menu_name-ukr']?>" size="20" required /></td> 
      <td class="column"><input name="levels[<?=$level['id']?>][menu_name-eng]" type="text"  value="<?=$level['menu_name-eng']?>" size="20" required /></td>
       
      <td class="column"><input name="levels[<?=$level['id']?>][price_uah]" type="text"  value="<?=$level['price_uah']?>" size="20"   onkeyup="return only_num(this);" onchange="return only_num(this);"  required /> 
      </td>
      <td class="column"><input name="levels[<?=$level['id']?>][price_usd]" type="text"  value="<?=$level['price_usd']?>" size="20"   onkeyup="return only_num(this);" onchange="return only_num(this);"  required />
      </td>
      </tr>
    <?php } ?>
    
    <tr>
      <td colspan="4">
      <input name="btn" type="submit" class="button" value="Сохранить" />
      </td>
      <td>&nbsp;</td> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
  </tbody>
</table>


<!-- ----------------------------------------------------- -->
  
</form>
 
 <?php endif ?> 