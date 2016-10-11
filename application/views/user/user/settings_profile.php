 <?php  
	$uriki_vid = array(
	"fop"=>  lang('main_user_uriki_vid_sobs_fop') ,
	"pp"=>  lang('main_user_uriki_vid_sobs_pp') ,
	"tov"=>  lang('main_user_uriki_vid_sobs_tov') 
	);         
 
	$nalog_sys = array(
	1=>  lang('main_user_uriki_nalog_sys_1') ,
	2=>  lang('main_user_uriki_nalog_sys_2') ,
    3=>  lang('main_user_uriki_nalog_sys_3') ,
    4=>  lang('main_user_uriki_nalog_sys_4') ,
    5=>  lang('main_user_uriki_nalog_sys_5') ,
	6=>  lang('main_user_uriki_nalog_sys_6') 
	);       
 ?> 
<script type="text/javascript" src="<?php echo base_url();?>js/common_user_profile.js"></script>
 <script type="text/javascript">
 $(function() {
 $(".info_form_box").hide();
 });
</script> 
 
<?php if (isset($user_info) && !empty($user_info)): ?>

<form id="general_data_edit" name="form1" method="post" onsubmit="send_general_settings(this); return false" class="forma_some" >
<table class="uchet" align="center" cellpadding="0" cellspacing="0">
 <tr> <td colspan="2">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ УЧЕТНОЙ ЗАПИСИ</td> </tr>
                    <tr>
                    	<td>Имя:</td>
                        <td><input name="ed_name" type="text"  value="<?php  print ($user_info['name']);?>" size="40" placeholder="Иван" required /> </td>
                    </tr>
                    <tr>
                    	<td>Отчество:</td>
                        <td><input name="ed_byfather" type="text"  value="<?php  print ($user_info['byfather']);?>" size="40" placeholder="Иванович" required /> </td>
                    </tr>
                    <tr>
                    	<td>Фамилия:</td>
                        <td><input name="ed_surname" type="text"  value="<?php  print ($user_info['surname']);?>" size="40"  placeholder="Иванов"  required /> </td>
                    </tr>
                    <tr>
                    	<td>E-mail:</td>
                        <td><?php  print ($user_info['email']);?></td>
                    </tr>
                    <tr>
                    	<td>Мобильный телефон: </td>
                        <td><input name="ed_phone" type="text"  value="<?php  print ($user_info['phone']);?>" size="40" placeholder="380681112233"  required /></td>
                    </tr>
                   <?php /*?> <tr>
                    	<td>ИНН: </td>
                        <td><?php if(empty($user_info['inn'])) { ?><input name="inn" type="text"  value="<?php  print ($user_info['inn']);?>" size="40" placeholder="inn"  required /> <?php } else { echo $user_info['inn'] ;}?></td>
                    </tr><?php */?>
                    <tr>
                    	<td>&nbsp;  </td>
                        <td>&nbsp; </td>
                    </tr>
                    <tr>
                    	<td>Код получателя в системе <a href="http://wallet.advcash.com/referral/3b959503-84d7-47cd-abb4-c6d28494274b" target="_blank">ADV Cash*</a><br>
                        <a href="http://wallet.advcash.com/referral/3b959503-84d7-47cd-abb4-c6d28494274b" target="_blank"><img src="/media/images/promo_ru/paylogo.gif" width="120" /></a>
                        </td>
                        <td><?php if(empty($user_info['adv_uid'])) { ?><input name="adv_uid" type="text"  value="<?php  print ($user_info['adv_uid']);?>" size="40" placeholder=""  required /><?php } else { echo $user_info['adv_uid'] ;}?></td>
                    </tr>
                    
                    
                    <tr>
                    	<td>&nbsp;  </td>
                        <td>&nbsp; </td>
                    </tr>
                    <tr>
                    	<td>Страна:</td>
                        <td><?php if(empty($user_info['country'])) { ?><input name="country" type="text"  value="<?php  print ($user_info['country']);?>" size="40"/><?php } else { echo $user_info['country'] ;}?> </td>
                    </tr>
                    <tr>
                    	<td>Город:</td>
                        <td><?php if(empty($user_info['town'])) { ?><input name="town" type="text"  value="<?php  print ($user_info['town']);?>" size="40"/><?php } else { echo $user_info['town'] ;}?> </td>
                    </tr>
                    <tr>
                    	<td>Адрес:</td>
                        <td><?php if(empty($user_info['adres'])) { ?><input name="adres" type="text"  value="<?php  print ($user_info['adres']);?>" size="40"/><?php } else { echo $user_info['adres'] ;}?> </td>
                    </tr>
                     
                     
                    
                    <tr>
                    	<td colspan="2">
                      <div id="general_edit_response" class="info_form_box" align="center"></div>  
                         <div align="center"> 
                            <input  class="bottom" type="submit" value="Сохранить"> 
                         </div> 
                         
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">&nbsp; </td>
                    </tr>
                    <tr>
                    	<td colspan="2">&nbsp; </td>
                    </tr>
                </table>
</form>

 
  <div id="access">  
    <table class="uchet" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>Электронная почта (логин)</td>
        <td><div align="left">
          <?php  print ($user_info['email']);?>
          </div></td>
        </tr> 
        <tr>
        <td colspan="2"> 
          
       </td>
        </tr>
      </table>
 
        
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
        <tr>
        <td colspan="2">
        <div id="pass_edit_response" class="info_form_box"></div>
      <div align="center">
 		 <input id="button" class="style_white_button" type="submit" value="Сохранить"> 
      </div>
      </td>
        </tr> 
      </table>
      
  </form>
      </div> 
      
 
  

<!--
 <table class="uchet">
 <tr> <td colspan="2">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ УЧЕТНОЙ ЗАПИСИ</td> </tr>
                    <tr>
                    	<td>Имя:</td>
                        <td><?=$user_info['name']?></td>
                    </tr>
                    <tr>
                    	<td>Фамилия:</td>
                        <td><?=$user_info['surname']?></td>
                    </tr>
                    <tr>
                    	<td>E-mail:</td>
                        <td><?=$user_info['email']?></td>
                    </tr>
                    <tr>
                    	<td>Телефон: </td>
                        <td><?=$user_info['phone']?></td>
                    </tr>
                    <tr>
                    	<td>Город:</td>
                        <td><?=$user_info['town']?></td>
                    </tr>
                </table>-->
 
  <div id="lang_hidden" style="display:none;"><?=lang('main_lang')?></div>  
 
 <?php endif ?> 