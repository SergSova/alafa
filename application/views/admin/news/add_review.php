<script type="text/javascript" src="<?php echo base_url();?>js/jquery.date_input.js"></script>
<script type="text/javascript">
$(function() {
  $("#date_input1").date_input();
});
</script>   
  <?php  include_once("resources/fckeditor/fckeditor.php") ; ?> 
 
<form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_news/add_review_done/" enctype="multipart/form-data">
<div class="td-caption-top"> Добавить отзыв на дату <input type="text" value="<?=date("Y-m-d")?>" name="date" id="date_input1"  /> <span style="color:#903; font-size:10px;">Формат даты ГГГГ-мм-дд</span>    
</div>
 <div align="left" class="td-caption-top"> <span> Изображение </span>
 <input type="file" name="img"  />   <span> (превью )</span>
</div>
<div align="left" class="td-caption-top"> <span> Алиас </span>
<input name="url" type="text"  value="" size="100"/>  
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
          <input name="title-rus" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<textarea name="descr-rus" cols="70"  rows="2"></textarea>  
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="kwd-rus" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="h1-rus" type="text"  value="" size="100"/>      
          </div></td>
        </tr> 
        <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-rus" type="text" value="" size="100"/>      
            </div></td>
          </tr>
            <tr>
        <td colspan="2" align="center"><strong> Короткое описание</strong><br>
          <?php 
$oFCKeditor = new FCKeditor('short_text-rus') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  200;
$oFCKeditor->ToolbarSet = 'Custom';
$oFCKeditor->Create() ;
?> 
          </td>
        </tr> 
      <tr>
        <td width="161">&nbsp;</td>
        <td width="629">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 
$oFCKeditor = new FCKeditor('full_text-rus') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
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
          <input name="title-eng" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<textarea name="descr-eng" cols="70"  rows="2"></textarea>    
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="kwd-eng" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="h1-eng" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
        <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-eng" type="text" value="" size="100"/>      
            </div></td>
          </tr>
<!--        <tr>
        <td width="161" class="td-caption">Короткий текст </td>
        <td width="629"><div align="left"> 
<textarea name="short_text-eng" cols="70"  rows="2"></textarea>  
          </div></td>
        </tr> -->
            <tr>
        <td colspan="2" align="center"><strong> Короткое описание</strong><br>
          <?php 
$oFCKeditor = new FCKeditor('short_text-eng') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  200;
$oFCKeditor->ToolbarSet = 'Custom';
$oFCKeditor->Create() ;
?> 
          </td>
        </tr> 
      <tr>
     <tr>
       <td width="161">&nbsp;</td>
       <td width="629">&nbsp;</td>
     </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 
$oFCKeditor = new FCKeditor('full_text-eng') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
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
          <input name="title-ukr" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<textarea name="descr-ukr" cols="70"  rows="2"></textarea>    
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="kwd-ukr" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="h1-ukr" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
        <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-ukr" type="text" value="" size="100"/>      
            </div></td>
          </tr>
<!--        <tr>
        <td width="161" class="td-caption">Короткий текст </td>
        <td width="629"><div align="left"> 
<textarea name="short_text-ukr" cols="70"  rows="2"></textarea>  
          </div></td>
        </tr> -->
            <tr>
        <td colspan="2" align="center"><strong> Короткое описание</strong><br>
          <?php 
$oFCKeditor = new FCKeditor('short_text-ukr') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  200;
$oFCKeditor->ToolbarSet = 'Custom';
$oFCKeditor->Create() ;
?> 
          </td>
        </tr> 
      <tr>
     <tr>
       <td width="161">&nbsp;</td>
       <td width="629">&nbsp;</td>
     </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 
$oFCKeditor = new FCKeditor('full_text-ukr') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
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
          <input name="title-hu" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">DESCR (SEO) </td>
        <td width="629"><div align="left">
<textarea name="descr-hu" cols="70"  rows="2"></textarea>    
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">keywords (SEO)</td>
        <td width="629"><div align="left">
          <input name="kwd-hu" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
      
      <tr>
        <td width="161" class="td-caption">Заголовок</td>
        <td width="629"><div align="left">
          <input name="h1-hu" type="text"  value="" size="100"/>      
          </div></td>
        </tr>
        <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-hu" type="text" value="" size="100"/>      
            </div></td>
          </tr>
<!--        <tr>
        <td width="161" class="td-caption">Короткий текст </td>
        <td width="629"><div align="left"> 
<textarea name="short_text-hu" cols="70"  rows="2"></textarea>  
          </div></td>
        </tr> -->
            <tr>
        <td colspan="2" align="center"><strong> Короткое описание</strong><br>
          <?php 
$oFCKeditor = new FCKeditor('short_text-hu') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  200;
$oFCKeditor->ToolbarSet = 'Custom';
$oFCKeditor->Create() ;
?> 
          </td>
        </tr> 
      <tr>
     <tr>
       <td width="161">&nbsp;</td>
       <td width="629">&nbsp;</td>
     </tr>
      
      <tr>
        <td height="55" colspan="2" align="center">
          <?php 
$oFCKeditor = new FCKeditor('full_text-hu') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  '';
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
          <input name="btn" type="submit" class="button"  value="Добавить" />
 </div>

</form>
