 
<div align="left">
  <div id="regist_block"> <!--  class="login_form border_rad_5" -->
   
  <div align="center"> <!--  id="register_form" -->
  <div class="login_form_header">
    Регистрация
  </div>
    <form onSubmit="register_to(this); return false" name="form_register" id="form_register">
      <div class="form_field">  
      Имя<br>
        <input type="text" name="name" id="name" title="Имя" placeholder="Имя"  value="" class="singup_inp_lit"/> 
        </div>
      <div class="form_field">
      Фамилия<br>
        <input type="text" name="surname" id="surname" title="Фамилия" value="" placeholder="Фамилия" class="singup_inp_lit"/> 
        </div>
      
      <div class="form_field"> 
      Email<br>
        <input type="text" name="email" id="email" title="email" value="" placeholder="email@domain.com" class="singup_inp_big"/> 
      </div>
      <div class="form_field">
      Пароль<br>
        <input type="text" name="pword" class="passTxt singup_inp_lit" id="pword" placeholder="пароль" title="пароль" value="" /> 
        <div class="form_field">  
        </div> 
        Повторите пароль<br>
        <input type="text" name="re_pword" class="passreTxt singup_inp_lit" id="re_pword" placeholder="Повторите пароль" title="Повторите пароль" value=""  />
      </div>
      <img src= "<?=base_url().'login/captha_img_reg/'.rand(0,255)?>" width="150" height="70">  
      <br> 
      <div class="form_field">Введите символы с каритнки<br><input type="text" title="Введите код с картинки" value="" placeholder="Введите код с картинки" id="captha" name="captchacode"></div> 
      <div id="try_register" align="center"></div>
      
      <div class="form_field_button" id="reg_button_block">
        <div id="reg_button" class="button" align="center">
          <input type="submit" class="style_white_button" value="Зарегистрироваться"/>
        </div>
      </div>
    </form> 
  </div> 
   </div>
 
</div> 

<?php // echo "<pre>"; print_r($this->session->userdata  ); ?>