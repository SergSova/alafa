<div align="center" class="feed_form"> 
 
<div class=" "><?php  if (isset($blocks[10]) && $blocks[10]['text']!='' && $blocks[10]['text']!='&nbsp;'){ echo $blocks[10]['text'];  }  ?></div>

 <form  name="myform_vivod" id="myform_vivod">
  <table cellpadding="0" cellspacing="0" class="form " align="center">
   <tr>
      <td  valign="middle"><?=lang('main_feed_form_subject')?></td>
      <td  valign="middle"  > Запрос получения комиссии </td>
      </tr>
    <tr>
      <td width="220" valign="middle" ><?=lang('main_feed_form_my_code')?>*</td>
      <td valign="middle"> <?=numberFormat($user_info['id'], 6)?> </td>
      </tr>
    <tr>
      <td width="220" valign="middle" ><?=lang('main_feed_form_name')?>*</td>
      <td valign="middle"> <?=$user_info['name']?> <?=$user_info['surname']?> </td>
      </tr>
       
                    <tr>
                    	<td><?=lang('main_user_inn')?>: </td>
                        <td><?php if($user_info['inn']!='0') { echo $user_info['inn']; } ?>
                         
                        </td>
                    </tr>
         
 
     <tr>
      <td  valign="middle">&nbsp;</td>
      <td  valign="middle"  >&nbsp;</td>
      </tr>  
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_level')?>*</td>
      <td  valign="middle"  > <?=$level_to?>" </td>
      </tr>   
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_summa')?>*</td>
      <td  valign="middle"  > <?=$summa_get_show?> UAH </td>
      </tr>   
      <tr>
      <td  valign="middle">&nbsp;</td>
      <td  valign="middle"  >&nbsp;</td>
      </tr>  
      <tr>
      <td  valign="middle">Код получателя в системе ADV Cash*</td>
      <td  valign="middle"  ><?=$user_info['adv_uid']?>
      </td>
      </tr> 
       
 <tr>
      <td  valign="middle">&nbsp;</td>
      <td  valign="middle"  >&nbsp;</td>
      </tr>      
    <tr>
      <td  valign="middle"> <?=lang('main_feed_form_phone')?></td>
      <td  valign="middle"  >  <?=$user_info['phone']?>  </td>
     </tr>
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_email')?>*</td>
      <td  valign="middle"  > <?=$user_info['email']?>  </td>
      </tr>
    
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_message')?>*</td>
      <td  valign="middle"  ><textarea name="text" rows="4" cols="30" placeholder="комментарий"></textarea>    </td>
    </tr>
    
    
     <tr>
       <td colspan="2" align="center" >
      <div id="try_vivod_response" class="info_form_box" align="center"></div> 
      <br> 
      <br>
      <input name="lang"  type="hidden" value="<?=lang('main_lang')?>" />
      <input name="id" type="hidden" value="<?=$user_info['id']?>"  />
      <input name="referal" type="hidden" value="<?=$user_info['referal']?>"  />
      <input name="sip2" type="hidden" value="<?=$summa_get_hash?>"  />
      <input name="lqsignature" type="hidden" value="<?=$lqsignature?>"  /> 
      <input name="d_kq" type="hidden" value="<?=$d_kq?>"  /> 
      <input name="level_to" type="hidden" value="<?=$level_to?>"  />  
      <div id="sendfeedbutton">
        <input name="btn" class="bottom" type="button" value="<?=lang('main_feed_form_send_vivod_komissii')?>" onClick="tmk_vivod(); " />
      </div>
       </td>
        </tr>
    
  </table>
  
    </form>
     
</div> 
<script>

  function tmk_vivod() {
	  $("input.bottom").attr('disabled');
	  
	   $.ajax({  
							type: "POST",  
							url:  "/user/get_komission/",
							cache: false, 
							data: $('#myform_vivod').serialize(),
							success: function(response){ 
							// $("#tmk_progress").html(response);  
							var response_obj = $.parseJSON(response);
									if(response_obj.status == '1') { 
									$(".tmk_ch[data-kq=<?=$d_kq?>][data-t=<?=$level_to?>]").remove(); 
									//alert(".tmk_ch[data-kq=<?=$d_kq?>][data-t=<?=$level_to?>]");
									$('#tmk_progress').html(response_obj.message); 
									$('#tmk_progress').fadeIn(300);  
									setTimeout(function(){  
									$('#tmk_progress').html('');
									 }, 3000); 
									} else if(response_obj.status =='0') {
										$('#try_vivod_response').html(response_obj.message); 
										$('#try_vivod_response').fadeIn(300); 
										$("input.bottom").attr('enabled'); 
										} 
							}
							//  "/"+main_lang+
		 }); 
		 //===========
    //  alert('111'); 
		
	  
         return false;
  }
  </script>