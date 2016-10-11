<script type="text/javascript">
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить администратора?")) {
		return true;
	} else {
		return false;
	}
}
</script>

<div class="td-caption-top"> Настройки </div>
<div align="center">
  <table width="800" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="340"><div align="left">
        <a href="<?php echo base_url();?>manage_settings/add_admin">
  <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить администратора" height="25" title="Добавить администратора"  border="0" align="left"/></a>
      <strong>Администраторы </strong></div></td>
  <!--       <td width="458">  
<div align="center"> 
<a href="<?php echo base_url();?>manage_settings/add_admin">
<img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить администратора" title="Добавить администратора"  border="0"/></a>
</div>
    </td> -->
      </tr>
    
    </table>
  <table width="80%"  cellspacing="0" cellpadding="0"  class="listtable">
    <tr>
      <td width="50%" class="td-caption-h">Имя </td>
      <td width="50%" class="td-caption-h">Логин </td>
      <td class="td-caption-h" width="35" colspan="2">Операции</td>
    </tr>
    
    <?php if (!empty($admindata)): ?>
    <?php foreach($admindata as $a):?> 
    <tr>
      <td class="column"><?php  print ($a['fio']);?></td>
      <td class="column"><?php  print ($a['login']);?></td>
      <td width="8%" align="center" class="column"> 
        <a href="<?php echo base_url();?>manage_settings/edit_admin/<?php echo $a['id']; ?>">
        <img src="<?php echo base_url();?>media/images/action-edit.png" width="25" height="25"   style="border: 0pt none ;" title='Редактировать' />
        </a>
      </td>
      <td width="35"  align="center" class="column">
        <?php if ($a['id']!= '1' && $a['id']!= '2' ) { ?> 
        <a href="<?php echo base_url();?>manage_settings/delete_admin/<?php echo $a['id']; ?>"  onclick="return confirmDelete();">
          <img src="<?php echo base_url();?>media/images/action-delete.png" width="25" height="25"  border="0" title='Удалить' /> 
          </a>
        <?php } ?>
        </td>
    </tr>
    <?php endforeach ?>
    <?php endif ?> 
  </table>
  <br><br><br>
  <table width="80%" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="340"><div align="left"><strong>Адреса почты для отправки сообщений</strong></div></td>
      <td width="458">   
  <div align="center"></div>
      </td>
      </tr>
    
    </table>
  <table width="80%"  cellspacing="0" cellpadding="0"  class="listtable">
    <tr>
      <td width="50%" class="td-caption-h">Назначение </td>
      <td width="50%" class="td-caption-h">Адрес </td>
      <td class="td-caption-h" width="35">Операции</td>
    </tr>
    
    <?php if (!empty($emails)): ?>
    <?php foreach($emails as $e):?> 
    <tr>
      <td class="column"><?php  print ($e['target']);?></td>
      <td class="column"><?php  print ($e['value']);?></td>
      <td width="8%" align="center" class="column"> 
        <a href="<?php echo base_url();?>manage_settings/edit_email/<?php echo $e['id']; ?>">
        <img src="<?php echo base_url();?>media/images/action-edit.png" width="25" height="25"   style="border: 0pt none ;" title='Редактировать' />
        </a>
      </td>
    </tr>
    <?php endforeach ?>
    <?php endif ?> 
  </table>
</div>
