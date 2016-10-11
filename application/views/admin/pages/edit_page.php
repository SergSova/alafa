<div class="td-caption-top"> Редактирование страницы   </div>
  <?php
  include_once("resources/fckeditor/fckeditor.php") ;

   if (!empty($page)): ?>
   <?php foreach($page as $a):?> 


 
<form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_pages/edit_page_done/">

<div align="left" class="td-caption-top"> <span> Подключить форму </span>
 <select id="note" name="ed_note">
              <option value="" <?php if ($a['note']=='') {echo ' selected="selected" ';} ?>> - (нет) - </option>
              <option value="order" <?php if ($a['note']=='order') {echo ' selected="selected" ';} ?>> Форма заявки  </option> 
              <option value="contacts" <?php if ($a['note']=='contacts') {echo ' selected="selected" ';} ?>> Форма обратной связи </option> 
 </select> 
 <br>
 <span>Подключить раздел </span>
           <select id="module" name="ed_module">
              <option value="" <?php if ($a['module']=='') {echo ' selected="selected" ';} ?> > - (не подключать) - </option> 
              <option value="news" <?php if ($a['module']=='news') {echo ' selected="selected" ';} ?> > Новости </option>  
              <option value="reviews" <?php if ($a['module']=='reviews') {echo ' selected="selected" ';} ?> > Отзывы </option>  
              <option value="documents" <?php if ($a['module']=='documents') {echo ' selected="selected" ';} ?> > Документы </option>   
              
              <option value="404"  style="color:#F00" <?php if ($a['module']=='404') {echo ' selected="selected" ';} ?> >  Страница ошибки 404  </option>  
          </select>     <!--  (при выборе раздела текст, заполняемый ниже, НЕ ПОКАЖЕТСЯ, а покажется соответсвующий раздел сайта) -->
 </div> 
 
<div align="left" class="td-caption-top"> <span> Алиас </span>
<input name="url" type="text"  value="<?php  print ($a['url']);?>" size="100"/>  
</div> 



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
        <td width="161" class="td-caption">TITLE (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_title-rus" type="text"  value="<?php  print ($a['title-rus']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left"> 
<textarea name="ed_descr-rus" cols="70"  rows="2"><?php  print ($a['descr-rus']);?></textarea>  
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_kwd-rus" type="text"  value="<?php  print ($a['kwd-rus']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_h1-rus" type="text"  value="<?php  print ($a['h1-rus']);?>" size="100"/>      
          </div></td>
        </tr>
      <tr>
        <td width="161" class="td-caption">Название в меню</td>
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
        <td width="161" class="td-caption">TITLE (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_title-eng" type="text"  value="<?php  print ($a['title-eng']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<!--          <input name="ed_descr" type="text"  value="<?php  print ($a['descr-eng']);?>" size="100"/> -->
<textarea name="ed_descr-eng" cols="70"  rows="2"><?php  print ($a['descr-eng']);?></textarea>    
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_kwd-eng" type="text"  value="<?php  print ($a['kwd-eng']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_h1-eng" type="text"  value="<?php  print ($a['h1-eng']);?>" size="100"/>      
          </div></td>
        </tr>
      <tr>
        <td width="161" class="td-caption">Название в меню</td>
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
        <td width="161" class="td-caption">TITLE (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_title-ukr" type="text"  value="<?php  print ($a['title-ukr']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<!--          <input name="ed_descr" type="text"  value="<?php  print ($a['descr-ukr']);?>" size="100"/> -->
<textarea name="ed_descr-ukr" cols="70"  rows="2"><?php  print ($a['descr-ukr']);?></textarea>    
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_kwd-ukr" type="text"  value="<?php  print ($a['kwd-ukr']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_h1-ukr" type="text"  value="<?php  print ($a['h1-ukr']);?>" size="100"/>      
          </div></td>
        </tr>
      <tr>
        <td width="161" class="td-caption">Название в меню</td>
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
        <td width="161" class="td-caption">TITLE (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_title-hu" type="text"  value="<?php  print ($a['title-hu']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<!--          <input name="ed_descr" type="text"  value="<?php  print ($a['descr-hu']);?>" size="100"/> -->
<textarea name="ed_descr-hu" cols="70"  rows="2"><?php  print ($a['descr-hu']);?></textarea>    
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="ed_kwd-hu" type="text"  value="<?php  print ($a['kwd-hu']);?>" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="ed_h1-hu" type="text"  value="<?php  print ($a['h1-hu']);?>" size="100"/>      
          </div></td>
        </tr>
      <tr>
        <td width="161" class="td-caption">Название в меню</td>
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
          <input name="btn" type="submit" class="button"  value="Сохранить изменения" />
 </div>
<input name="id_ed" type="hidden" value="<?php  print ($a['id']);?>" />
</form>
<?php endforeach ?>
 <?php endif ?> 