<style type="text/css" xml:space="preserve">
A{font-family: Arial,Verdana,Helvetica, sans-serif;}
B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
.error_strings{ 
font-family:Verdana; 
font-size:11px; 
color:#660000; 
/*background-color:#ff0;*/}
</style><script language="JavaScript" src="<?php echo base_url();?>js/gen_validatorv4.js"
    type="text/javascript" xml:space="preserve"></script>
<div class="td-caption-top">Добавить администратора</div>
<br>

<form  action="<?php echo base_url();?>manage_settings/add_admintolist" method="post" enctype="multipart/form-data"   name="myform" id="myform" >          <!--  onsubmit = "return checkform(this)" -->
<table width="600" align="center" class="listtable" cellpadding="0" cellspacing="0">
     <tr>
       <td width="188" class="td-caption">Имя</td>
       <td><div align="left">
         <input name="fio" id="Имя" type="text" value="" size="60"  />      
       </div></td>
    </tr>
    <tr>
      <td width="188" class="td-caption">Логин</td>
      <td><div align="left">
        <input name="login" id="Логин" type="text" value="" size="60" />      
      </div></td>
    </tr>
   
   <tr>
	   <td width="188" class="td-caption">Пароль</td>
	   <td><div align="left">
	    <input name="password" id="Пароль" type="text" value="" size="60" /> 
	   </div></td>
    </tr>
    
   <tr>
     <td width="188" class="td-caption"></td>
     <td>      <div align="left">
       <div id='myform_fio_errorloc' class="error_strings"></div>
       <div id='myform_login_errorloc' class="error_strings"></div>
       <div id='myform_password_errorloc' class="error_strings"></div>
      </div></td>
   </tr>
   <tr>
     <td width="188" class="td-caption">&nbsp;</td>
      <td class="td-caption"> <div align="left">
          <input name="btn"  type="submit" class="button"  value="Добавить" />      
      </div></td>
    </tr>
</table>
</form><script language="JavaScript" type="text/javascript"    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("myform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    
	frmvalidator.addValidation("fio","req","Вы не ввели ФИО");
	frmvalidator.addValidation("login","req","Вы не ввели ЛОГИН");
	frmvalidator.addValidation("password","req","Вы не ввели пароль");
	frmvalidator.addValidation("password","minlen=6","Пароль должен быть не менее 6 символов");
//]]></script>