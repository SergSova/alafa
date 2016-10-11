<div class="td-caption-top"> 
<a href="<?php echo base_url();?>manage_settings/edit_order_template">
    <img src="<?php echo base_url();?>media/images/action-edit.png" width="25" height="25"  align="center" style="border: 0pt none ;" title='Редактировать' />
</a> Шаблон квитанции</div>
  <?php   if (!empty($order_template)): ?>
   <?php foreach($order_template as $a):?> 
 
		  <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      <tr> 
        <td class="td-caption"><div align="left">
          <?=$a['name']?>    
          </div></td>
        </tr> 
      <tr>
        <td  align="center">
          <?=$a['text']?> 
          </td>
        </tr>
      </table>
 
<?php endforeach ?>
 <?php endif ?> 