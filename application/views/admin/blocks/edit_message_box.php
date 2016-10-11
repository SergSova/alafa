<div class="td-caption-top">Редактирование блока  
  <?php
  include_once("resources/fckeditor/fckeditor.php") ;

   if (!empty($message_box)): ?>
   <?php foreach($message_box as $a):?> 
</div>
<form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_blocks/edit_message_box_done/">
<!-- ----------------------------------------------------- -->
    <div class="td-caption-top"> <span class="w_100"> Таймаут </span>
      <input name="timeout" type="text"   value="<?=$a['timeout']?>"  size="20" onkeyup="return only_num(this);" onchange="return only_num(this);" /> 
    </div>


<div class="section">
	<ul class="tabs">
		<li class="current"><img src="../../../media/css/user/img/flag-ru.png" width="23" height="18" /> Русский</li>
		<li><img src="../../../media/css/user/img/flag-eng.png" width="23" height="18" /> English</li>
	</ul>
	<div class="box visible">
		  <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_menu_name-rus" type="text"  value="<?php  print ($a['menu_name-rus']);?>" size="100"/>      
          </div></td>
      </tr>
      
      
      <tr>
        <td width="161">&nbsp;</td>
        <td width="629">&nbsp;</td>
        </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 

$oFCKeditor = new FCKeditor('ed_full_text-rus') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  $a['text-rus'];
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  400;
$oFCKeditor->Create() ;

?> 
          </td>
        </tr>
      </table>
	</div>

	<div class="box">
	<table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_menu_name-eng" type="text"  value="<?php  print ($a['menu_name-eng']);?>" size="100"/>      
          </div></td>
      </tr>
      
      
      <tr>
        <td width="161">&nbsp;</td>
        <td width="629">&nbsp;</td>
        </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 

$oFCKeditor = new FCKeditor('ed_full_text-eng') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  $a['text-eng'];
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  400;
$oFCKeditor->Create() ;

?> 
          </td>
        </tr>
     
      </table>
	</div>
</div>
<!-- ----------------------------------------------------- -->
 <div align="center"> 
 <input name="id_ed" type="hidden" value="<?php  print ($a['id']);?>" />
          <input name="btn" type="submit" value="Изменить" />
 </div>

</form>
<?php endforeach ?>
 <?php endif ?> 