<script type="text/javascript" src="<?php echo base_url();?>js/jquery.date_input.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script>
<script type="text/javascript">
$(function() {
  $("#date_input1").date_input();
});
</script>
<div>
  <div class="td-caption-top">Редактирование отзыва </div>
  <?php
  include_once("resources/fckeditor/fckeditor.php") ;

   if (!empty($review)): ?>
  <?php foreach($review as $a):?> 
  
  <form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_news/edit_review_done/" enctype="multipart/form-data">
    
    <div class="td-caption" style="margin-top:10px; padding-top:5px;"><strong>Дата отзыва </strong><input type="text" name="ed_date" id="date_input1" value="<?php  print ($a['date']);?>"  /> <span style="color:#903; font-size:10px;">Формат даты ГГГГ-мм-дд</span>    </div>
    <div id="new_id" style="display:none;"><?php echo $a['id']; ?></div>
 
   <div class="td-caption-top"> <span> Фото </span>
 <?php if(isset($a['thumb']) && !empty($a['thumb'])) { ?> 
         <img src="<?php echo base_url().$a['thumb'];?>" height="30"   border="0" /> 
        <?php  } else { ?>
         <img src="<?php echo base_url();?>media/images/empty_screen.png" height="30"  border="0" />
 <?php }?> 
   <?php /* if($a['preview']!='') { ?><img  src="<?php echo base_url().''.$a['preview'];?>" height="30"  > <?php } */ ?> 
        <input name="old_preview" type="hidden" value="<?php  echo $a['thumb'];?>" /> 
       <a href="#" onclick="toggle_show('edit_photo')">Заменить изображение</a><br>
      <div id="edit_photo" style="display:none"> 
        <div align="left">
          <input type="file" name="img" id="Фото" />      
        </div>  
      </div> 
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
              <input name="ed_title-rus" type="text"  value='<?php  print ($a['title-rus']);?>' size="100"/>      
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
              <input name="ed_kwd-rus" type="text"  value='<?php  print ($a['kwd-rus']);?>' size="100"/>      
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">Заголовок</td>
            <td width="629"><div align="left">
              <input name="ed_h1-rus" type="text"  value='<?php  print ($a['h1-rus']);?>' size="100"/>      
            </div></td>
          </tr>
          <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-rus" type="text"  value='<?php  print ($a['menu_name-rus']);?>' size="100"/>      
            </div></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> <strong>Короткое описание</strong><br>
              <?php 
			$oFCKeditor = new FCKeditor('ed_short_text-rus');
			$oFCKeditor->BasePath = "/resources/fckeditor/";
			$oFCKeditor->Value =  $a['short_text-rus'];
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
              <input name="ed_title-eng" type="text"  value='<?php  print ($a['title-eng']);?>' size="100"/>      
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">DESCR (SEO) </td>
            <td width="629"><div align="left"> 
              <textarea name="ed_descr-eng" cols="70"  rows="2"><?php  print ($a['descr-eng']);?></textarea>    
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">keywords (SEO)</td>
            <td width="629"><div align="left">
              <input name="ed_kwd-eng" type="text" value='<?php  print ($a['kwd-eng']);?>' size="100"/>      
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">Заголовок</td>
            <td width="629"><div align="left">
              <input name="ed_h1-eng" type="text" value='<?php  print ($a['h1-eng']);?>' size="100"/>      
            </div></td>
          </tr>
          <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-eng" type="text" value="<?php  print ($a['menu_name-eng']);?>" size="100"/>      
            </div></td>
          </tr>
         
          <tr>
            <td colspan="2" align="center"> <strong>Короткое описание</strong><br>
              <?php 
			$oFCKeditor = new FCKeditor('ed_short_text-eng');
			$oFCKeditor->BasePath = "/resources/fckeditor/";
			$oFCKeditor->Value =  $a['short_text-eng'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  200;
			$oFCKeditor->ToolbarSet = 'Custom';
			$oFCKeditor->Create() ;
			?> 
            </td>
          </tr>     
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
              <input name="ed_title-ukr" type="text"  value='<?php  print ($a['title-ukr']);?>' size="100"/>      
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">DESCR (SEO) </td>
            <td width="629"><div align="left"> 
              <textarea name="ed_descr-ukr" cols="70"  rows="2"><?php  print ($a['descr-ukr']);?></textarea>    
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">keywords (SEO)</td>
            <td width="629"><div align="left">
              <input name="ed_kwd-ukr" type="text" value='<?php  print ($a['kwd-ukr']);?>' size="100"/>      
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">Заголовок</td>
            <td width="629"><div align="left">
              <input name="ed_h1-ukr" type="text" value='<?php  print ($a['h1-ukr']);?>' size="100"/>      
            </div></td>
          </tr>
          <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-ukr" type="text" value='<?php  print ($a['menu_name-ukr']);?>' size="100"/>      
            </div></td>
          </tr>
         
          <tr>
            <td colspan="2" align="center"> <strong>Короткое описание</strong><br>
              <?php 
			$oFCKeditor = new FCKeditor('ed_short_text-ukr');
			$oFCKeditor->BasePath = "/resources/fckeditor/";
			$oFCKeditor->Value =  $a['short_text-ukr'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  200;
			$oFCKeditor->ToolbarSet = 'Custom';
			$oFCKeditor->Create() ;
			?> 
            </td>
          </tr>     
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
              <input name="ed_title-hu" type="text"  value='<?php  print ($a['title-hu']);?>' size="100"/>      
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
              <input name="ed_kwd-hu" type="text" value='<?php  print ($a['kwd-hu']);?>' size="100"/>      
            </div></td>
          </tr>
          
          <tr>
            <td width="161" class="td-caption">Заголовок</td>
            <td width="629"><div align="left">
              <input name="ed_h1-hu" type="text" value='<?php  print ($a['h1-hu']);?>' size="100"/>      
            </div></td>
          </tr>
          <tr>
            <td width="161" class="td-caption">Название в меню</td>
            <td width="629"><div align="left">
              <input name="menu_name-hu" type="text" value='<?php  print ($a['menu_name-hu']);?>' size="100"/>      
            </div></td>
          </tr>
         
          <tr>
            <td colspan="2" align="center"> <strong>Короткое описание</strong><br>
              <?php 
			$oFCKeditor = new FCKeditor('ed_short_text-hu');
			$oFCKeditor->BasePath = "/resources/fckeditor/";
			$oFCKeditor->Value =  $a['short_text-hu'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  200;
			$oFCKeditor->ToolbarSet = 'Custom';
			$oFCKeditor->Create() ;
			?> 
            </td>
          </tr>     
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
  
  <div id="objects_links"> 
    <?php // $this->load->view('admin/news/news_objects_links');?>  
    </div>
</div>
