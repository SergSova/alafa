<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.date_input.js"></script>
<script type="text/javascript">
$(function() { 
  $(".add_date").date_input(); 
});
</script>
<div class="edit_customer">  
<div class="td-caption-top">Редактирование информации о клиенте</div>
  <div id="general">
  <div id="edit_customer_info" class="jGrowl middle-right"> </div>

  <?php if (!empty($customer)): ?>
  <?php foreach($customer as $ui):?> 
  
  
    <form id="edit_customer_form" name="edit_customer_form" method="post" onsubmit="customer_edit(this); return false">
      <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
         <tr>
          <td class="td-caption">Email</td>
          <td class="column"><div align="left">
            <input name="email" type="text"  value="<?php  print ($ui['email']);?>" size="40"/>      
            </div></td>
        </tr>
          
        <tr>
            <td class="td-caption">Фамилия</td>
            <td class="column"><div align="left">
              <input name="surname" type="text"  value="<?php  print ($ui['surname']);?>" size="40"/>      
            </div></td>
          </tr>
          <tr>
            <td class="td-caption">Имя</td>
            <td class="column"><div align="left">
              <input name="name" type="text"  value="<?php  print ($ui['name']);?>" size="40"/>      
            </div></td>
          </tr>
          <tr>
            <td class="td-caption">Отчество</td>
            <td class="column"><div align="left">
              <input name="byfather" type="text"  value="<?php  print ($ui['byfather']);?>" size="40"/>      
            </div></td>
          </tr>
          <tr>
        <td class="td-caption">День рождения</td>
        <td class="column"><div align="left">
        <?php if(!empty($ui['birthday'])){ 
		$birthday = strtotime($ui['birthday']);
		if($ui['birthday']=='2013-01-01' || $ui['birthday'] == '0000-00-00') { 
		
		
		$ui['birthday'] = '0000-00-00';
			$birthday_day = '00';
			$birthday_month = '00';
			$birthday_year = '0000';
			
			//$birthday = strtotime($ui['birthday']);
			
		 } else {
			
			$birthday_day = date("d", $birthday); //echo "day ".$birthday_day.", ";
			$birthday_month = date("m", $birthday); //echo "month ".$birthday_month.", ";
			$birthday_year = date("Y", $birthday);} //echo "year ".$birthday_year;  
			
			 }
		//echo $ui['birthday'];
		
		?>
         <!-- <input type="text" name="ed_birthday" id="date_input1" value="<?php  print ($ui['birthday']);?>"  /> -->
 <select name="birthday_day">
             
          <option value="00" <?php  if (isset($birthday_day) && $birthday_day=='00'){echo ' selected="selected" ';} ?> >День</option> 
            
          <?php for($d=1; $d<=31; $d++ ){ ?>
          <option value="<?php if(strlen($d)==1){$d="0".$d;} echo $d;?>" <?php  if (isset($birthday_day) && $birthday_day==$d){echo '  selected="selected" ';} ?> ><?=$d?></option>
          <?php } ?>
          </select>
            <select name="birthday_month">
            <option value="00" <?php  if (isset($birthday_month) && $birthday_month=='00'){echo ' selected="selected" ';} ?> >Месяц</option> 
          <?php for($m=1; $m<=12; $m++ ){ ?>
          <option value="<?php if(strlen($m)==1){$m="0".$m;} echo $m;?>" <?php  if (isset($birthday_month) && $birthday_month==$m){echo '  selected="selected" ';} ?>><?=$m?></option>
          <?php } ?>
          </select>
            <select name="birthday_year">
            <option value="0000" <?php  if (isset($birthday_year) && $birthday_year=='0000'){echo ' selected="selected" ';} ?> >Год</option> 
          <?php
		  $year=date("Y");
		  for($y=$year; $y>=1930; $y-- ){ ?>
          <option value="<?=$y?>"<?php  if (isset($birthday_year) && $birthday_year==$y){echo '  selected="selected" ';} ?>><?=$y?></option>
          <?php } ?>
          </select>   
         <!--  <span style="color:#903; font-size:10px;">Формат даты ГГГГ-мм-дд</span>    -->
          </div></td>
        </tr>
          <tr>
            <td class="td-caption">Пол</td>
            <td  class="column"><div align="left"> 
              <input name="gender" type="radio" value="male" <?php if($ui['gender']=='male'){echo ' checked="checked" ';}?>/> Мужской 
              <br />
              <input name="gender" type="radio" value="female" <?php if($ui['gender']=='female'){echo ' checked="checked" ';}?>/> Женский
            </div></td>
          </tr>
          
       
        <tr>
          <td class="td-caption">Доступ</td>
          <td class="column"><div align="left">
          <input name="old_pass" type="hidden"  value="<?=$ui['pass']?>" />
         <input type="checkbox" name="change_pass"  onchange="edit_pass()" /> 
         <label for="change_pass">Заменить пароль</label>
         <br><br>
 
         
          <br>
          
          
          <div id="change_pass_div" style="display:none">
  			<input name="newpass" type="text"  value="" size="20"/>Пароль <br>  
            <input name="confirm_newpass" type="text"  value="" size="20"/>Повторите новый пароль 
             <br>     
          </div>
          <hr>
          </div></td>
        </tr>
    
      <tr>
          <td class="td-caption">Адрес</td>
          <td class="column"> 
            
    <div>Город<br> <input name="town" id="town_name" type="text"  value="<?=$ui['town']?>" size="40"/>  
    </div>
    
     Адрес (улица, дом, квартира, офис)
	<div align="left">
      <textarea  name="adres" cols="30" rows="2"><?php  if(isset($ui['u_adres'])) echo $ui['u_adres'];?></textarea>
           </div>
       
           <input name="postindex" type="hidden"  value="<?=$ui['postindex']?>" size="40"/>     
          Телефон  
          <div align="left">
            <input name="phone" type="text"  value="<?=$ui['phone']?>" size="40"/>      
          </div>
          
          Контакты
          <div align="left">
          <textarea  name="contacts" cols="30" rows="2"><?php  if(isset($ui['contacts'])) echo $ui['contacts'];?></textarea>
          </div>
           </td>
        </tr>   
       <tr>
          <td> </td>
          <td><div align="left">
          <input name="id_ed" type="hidden" value="<?php  print ($ui['id']);?>" />
            <input id="button" class="button" type="submit" value="Сохранить изменения">    
          </div></td>
        </tr>  
    
        
      </table>
      
      </form>
 <?php endforeach ?>
 <?php endif ?> 
</div>
