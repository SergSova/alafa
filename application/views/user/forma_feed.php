<script type="text/javascript" src="<?php echo base_url();?>js/feed.js"></script>
<div align="center" class="feed_form">
 <form  method="post" action="<?php echo base_url();?><?=lang('main_lang')?>/page/feed/" enctype="multipart/form-data" name="myform" id="myform">
  <table cellpadding="0" cellspacing="0" class="form" align="center">
    <tr>
      <td width="220" valign="middle" ><?=lang('main_feed_form_name')?>*</td>
      <td valign="middle"><input name="fio" type="text" value="" size="40"  /></td>
      </tr>
    <tr>
      <td  valign="middle"> <?=lang('main_feed_form_phone')?></td>
      <td  valign="middle"  > 
        <input name="phone" type="text" value="" size="40"  />
        </td>
    </tr>
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_email')?>*</td>
      <td  valign="middle"  ><input name="email" type="text" value="" size="40"  />
 </td>
      </tr>
       <tr>
      <td  valign="middle"><?=lang('main_feed_form_subject')?></td>
      <td  valign="middle"  >
      <input name="tema"  type="text" value="" size="40"  />
      </td>
      </tr>
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_message')?>*</td>
      <td  valign="middle"  ><textarea name="text" rows="4" cols="30"></textarea>    </td>
    </tr>
    
     <tr>
      <td valign="middle"><?=lang('main_feed_form_vvedite_simvoly')?>:</td>
        <td>
        <img src= <?=base_url().'page/captha_img/'.rand(0,255)?> align="left">
          <br>
        <div class="input-bg"><input type="text" id="captha" name="captchacode"></div></td>
      </tr>
     <tr>
       <td colspan="2" align="center" >
      <div id="try_auth_response" align="center"></div> 
      <br> 
      <br>
      <input name="lang"  type="hidden" value="<?=lang('main_lang')?>" />
      <div id="sendfeedbutton">
        <input name="btn" class="styled_button" type="submit" value="<?=lang('main_feed_form_send_message')?>" />
      </div>
       </td>
        </tr>
    
  </table>
  
    </form>
</div>
<br><br><br>