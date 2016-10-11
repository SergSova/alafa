 <script language="JavaScript" src="<?php echo base_url();?>js/gen_validatorv4.js"
    type="text/javascript" xml:space="preserve"></script>
 
<script type="text/javascript">
function passempty() {
if(isset(document.getElementById('ed_pass').value)){alert(ed_pass)};
}
</script>
 <div  class="td-caption-top"> Форма редактирования Администратора - <?php  print ($user['fio']);?> </div>
<?php // foreach($user as $a)
if(!empty($user)){?>
   <!-- Начало области редактирования -->   
<form  method="post" action="<?php echo base_url();?>manage_settings/edit_user_done/" enctype="multipart/form-data"    name="myform" id="myform">
<table width="600" cellpadding="0" cellspacing="0" align="center" class="listtable">
 <tr>
     <td width="161" class="td-caption">Имя</td>
      <td class="td-border-bot"><div align="left">
        <input name="ed_fio" type="text"  value="<?php  print ($user['fio']);?>" size="60"/>      
      </div></td>
    </tr>
    <tr>
     <td width="161"  class="td-caption">Логин</td>
      <td class="td-border-bot"><div align="left">
        <input name="ed_login" type="text"  value="<?php  print ($user['login']);?>" size="60"/>      
      </div></td>
    </tr>
     <tr>
     <td width="161" class="td-caption">Пароль</td>
      <td class="td-border-bot"><div align="left">
      <a href="javascript:toggle_show('Q1')"  style="font-size:10px; color:#036;">Изменить пароль</a>
        <div id="Q1" style=" padding-top:10px; display:none">
        <input name="ed_pass" id="ed_pass" type="text" value="" size="60"  onchange="return proverka(this);" />
<script type="text/javascript">
function proverka(input) {
	setTimeout("timer()", 50);
if(input.value.length < 6){
	alert ("Новый пароль должен быть не менее 6 символов!!!"); }
};
</script> 
        </div>     
      </div></td>
    </tr>
 
  <tr>
    <td colspan="2"> 
      <div id='myform_ed_fio_errorloc' class="error_strings"></div>
      <div id='myform_ed_login_errorloc' class="error_strings"></div>
      <div id='myform_ed_pass_errorloc' class="error_strings"></div>
      
      <div align="center">
        <input name="id_ed" type="hidden" value="<?php  print ($user['id']);?>" />
        <input name="btn"  type="submit" class="button"  value="Сохранить изменения" />
      </div></td>
    </tr>
</table>
</form><script language="JavaScript" type="text/javascript"    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("myform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("ed_fio","req","Вы не ввели ФИО");
	frmvalidator.addValidation("ed_login","req","Вы не ввели ЛОГИН");
	

//]]></script>

</div> 
 <!-- Конец области редактирования --> 
<?php } ?>