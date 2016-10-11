 
<div align="center">
  <div class="login_form border_rad_5">
  <div class="login_form_header"> Войти на сайт </div>
  <form onSubmit="login_to(this); return false" name="form_login" id="form_login">
   <div class="form_field">  
   Email<br>
     <input type="text" name="username" id="username" title="email@domain.com" onblur="if (this.value == '') {this.value = 'email@domain.com';}"
onfocus="if(this.value == 'email@domain.com') {this.value = '';}" value="email@domain.com" autocomplete="on"  placeholder="email@domain.com" class="singup_inp_lit"/>
   </div><div class="form_field">  Пароль<br>
     <input type="password" name="pword" id="pword" title="пароль"  onblur="if (this.value == '') {this.value = 'пароль';}"
onfocus="if(this.value == 'пароль') {this.value = '';}" value="пароль" placeholder="пароль" class="singup_inp_lit" />
      
   </div>
   
  <div id="try_login" align="center"></div>
  
  <div class="form_field_button" id="login_button_block">
    <div id="login_button" class="button">
      <input type="submit" class="style_white_button" value="Войти"/>
    </div>
  </div> 
   </form>
     <div class="ind_links"><a href="/login/register" >Регистрация</a>
     <!-- <a href="javascript:void(0);" onclick="singup_form_open();" >Регистрация</a> -->
     <span class="separator"> | </span>
     <a href="javascript:void(0);" onclick="login_forgot_pass();" >Забыли пароль?</a></div>  
   
   </div>
  <div id="remind_pass_form"> 
  
    <div class="border_rad_5">  
    <div class="login_form_header"> Войти на сайт </div>
  <form name="remind_form" id="form_remind_pass_send" onSubmit="remind_password(this); return false">
    Ваш email:
    <div class="form_field"> <input type="text" name="email" id="username" value="" size="20"/></div>
    Введите код с картинки :<br> 
    
         <img src= "<?=base_url().'login/captha_img_remind_pass/'.rand(0,255)?>" width="150" height="70"> 
         <br>
         <div class="form_field"> <input type="text" id="captha" name="captchacode"></div> 
         <div id="try_remind" align="center"></div>
         
      <div class="auth_button-bg button" align="center" >
        <input type="submit" class="style_white_button" value="Отправить"/>
      </div>
  </form>
</div>
  
  
   
  </div>
</div> 