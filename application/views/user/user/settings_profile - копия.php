 
<script type="text/javascript" src="<?php echo base_url();?>js/common_user_profile.js"></script>
 <script type="text/javascript">
 $(function() {
 $(".info").hide();
 });
</script> 
<script src="/js/phone/jquery.inputmask.js" type="text/javascript"></script>
<script src="/js/phone/jquery.bind-first-0.1.min.js" type="text/javascript"></script>
<script src="/js/phone/jquery.inputmask-multi.js" type="text/javascript"></script>
                       
 
<?php if (!empty($user_info)): ?>
<!--  <div id="lang_hidden" style="display:none;"><?=lang('main_lang')?></div> -->
  <fieldset id="profile_info"> <legend> Данные профиля </legend>

  <?php foreach($user_info as $ui):?>  
  <div class="tab_field" align="center">
  <!-- ----------------------------------------------------- -->
    <div align="left">  
  <fieldset class="field_data"><legend>Общие данные</legend>    
      <div id="general_tab">  
        <form id="general_data_edit" name="form1" method="post" onsubmit="send_general_settings(this); return false">
          <table border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
              <td>Фамилия</td>
              <td><div align="left">
                <input name="ed_surname" type="text"  value="<?php  print ($ui['surname']);?>" size="40"/>      
              </div></td>
            </tr>
            <tr>
              <td>Имя</td>
              <td><div align="left">
                <input name="ed_name" type="text"  value="<?php  print ($ui['name']);?>" size="40"/>      
              </div></td>
            </tr>
            <tr>
              <td>Отчество</td>
              <td><div align="left">
                <input name="ed_byfather" type="text"  value="<?php  print ($ui['byfather']);?>" size="40"/>      
              </div></td>
            </tr>
            <tr>
              <td>Дата рождения</td>
              <td><div align="left">
                <?php if(!empty($ui['birthday']) && $ui['birthday'] != '0000-00-00'){ 
				$birthday = strtotime($ui['birthday']);
				if($ui['birthday']=='2013-01-01') { 
				
				$ui['birthday'] = '0000-00-00';
				$birthday_day = '00';
				$birthday_month = '00';
				$birthday_year = '0000';
				
				//$birthday = strtotime($ui['birthday']);
				
			 } else {
				
				$birthday_day = date("d", $birthday); //echo "day ".$birthday_day.", ";
				$birthday_month = date("m", $birthday); //echo "month ".$birthday_month.", ";
				$birthday_year = date("Y", $birthday);  //echo "year ".$birthday_year;  
				
				echo "<b>".$ui['birthday']."</b>";
				
				 }
				 
				 } else {  
		/*$birthday = strtotime($ui['birthday']);
		$birthday_day = date("d", $birthday); 
		$birthday_month = date("m", $birthday); 
		$birthday_year = date("Y", $birthday);}  
        */ ?>       
                <select name="birthday_day">
                <option value="00" <?php  if (isset($birthday_day) && $birthday_day=='00'){echo ' selected="selected" ';} ?> >День</option> 
                  <?php for($d=1; $d<=31; $d++ ){ ?>
                  <option value="<?php if(strlen($d)==1){$d="0".$d;} echo $d;?>"><?=$d?></option>
                  <?php } ?>
                  </select>
                <select name="birthday_month">
                <option value="00" <?php  if (isset($birthday_month) && $birthday_month=='00'){echo ' selected="selected" ';} ?> >Месяц</option> 
                  <?php for($m=1; $m<=12; $m++ ){ ?>
                  <option value="<?php if(strlen($m)==1){$m="0".$m;} echo $m;?>"><?=$m?></option>
                  <?php } ?>
                  </select>
                <select name="birthday_year">
                <option value="0000" <?php  if (isset($birthday_year) && $birthday_year=='0000'){echo ' selected="selected" ';} ?> >Год</option> 
                  <?php
		  $year=date("Y");
		  for($y=$year; $y>=1930; $y-- ){ ?>
                  <option value="<?=$y?>"><?=$y?></option>
                  <?php } ?>
                  </select>   
             <?php } ?>   
              </div>
               </td>
            </tr>
            <tr>
              <td>Пол</td>
              <td><div align="left"> 
               <input name="gender" type="radio" value="male" <?php if($ui['gender']=='male'){echo ' checked="checked" ';}?>/>Мужской 
                <br />
               <input name="gender" type="radio" value="female" <?php if($ui['gender']=='female'){echo ' checked="checked" ';}?>/>Женский 
              </div></td>
            </tr> 
          </table>
          <div align="center">
  			<input id="button" class="style_white_button" type="submit" value="Сохранить"> 
     		  </div>
 		 <div id="general_edit_response" class="info"></div>
        </form>
        
        </div> 
     </fieldset>
    
    <fieldset class="field_data"><legend>Адрес и контакты </legend>    
      <div align="left">  
        <i>На данный момент актуальны:</i><br>
        <div class="text_b">
          <?php  if(isset($ui['town'])) {?><span> Город:</span> <?=$ui['town']?><br> <?php }?>
          <?php  if(isset($ui['adres'])) {?><span> Адрес:</span> <?=$ui['adres']?><br> <?php }?>
          <?php  if(isset($ui['phone_mob'])) {?><span> Контактный телефон для отправки SMS:</span> <?=$ui['phone_mob']?><br> <?php }?>
        </div>         
        
        <div onclick="toggle_show('change_adres')" class="add_link func_button">Отредактировать</div>
        <div id="change_adres" style="display:none">
          <form id="adres_data_edit" name="form6" method="post" onsubmit="send_data_edit_adres(this); return false"> 
              Город<div align="left">
              <input name="town" id="town_name" size="40" value="<?php  if(isset($ui['town'])) { echo $ui['town']; }?> " />
              </div> 
              Адрес (для доставок)<div align="left">
              <textarea  name="adres" cols="30" rows="2"><?php  if(isset($ui['adres'])) { echo $ui['adres']; }?></textarea>
              </div> 
               Контактный телефон <div align="left">
               <?php  print ($ui['phone_mob']);?><br><br>
               
             <!-- <input name="ed_phone" type="text"  value="<?php  print ($ui['phone_mob']);?>" size="40"/>  -->
             <div style="border:1px solid #069; padding:10px;">
<div class="hidden">
  <input type="checkbox" name="mode" id="is_world" value="world" checked>
  <label for="is_world">Страны мира</label>
  <input type="radio" name="mode" id="is_russia" value="ru"><label for="is_russia">Города России</label><br> 
</div>
<input type="text" name="phone_mob" id="customer_phone" value="<?php if(isset($ui['phone']) && strlen($ui['phone'])>10) {echo $ui['phone'];} else {echo "380";} ?>" size="25"><br>
               <span class="hidden"> <input type="checkbox" id="phone_mask" checked> </span><label id="descr" for="phone_mask">Введите номер мобильного телефона</label>
                <script type="text/javascript">
                            var maskList = $.masksSort($.masksLoad("/js/phone/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
                            var maskOpts = {
                                inputmask: {
                                    definitions: {
                                        '#': {
                                            validator: "[0-9]",
                                            cardinality: 1
                                        }
                                    },
                                    //clearIncomplete: true,
                                    showMaskOnHover: false,
                                    autoUnmask: true
                                },
                                match: /[0-9]/,
                                replace: '#',
                                list: maskList,
                                listKey: "mask",
                                onMaskChange: function(maskObj, determined) {
                                    if (determined) {
                                        var hint = maskObj.name_ru;
                                        if (maskObj.desc_ru && maskObj.desc_ru != "") {
                                            hint += " (" + maskObj.desc_ru + ")";
                                        }
                                        //$("#descr").html(hint);
                                    } else {
                                        //$("#descr").html("Маска ввода");
                                    }
                                    $(this).attr("placeholder", $(this).inputmask("getemptymask"));
                                }
                            };

                            var listRU = $.masksSort($.masksLoad("/js/phone/phones-ru.json"), ['#'], /[0-9]|#/, "mask");
                            var optsRU = {
                                inputmask: {
                                    definitions: {
                                        '#': {
                                            validator: "[0-9]",
                                            cardinality: 1
                                        }
                                    },
                                    //clearIncomplete: true,
                                    showMaskOnHover: false,
                                    autoUnmask: true
                                },
                                match: /[0-9]/,
                                replace: '#',
                                list: listRU,
                                listKey: "mask",
                                onMaskChange: function(maskObj, determined) {
                                    if (determined) {
                                        if (maskObj.type != "mobile") {
                                            $("#descr").html(maskObj.city.toString() + " (" + maskObj.region.toString() + ")");
                                        } else {
                                            $("#descr").html("мобильные");
                                        }
                                    } else {
                                        $("#descr").html("Маска ввода");
                                    }
                                    $(this).attr("placeholder", $(this).inputmask("getemptymask"));
                                }
                            };
							//////////////////////////////

                           $('#phone_mask, input[name="mode"]').change(function() {
                               if ($('#phone_mask').is(':checked')) {
                                    if ($('#is_world').is(':checked')) {
                                        $('#customer_phone').inputmasks(maskOpts);
                                    } else {
                                        $('#customer_phone').inputmasks(optsRU);
                                    }
                                } else {
                                    $('#customer_phone').inputmask("+[####################]", maskOpts.inputmask)
                                    .attr("placeholder", $('#customer_phone').inputmask("getemptymask"));
                                    $("#descr").html("Маска ввода");
                                }
                            });
							//////////////////// 
                            $('#phone_mask').change();
                        </script>
             </div>
              <br>
              </div> 
            
           <div id="adres_edit_response" class="info"></div>
            
             <div align="center">
  			<input id="button" class="style_white_button" type="submit" value="Сохранить"> 
     		  </div>
            
          </form>
        </div>
 
      </div>
       </fieldset>
    
    <fieldset class="field_data"><legend>Доступ </legend>   
  
  <div id="access"> 
  <form id="access_data_email_edit" name="form3" method="post" onsubmit="send_access_email_settings(this); return false">
    <table border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td>Электронная почта</td>
        <td><div align="left">
          <input name="ed_email" type="text"  value="<?php  print ($ui['email']);?>" size="40"/>      
          </div></td>
        </tr> 
      </table>
       <div id="email_edit_response" class="info"></div>
       <div align="center">
  			<input id="button" class="style_white_button" type="submit" value="Сохранить"> 
       </div>
  </form>
        
  <form id="access_data_pass_edit" name="form4" method="post" onsubmit="send_access_pass_settings(this); return false">
    <table border="0" cellpadding="0" cellspacing="0" align="center"> 
      
      <tr>
        <td>Пароль</td>
        <td><div align="left">
          <input name="newpass" type="password"  value="" size="40"/>      
          </div></td>
        </tr>
      <tr>
        <td>Повторить пароль</td>
        <td><div align="left">
          <input name="confirm_newpass" type="password"  value="" size="40"/>      
          </div></td>
        </tr> 
      </table>
      <div id="pass_edit_response" class="info"></div>
      <div align="center">
 		 <input id="button" class="style_white_button" type="submit" value="Сохранить"> 
      </div>
  </form>
      </div> 
      
 
      
      
      </fieldset>
      
  <fieldset class="field_data"><legend>Рассылка от магазина </legend>        
      <form id="subscr_edit" name="form3" method="post" onsubmit="send_subscr_settings(this); return false">
    <table border="0" cellpadding="0" cellspacing="0" align="center">
      <tr> 
        <td><div align="left"> 
          <label> <input name="subscr" type="checkbox" value="1" <?php if($ui['subscr']=='1') {echo " checked";} ?> />Я согласен получать рассылку от интернет-магазина</label>
          </div></td>
        </tr> 
      </table>
       <div id="subscr_edit_response" class="info"></div>
       <div align="center">
  			<input id="button" class="style_white_button" type="submit" value="Сохранить"> 
       </div>
  </form>
   </fieldset>    
    </div>
     
  </div> 
<?php endforeach ?>
  </fieldset>
 <?php endif ?> 