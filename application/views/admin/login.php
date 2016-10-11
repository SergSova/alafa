<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  
<title>Control Panel | Вход в панель управления</title>
<link href="<?php echo base_url();?>media/css/admin/style_admin.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/au.js"></script>

</head>
<body>
<div align="center" class="gen_block">
<div align="center" class="auth-page">
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"> 
      <p align="center"><img src="<?php echo base_url();?>media/css/user/img/alafa.jpg" width="100" align="middle">
      </p>
      <p>&nbsp;</p></td>
  </tr> 
  <tr>
    <td>
     

<form onSubmit="enter_to(this); return false" name="form" id="form_send">
    <table width="500" border="0" cellspacing="0" cellpadding="0" class="form-auth">
      <tr>
        <td colspan="2"></td>
      </tr>
   <tr>
        <td colspan="2" class="auth-header">Авторизация</td>
        </tr> 
      <tr>
        <td><div class="form-auth-login" align="right">Логин:</div></td>
        <td><div class="input-bg"><input type="text" name="username" id="username" value="" size="20"/></div></td>
      </tr>
      <tr>
        <td><div class="form-auth-pass" align="right">Пароль:</div></td>
        <td><div class="input-bg"><input type="password" name="pword" id="pword" value="" size="20"/></div></td>
      </tr>
       <tr>
        <td  colspan="2"align="center">
      <img src= "<?=base_url().'authorization/captha_img/'.rand(0,255)?>" width="150" height="70"> 
       
      <div class="form_field"><input type="text" title="Введите код с картинки" value="" size="25" placeholder="Введите код с картинки" id="captha" name="captchacode"></div> 
      </td>
      </tr>
      
      <tr>
        <td colspan="2"><div id="try_auth_response"></div></td>
      </tr>
      <tr>
        <td colspan="2" align="center"> 
          <input type="submit" class="button" value="Вход"/>
         </td>
        </tr>
    </table>
  </form>
    </td>
  </tr>
</table>
</div>
</div>
</body>
</html>