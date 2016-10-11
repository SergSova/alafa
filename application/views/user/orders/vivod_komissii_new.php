 
<div align="center" class="feed_form">

<?php // $can_vivod = $levels_and_count[$level_to-1]['count_my_this_referals'] - $levels_and_count[$level_to-1]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[$level_to-1]['count_visit_v_zaprose_payet']*5; 
$can_vivod = 6; ?>
 
                        
                        
                         
 <?php if($can_vivod>=5) { ?>
                        

<!--<h1>Запрос вывода комиссии с уровня</h1>-->
<div class=" "><?php  if (isset($blocks[10]) && $blocks[10]['text']!='' && $blocks[10]['text']!='&nbsp;'){ echo $blocks[10]['text'];  }  ?></div>

 <form  method="post" action="<?php echo base_url();?><?=lang('main_lang')?>/page/get_komission/" enctype="multipart/form-data" name="myform_vivod" id="myform_vivod">
  <table cellpadding="0" cellspacing="0" class="form " align="center">
   <tr>
      <td  valign="middle"><?=lang('main_feed_form_subject')?></td>
      <td  valign="middle"  >
      <input name="tema"  type="text" size="40" value="Запрос вывода комиссии" readonly />
      </td>
      </tr>
    <tr>
      <td width="220" valign="middle" ><?=lang('main_feed_form_my_code')?>*</td>
      <td valign="middle"><input name="code" type="text"  size="40"  value="<?=numberFormat($user_info['id'], 6)?>" readonly  /></td>
      </tr>
    <tr>
      <td width="220" valign="middle" ><?=lang('main_feed_form_name')?>*</td>
      <td valign="middle"><input name="fio" type="text"  size="40" value="<?=$user_info['name']?> <?=$user_info['surname']?>" readonly /></td>
      </tr>
       
                    
                    <tr>
                    	<td><?=lang('main_user_inn')?>: </td>
                        <td><?php if($user_info['inn']!='0') { echo $user_info['inn']; } ?>
                        <input name="inn" type="text"  value="<?php if($user_info['inn']!='0') echo $user_info['inn'];?>"  required  />
                        </td>
                    </tr>
                     
 
     <tr>
      <td  valign="middle">&nbsp;</td>
      <td  valign="middle"  >&nbsp;</td>
      </tr>  
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_level')?>*</td>
      <td  valign="middle"  ><input name="target" type="text"  size="40" value="0"  readonly />
      </td>
      </tr>   
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_summa')?>*</td>
      <td  valign="middle"  ><input name="price" type="text"  size="40" value="сумма вывода"  readonly />
      </td>
      </tr>   
      <tr>
      <td  valign="middle">&nbsp;</td>
      <td  valign="middle"  >&nbsp;</td>
      </tr>  
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_bank_name')?>*</td>
      <td  valign="middle"  ><input name="bank_name" type="text"  size="40" value=""  placeholder="название банка"  required />
      </td>
      </tr> 
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_bank_edrpou')?>*</td>
      <td  valign="middle"  ><input name="bank_edrpou" type="text"  size="40" value=""  required  />
      </td>
      </tr>   
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_bank_mfo')?>*</td>
      <td  valign="middle"  ><input name="bank_mfo" type="text"  size="40" value=""  required  />
      </td>
      </tr>   
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_card_number')?>*</td>
      <td  valign="middle"  ><input name="card_number" type="text"  size="40" value=""  required  />
      </td>
      </tr> 
      <tr>
      <td  valign="middle"><?=lang('main_feed_form_vivod_card_shet')?>*</td>
      <td  valign="middle"  ><input name="card_shet" type="text"  size="40" value=""  required  />
      </td>
      </tr>  
 <tr>
      <td  valign="middle">&nbsp;</td>
      <td  valign="middle"  >&nbsp;</td>
      </tr>      
    <tr>
      <td  valign="middle"> <?=lang('main_feed_form_phone')?></td>
      <td  valign="middle"  > 
        <input name="phone" type="text"  size="40" value="<?=$user_info['phone']?>"  />
        </td>
     </tr>
    <tr>
      <td  valign="middle"><?=lang('main_feed_form_email')?>*</td>
      <td  valign="middle"  ><input name="email" type="text"  size="40" value="<?=$user_info['email']?>"  />
      </td>
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
      <input name="code" type="hidden" value="<?=$user_info['id']?>"  />
      <input name="urik"  type="hidden" value="<?=$user_info['urik_yn']?>" />
      <div id="sendfeedbutton">
        <input name="btn" class="bottom" type="submit" value="<?=lang('main_feed_form_send_vivod_komissii')?>" />
      </div>
       </td>
        </tr>
    
  </table>
  
    </form>
    
     <?php } else { ?>
     У вас недостаточно партнеров этого уровня для вывода комисии
      <?php }  ?>
    
</div>
<br><br><br>