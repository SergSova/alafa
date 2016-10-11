<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
<div class="add_customer">  
<div class="td-caption-top">Добавить клиента</div>
  <div id="general" >
  <div id="add_customer_info" class="jGrowl middle-right"> </div>
    <form id="add_customer_form" name="form1" method="post" onsubmit="customer_add(this); return false">
      <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
        <tr>
          <td class="td-caption">Email</td>
          <td class="column"><div align="left">
            <input name="email" type="text"  value="" size="40"/>      
            </div></td>
        </tr>
        
        <tr>
          <td class="td-caption">Фамилия</td>
          <td class="column"><div align="left">
            <input name="surname" type="text"  value="" size="40"/>      
          </div></td>
        </tr>
        <tr>
          <td class="td-caption">Имя</td>
          <td class="column"><div align="left">
            <input name="name" type="text"  value="" size="40"/>      
          </div></td>
        </tr>
        <tr>
          <td class="td-caption">Отчество</td>
          <td class="column"><div align="left">
            <input name="byfather" type="text"  value="" size="40"/>      
          </div></td>
        </tr>
         
        <tr>
          <td class="td-caption">День рождения</td>
          <td class="column"><div align="left">
            
            <select name="birthday_day">
              <?php for($d=1; $d<=31; $d++ ){ ?>
              <option value="<?php if(strlen($d)==1){$d="0".$d;} echo $d;?>" ><?=$d?></option>
              <?php } ?>
              </select>
            <select name="birthday_month">
              <?php for($m=1; $m<=12; $m++ ){ ?>
              <option value="<?php if(strlen($m)==1){$m="0".$m;} echo $m;?>"><?=$m?></option>
              <?php } ?>
              </select>
            <select name="birthday_year">
              <?php
		  $year=date("Y");
		  for($y=$year; $y>=1930; $y-- ){ ?>
              <option value="<?=$y?>" ><?=$y?></option>
              <?php } ?>
              </select>   
           
          </div></td>
        </tr>
        <tr>
          <td class="td-caption">Пол</td>
          <td class="column"><div align="left"> 
           <label> <input name="gender" type="radio" value="male"  /> Мужской </label>
            <br />
            <label><input name="gender" type="radio" value="female" /> Женский </label>
          </div></td>
        </tr> 
        <tr>
          <td class="td-caption">Пароль</td>
          <td class="column"><div align="left">
            <input name="newpass" type="text"  value="" size="40"/>      
          </div></td>
        </tr>
        <tr>
          <td class="td-caption">Повторите новый пароль</td>
          <td class="column"><div align="left">
            <input name="confirm_newpass" type="text"  value="" size="40"/>      
          </div></td>
        </tr>
      <tr>
          <td class="td-caption">Адрес</td>
          <td class="column"> 
    Адрес (улица, дом, квартира, офис) <div align="left">
      <textarea  name="adres" cols="30" rows="2"></textarea>
           
           
          </div>
          Почтовый Индекс 
          <div align="left">
            <input name="postindex" type="text"  value="" size="40"/>      
          </div>
          Телефон 
          <div align="left">
            <input name="phone" type="text"  value="" size="40"/>      
          </div>
          </td>
        </tr>   
       <tr>
          <td class="td-caption"><!--<div id='info'></div> --></td>
          <td><div align="left">
            <input id="button" class="button"  type="submit" value="Добавить в базу клиентов">    
          </div></td>
        </tr>  
    
        
      </table>
      
      </form>
 
</div>
