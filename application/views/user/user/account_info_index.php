
  <?php  
	$uriki_vid = array(
	"fop"=>  lang('main_user_uriki_vid_sobs_fop') ,
	"pp"=>  lang('main_user_uriki_vid_sobs_pp') ,
	"tov"=>  lang('main_user_uriki_vid_sobs_tov') 
	);         
	
 $level_balls_arr = array(
	"1"=>  "1" ,
	"2"=>  "2" ,
	"3"=>  "3" ,
	"4"=>  "4" ,
	"5"=>  "5" ,
	"6"=>  "6" ,
	"7"=>  "7" ,
	"8"=>  "8" ,
	"9"=>  "9" ,
	"10"=>   "R"
	);         

 $level_word_arr = array(
	"1"=>   lang('main_level1') ,
	"2"=>   lang('main_level2') ,
	"3"=>   lang('main_level3') ,
	"4"=>   lang('main_level4') ,
	"5"=>   lang('main_level5') ,
	"6"=>   lang('main_level6') ,
	"7"=>   lang('main_level7') ,
	"8"=>   lang('main_level8') ,
	"9"=>   lang('main_level9') ,
	"10"=>   lang('main_level10') ,
	);         	
	
/*$level_komiss_prc = array(
	"1"=> "25" , 	"2"=> "6" , 	"3"=> "5" ,
	"4"=> "25" , 	"5"=> "6" , 	"6"=> "5" ,
	"7"=> "30" , 	"8"=> "6" , 	"9"=> "5" ,
	"10"=> 0
	);    */
	$level_komiss_prc = array(
	1=> array(1=> "25" , 2=> "6" ,3=> "5" ), 	
	2=> array(1=> "25" , 2=> "6" ,3=> "5" ), 	
	3=> array(1=> "25" , 2=> "6" ,3=> "5" ), 	
	4=> array(1=> "30" , 2=> "6" ,3=> "5" ), 	
	5=> array(1=> "30" , 2=> "6" ,3=> "5" ), 	
	6=> array(1=> "30" , 2=> "6" ,3=> "5" ), 	
	7=> array(1=> "30" , 2=> "6" ,3=> "5" ), 		
	8=> array(1=> "30" , 2=> "6" ,3=> "5" ), 	
	9=> array(1=> "30" , 2=> "6" ,3=> "5" ), 	
	10=> array()
	);  
			
 $level_count_refs = array(
	"1"=> 0 , 	"2"=> 0 , 	"3"=> 0 ,
	"4"=> 0 , 	"5"=> 0 , 	"6"=> 0 ,
	"7"=> 0 , 	"8"=> 0 , 	"9"=> 0 ,
	"10"=> 0
	);    
$count_1refs_levels = array(
	"1"=> 0 , 	"2"=> 0 , 	"3"=> 0 ,
	"4"=> 0 , 	"5"=> 0 , 	"6"=> 0 ,
	"7"=> 0 , 	"8"=> 0 , 	"9"=> 0 ,
	"10"=> 0
	); 
$count_2refs_levels = array(
	"1"=> 0 , 	"2"=> 0 , 	"3"=> 0 ,
	"4"=> 0 , 	"5"=> 0 , 	"6"=> 0 ,
	"7"=> 0 , 	"8"=> 0 , 	"9"=> 0 ,
	"10"=> 0
	); 
$count_3refs_levels = array(
	"1"=> 0 , 	"2"=> 0 , 	"3"=> 0 ,
	"4"=> 0 , 	"5"=> 0 , 	"6"=> 0 ,
	"7"=> 0 , 	"8"=> 0 , 	"9"=> 0 ,
	"10"=> 0
	); 		
	
 
	$nalog_sys = array(
	1=>  lang('main_user_uriki_nalog_sys_1') ,
	2=>  lang('main_user_uriki_nalog_sys_2') ,
    3=>  lang('main_user_uriki_nalog_sys_3') ,
    4=>  lang('main_user_uriki_nalog_sys_4') ,
    5=>  lang('main_user_uriki_nalog_sys_5') ,
	6=>  lang('main_user_uriki_nalog_sys_6') 
	);       
	 
 ?>

 <?php if (!empty($user_info)){  ?>
  
<div class="m_howit"> 
 <?php /*   ================= анкета - начало  =================== */?>
 <div id="anketa" class="  visible_on ">
  <p class="big"><?=lang('main_user_your_partner_progr')?></p>
   <div class="tabl">
     <table class="uchet" cellpadding="0" cellspacing="0" align="center">
       <tr>
         <td ><?=lang('main_user_info_profile')?></td>
    <td align="right" >      
          <input class="bottom_link" name="btn" type="button" value="<?=lang('main_user_edit_do')?>" onClick="window.location='/<?=lang('main_lang')?>/user/edit' "style="width: 230px;" />  
 </td>
 
         </tr>
       <tr>
         <td><?=lang('main_form_name')?>:</td>
         <td><?=$user_info['name']?> <?=$user_info['byfather']?></td>
         </tr>
       <tr>
         <td><?=lang('main_form_surname')?>:</td>
         <td><?=$user_info['surname']?></td>
         </tr>
       <tr>
         <td>E-mail:</td>
         <td><?=$user_info['email']?></td>
         </tr>
       <tr>
         <td><?=lang('main_info_phone_mobile')?>: </td>
         <td><?=$user_info['phone']?></td>
         </tr>
       
     
       
       <tr>
         <td><?=lang('main_user_adres')?>:</td>
         <td><?=$user_info['country']?> | <?=$user_info['town']?> | <?=$user_info['adres']?></td>
         </tr>
       
       <?php /*  ==    begin ==  */ if(!empty($user_info['first_pay'])) { //echo "<pre>"; print_r($main_levels);  && !empty($main_levels) ?> 
   
       <?php // if(!empty($user_info['my_actual_levels'])) { ?>
       <tr>
         <td><?=lang('main_user_vsego')?> <?=lang('main_user_partnerov')?>:</td>
         <td><div class="personal_code">
           <?php   echo $count_my_referals;?>
           </div></td>
         </tr>
       <tr>
         <td><?=lang('main_user_vsego')?> активных рефералов:</td>
         <td><div class="personal_code">
           <?php   echo $count_my_referals_all_active;?>
           </div></td>
         </tr>
       <tr>
         <td><?=lang('main_user_your')?> <?=lang('main_user_personal_code')?>:</td>
         <td><div class="personal_code">
           <?php $ref_num = numberFormat($user_info['id'], 6); echo $ref_num;?>
           </div></td>
         </tr>
       <tr>
         <td><?=lang('main_user_your')?><?=lang('main_user_partner_link')?>:</td>
         <td><div class="personal_link">
           <input type="text" value="<?=base_url().'ru/rl/'.$ref_num?>" >  
           
           <button class="bottom_link" onClick="window.open('/<?=lang('main_lang')?>/user/my_certificate')" "style="width: 200px;" >Мой сертификат</button> 
           
           </div></td>
         </tr>
         <tr>
           <td colspan="3">
           </td>
          </tr>
           
          <tr>
           <td colspan="3">
           
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="anketa_tbl_index">
  <tbody>
    <tr>
    <td>&nbsp;</td>
      <td align="center">Кошелек USD</td>
      <td align="center">Кошелек UAH</td> 
    </tr>
    
    <tr> 
      <td align="right">Кол-во активных рефералов:</td>
      <td align="center"><?=$count_my_referals_all_active_usd?></td>
      <td align="center"><?=$count_my_referals_all_active_uah?></td>
    </tr>
    <tr> 
      <td align="right">Открытые этапы:</td>
      <td align="center">
      <div class="level_balls">
       
           <?php if(empty($main_levels_me_usd)) { //  echo "<pre>"; print_r($main_levels_me_usd); ?>
           <?=lang('main_user_not_payed_regs')?>
           <?php }  else { ?>
           <?php  $main_levels_me_usd = array_unique($main_levels_me_usd); $levels_ids_list_usd = implode(", ", $main_levels_me_usd);  //echo $levels_ids_list; 
	 	} ?>
             <?php foreach($level_balls_arr as $lba_key=>$lba_val) {?>							
             <?php  if($lba_key!='10') { ?><div class="ball  <?php if(in_array($lba_key, $main_levels_me_usd)) { echo "active";} ?>"><?=$lba_val?></div> <?php }  ?>
             <?php  if($lba_key=='10' && !empty($user_info['first_pay'])) { ?><div class="ball ball_it10 active "><?=$lba_val?></div> <?php }  ?>
             <?php /*?><div class="ball <?php  if($lba_key=='10' && !empty($user_info['first_pay'])) { echo "ball_it10";  } ?> <?php if(in_array($lba_key, $main_levels_me_usd)) { echo "active";} ?>"><?=$lba_val?></div><?php */?>
             <?php	} /*  == USD  end ==  */?>
            </div>
            </td>
      <td align="center">
       <div class="level_balls">
       <?php  /*  == UAH  begin ==  */  ?> 
           <?php if(empty($main_levels_me_uah)) { //  echo "<pre>"; print_r($main_levels_me_uah); exit; ?>
           <?=lang('main_user_not_payed_regs')?>
           <?php }  else { ?>
           <?php  $main_levels_me_uah = array_unique($main_levels_me_uah); $levels_ids_list_uah = implode(", ", $main_levels_me_uah);  //echo $levels_ids_list; 
	 	} ?>
             <?php foreach($level_balls_arr as $lba_key=>$lba_val) {?>				
             <?php  if($lba_key!='10') { ?><div class="ball  <?php if(in_array($lba_key, $main_levels_me_uah)) { echo "active";} ?>"><?=$lba_val?></div> <?php }  ?>
             <?php  if($lba_key=='10' && !empty($user_info['first_pay'])) { ?><div class="ball ball_it10 active "><?=$lba_val?></div> <?php }  ?>			
             <?php /*?><div class="ball <?php  if($lba_key=='10' && !empty($user_info['first_pay'])) { echo "ball_it10";  } ?> <?php if(in_array($lba_key, $main_levels_me_uah)) { echo "active";} ?>"><?=$lba_val?></div><?php */?>
             <?php	} /*  == UAH  end ==  */?>
            </div>
            </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
      <td align="center"><button class="bottom_link" onClick="window.location='/<?=lang('main_lang')?>/user/currency_usd' "style="width: 200px;" > Перейти в кошелек <br> USD </button>   </td>
      <td align="center"><button class="bottom_link" onClick="window.location='/<?=lang('main_lang')?>/user/currency_uah' "style="width: 200px;" > Перейти в кошелек <br> UAH </button> </td> 
    </tr>
  </tbody>
</table>

     <tr>
    <td align="center"><?php /*?><button class="bottom_link" onClick="window.location='/<?=lang('main_lang')?>/user/my_certificate' "style="width: 200px;" >Мой сертификат</button> <?php */?></td> 
    </tr>
          
           </td>
           </tr>
           
       <?php  } 
					
				  if(!empty($user_info['first_pay'])  && empty($main_levels_me)){ 
					?>
                    <tr>
         <td colspan="2"> 
       Для того, чтобы получить статус Бенефициара и начать свою реферальную программу, откройте любой этап программы.
       
       <?php }
					 if(empty($user_info['first_pay'])  ){   // если не зарегился за 100 грн - начало
					?>
                     </td>
           </tr>
       <tr>
         <td colspan="2"><?php  $this->load->view('user/orders/reg_generate_pay_info');?>
           <div id="pay_reg"> </div></td> 
           
         </tr>
       <?php } // если не зарегился за 100 грн - окончание ?>
       </table>
 
    
     
     
     <div class="clear"> </div>
     
     
   </div><!--tabl-->
 
   
   <div class="clear"></div>
   
  <!-- <div align="center"><img class="right" src="/media/css/user/img/icon_arrow_down.png" width="47" height="44" /></div>-->
  
 </div>
<?php /*   ================= анкета - конец  =================== */?>
  
  
 
 
 </div><!--m_howit-->
        
 <div class="clear"></div>
        
   <div class="separator_red_line"></div>
<?php } ?> 