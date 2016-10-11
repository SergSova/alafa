<script type="text/javascript" src="<?php echo base_url();?>js/login.js"></script>
<div align="center">
  <div class="login_form border_rad_5">  
<form name="remind_form" id="form_remind_pass_send" onSubmit="remind_password(this); return false">
    <table border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
        <td height="40" valign="top" colspan="2"><div class="login_form_header"><?=lang('main_forgot_pass_remind_pass')?></div></td>
        </tr> 
      <tr>
      <td height="30"> <?=lang('main_forgot_pass_enter_email')?>: </td>
        <td><div class="input-bg"><input type="text" name="email" id="username" value="" size="20"/></div></td>
      </tr>
           <tr>
      <td height="30"><?=lang('main_enter_verification_code')?> : </td>
        <td>
       <img src= "<?=base_url().'login/captha_img/'.rand(0,255)?>" width="150" height="70"> 
          <br>
        <div class="input-bg"><input type="text" id="captha" name="captchacode"></div></td>
      </tr>
      <tr>
       <td height="30" colspan="2"> <div id="try_login" align="center"></div></td>
      </tr>
      <tr>
       <td valign="top" colspan="2">
      <div class="auth_button-bg" align="center" >
        <input type="submit" class="style_white_button" value="<?=lang('main_forgot_pass_send')?>"/>
      </div>
      
      </td>
        </tr>
    </table>
  </form>
</div>
</div>