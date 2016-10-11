<div class="td-caption-top"> Блок </div>

<table width="100%"  cellspacing="0" cellpadding="0"  class="table-u-b">
  <tr>
    <td width="50%" class="td-caption-h">Заголовок</td>  
    <td class="td-caption-h" width="35">Операции</td>
  </tr>
 
 <?php if (!empty($block)): ?>
 <?php foreach($block as $a):?> 
  <tr>
      <td class="column"><?php  print ($a['menu_name']);?></td>
      <td width="8%" align="center" class="edit-panell"> 
    <a href="<?php echo base_url();?>manage_pages/edit_block/<?php echo $a['id']; ?>">
    <img src="<?php echo base_url();?>media/images/action-edit.png" width="25" height="25"  align="center" style="border: 0pt none ;" title='Редактировать' />
    </a>
    </td>
  </tr>
  <tr>
    <td width="50%" class="td-white"><?php  print ($a['text']);?></td>
    <td class="td-white"></td>
  </tr>
  <?php endforeach ?>
  <?php endif ?> 
</table>