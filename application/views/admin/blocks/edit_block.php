<div class="td-caption-top">Редактирование блока  
  <?php
  include_once("resources/fckeditor/fckeditor.php") ;

   if (!empty($block)): ?>
   <?php foreach($block as $a):?> 
</div>
<form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_blocks/edit_block_done/">
<!-- ----------------------------------------------------- -->
<div class="section">
	<ul class="tabs">
		<li class="current"><img src="/media/flags/russia.gif" width="23" height="18" /> Русский</li>
		<li><img src="/media/flags/usa.gif" width="23" height="18" /> English</li>
        <li><img src="/media/flags/ukraine.png" width="23" height="18" /> Українська</li>
		<!-- <li><img src="/media/flags/hungary.gif" width="23" height="18" /> Венгерский</li> -->
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
    <div class="box">
	<table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_menu_name-ukr" type="text"  value="<?php  print ($a['menu_name-ukr']);?>" size="100"/>      
          </div></td>
      </tr>
      
      
      <tr>
        <td width="161">&nbsp;</td>
        <td width="629">&nbsp;</td>
        </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 

$oFCKeditor = new FCKeditor('ed_full_text-ukr') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  $a['text-ukr'];
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
          <input name="ed_menu_name-hu" type="text"  value="<?php  print ($a['menu_name-hu']);?>" size="100"/>      
          </div></td>
      </tr>
      
      
      <tr>
        <td width="161">&nbsp;</td>
        <td width="629">&nbsp;</td>
        </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 

$oFCKeditor = new FCKeditor('ed_full_text-hu') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  $a['text-hu'];
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