<div class="td-caption-top">Редактирование блока  
  <?php  include_once("resources/fckeditor/fckeditor.php") ; ?>
</div>
<?php if (!empty($block)): ?>
   <?php foreach($block as $a):?> 
<form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_pages/edit_block_done/">
<!-- ----------------------------------------------------- -->
	  <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="table-u-b">
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_menu_name" type="text"  value="<?php  print ($a['menu_name']);?>" size="80"/>      
          </div></td>
      </tr>
      <tr>
        <td width="161">&nbsp;</td>
        <td width="629">&nbsp;</td>
      </tr>
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 

$oFCKeditor = new FCKeditor('ed_full_text') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  $a['text'];
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  400;
$oFCKeditor->Create() ;

?> 
          </td>
        </tr>
      </table>
<!-- ----------------------------------------------------- -->
 <div align="center">
 <input name="position" type="hidden" value="<?php  print ($a['position']);?>" />
 <input name="id_ed" type="hidden" value="<?php  print ($a['id']);?>" />
          <input name="btn"  type="submit" class="button"  value="Изменить" />
 </div>

</form>
<?php endforeach ?>
 <?php endif ?> 