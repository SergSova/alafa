<style type="text/css" xml:space="preserve">
A{font-family: Arial,Verdana,Helvetica, sans-serif;}
B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
.error_strings{ 
font-family:Verdana; 
font-size:11px; 
color:#660000; 
}
</style><script language="JavaScript" src="<?php echo base_url();?>js/gen_validatorv4.js"
    type="text/javascript" xml:space="preserve"></script>
<?php  foreach($email as $a){?>
 <div align="center">

   <!-- Начало области редактирования -->   

<strong>Форма редактирования для  - <br>
<?php  print ($a['target']);?></strong>

<form  method="post" action="<?php echo base_url();?>manage_settings/edit_email_done/" enctype="multipart/form-data"    name="myform" id="myform">
<table width="600" cellpadding="0" cellspacing="0" align="center" class="listtable">
 <tr>
     <td width="161" class="td-caption">Email</td>
      <td class="td-border-bot"><div align="left">
    <!--    <input name="ed_value" type="text"  value="<?php  print ($a['value']);?>" size="60"/> -->
        <textarea name="ed_value" cols="50" rows="3"  ><?php  print ($a['value']);?></textarea>    
      </div></td>
    </tr>
 
  <tr>
    <td> 
      
      
      </td>
    <td>
      <div id='myform_ed_value_errorloc' class="error_strings"></div>

      
      <div align="right">
           <input name="id_ed" type="hidden" value="<?php  print ($a['id']);?>" />
        <input name="btn"  type="submit" class="button"  value="Сохранить изменения" />
        </div></td>
  </tr>
</table>
</form><script language="JavaScript" type="text/javascript"    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("myform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("ed_value","req","Вы не ввели ни одного Email");
//]]></script>

 </div> 
 <!-- Конец области редактирования --> 
<?php } ?>

<div class="noteforadmin">
При заполнении списка адресов электронной почты необходимо использовать следующий синтаксис (перечислить элементы, разделяя их запятой)- 
  <div style="color:#901000; font-style:italic;">info@domain.com, support@domain.com</div>
  В случае неверного заполнения списка адресов отправка писем с сайта может не работать.
</div>
 