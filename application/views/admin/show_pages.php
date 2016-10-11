  <div class="td-caption-top">Страницы</div>
<table width="100%"  cellspacing="0" cellpadding="0"  class="listtable">

  <tr>
    <td class="td-caption-h">Заголовок рус</td>
    <td class="td-caption-h">Заголовок укр</td>
    <td class="td-caption-h" width="15%">Операции</td>
  </tr>
 <?php if (!empty($pages)): ?>
 <?php foreach($pages as $a):?> 
  <tr>
      <td class="column"><?php  print ($a['h1-rus']);?></td>
      <td class="column"><?php  print ($a['h1-eng']);?></td>
      <td width="8%" align="center" class="column"> 
    <a href="<?php echo base_url();?>manage_pages/edit_page/<?php echo $a['id']; ?>">
    <img src="<?php echo base_url();?>media/images/action-edit.png" width="25" height="25"  align="center" style="border: 0pt none ;" title='Редактировать' />
    </a>
    </td>
  </tr>
  <?php endforeach ?>
  <?php endif ?> 
</table>