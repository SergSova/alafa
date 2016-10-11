<div class="td-caption-top">Шаблон квитанции</div>
  <?php  include_once("resources/fckeditor/fckeditor.php") ;

   if (!empty($order_template)): ?>
   <?php foreach($order_template as $a):?> 

<form id="form1" name="form1" method="post" action="<?php echo base_url();?>manage_settings/edit_order_template_done/">

<!-- ----------------------------------------------------- -->
<div class="section">
	<ul class="tabs">
		<li class="current"><img src="../../../media/css/user/img/flag-ru.png" width="23" height="18" /> Русский</li>
		<li><img src="../../../media/css/user/img/flag-eng.png" width="23" height="18" /> English</li>
        <li><img src="/media/flags/ukraine.png" width="23" height="18" /> Українська</li>
	</ul>
	<div class="box visible">
    <!-- RUS begin ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
	<table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      <tr>
        
        <td class="td-caption"><div align="left">
          <?=$a['name-rus']?>    
          </div></td>
        </tr>
      
      <tr>
        <td  align="center">
          <?php 
			
			$oFCKeditor = new FCKeditor('ed_text-rus') ;
			$oFCKeditor->BasePath = "/resources/fckeditor/" ;
			$oFCKeditor->Value =  $a['text-rus'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  500;
			$oFCKeditor->Create() ;
			
			?> 
          </td>
        </tr>
      </table>
    <!-- RUS end ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	</div>

	<div class="box">
    
    <!-- ENG begin ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	 <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      <tr>
        
        <td class="td-caption"><div align="left">
          <?=$a['name-eng']?>    
          </div></td>
        </tr>
      
      <tr>
        <td  align="center">
          <?php 
			
			$oFCKeditor = new FCKeditor('ed_text-eng') ;
			$oFCKeditor->BasePath = "/resources/fckeditor/" ;
			$oFCKeditor->Value =  $a['text-eng'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  500;
			$oFCKeditor->Create() ;
			
			?> 
          </td>
        </tr>
      </table>
    <!-- ENG end ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	</div>
    <div class="box">
    
    <!-- ukr begin ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	 <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      <tr>
        
        <td class="td-caption"><div align="left">
          <?=$a['name-ukr']?>    
          </div></td>
        </tr>
      
      <tr>
        <td  align="center">
          <?php 
			
			$oFCKeditor = new FCKeditor('ed_text-ukr') ;
			$oFCKeditor->BasePath = "/resources/fckeditor/" ;
			$oFCKeditor->Value =  $a['text-ukr'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  500;
			$oFCKeditor->Create() ;
			
			?> 
          </td>
        </tr>
      </table>
    <!-- ukr end ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	</div>
    
</div>
<!-- ----------------------------------------------------- -->
 

<div align="center">
          <input name="btn"  type="submit" class="button"  value="Изменить" />
 </div>
<input name="id_ed" type="hidden" value="<?php  print ($a['id']);?>" />
</form>
<?php endforeach ?>
 <?php endif ?> 
 
 <table width="400" border="1" cellspacing="0" cellpadding="1" class="listtable">
  <tr>
    <th>Что заменить </th>
    <th>На что заменить</th>
  </tr>
  <tr>
    <td class="column">#id_order#</td>
    <td class="column">Номер заказа</td>
  </tr> 
  <tr>
    <td class="column">#id_user#</td>
    <td class="column">Ид. пользователя</td>
  </tr>
  <tr>
    <td class="column">#date_order#</td>
    <td class="column">Дата заказа</td>
  </tr>
  <tr>
    <td class="column">#name#</td>
    <td class="column">Имя пользователя</td>
  </tr>
  <tr>
    <td class="column">#surname# </td>
    <td class="column">Фамилия  пользователя</td>
  </tr>
  <tr>
    <td class="column">#byfather#</td>
    <td class="column">Отчество пользователя</td>
  </tr>
 
  <tr>
    <td class="column">#town#</td>
    <td class="column">Город</td>
  </tr>
  <tr>
    <td class="column"> #level_name#</td>
    <td class="column">Название уровня</td>
  </tr>
  <tr>
    <td class="column">#level_шв#</td>
    <td class="column">Номер уровня</td>
  </tr>
  <tr>
    <td class="column">#email# </td>
    <td class="column">Имейл</td>
  </tr>
  <tr>
    <td class="column">#phone#</td>
    <td class="column">Телефон</td>
  </tr>
  <tr>
    <td class="column">#note#</td>
    <td class="column">Примечание</td>
  </tr>
 
  <tr>
    <td class="column">#total_sum_to_pay#</td>
    <td class="column">Сумма к оплате</td>
  </tr>   
</table>
