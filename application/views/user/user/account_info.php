
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
   <?php 
 /* $first = ' class="current" ';
  $comments = '';
  $show_first_box = ' visible_on ';
  $comments_div = '';
   if (isset($tab) && $tab=='comments'){ 
		 $first = '';
		 $comments = ' class="current" ';
		 $comments_div = ' visible_on ';
		 $show_first_box = '';
        } */?>
 <?php if (!empty($user_info)){
	// $user_status_discount = $this->session->userdata('user_status_discount');
/*	if(isset($this->session->userdata('pay_status_now'))){
		$pay_stat = $this->session->userdata('pay_status_now');
		if($pay_stat=='payed_show_next') {$alert = "Ваш запрос на оплату был обработан платежной системой. О его статусе вы можете узнать в личном кабинете Alafa? а так же в личном кабинете платежной системы.";}
		if($pay_stat=='bad_news') {$alert = "Ваш запрос на оплату не был обработан платежной системой. О его статусе вы можете узнать в личном кабинете платежной системы.";}
	}*/
	  ?>
      
<div class="grouptabs">
        <ul>
          <li path="anketa"> Анкета и уровни</li> 
          <li path="referals"> Мои рефералы</li>  
          <li path="stat"> Статистика</li> 
          <li path="history_pay" > Мои оплаты </li>  
          <li path="history_comission"> Запросы комиссиионных</li>  
  </ul>
</div>
 <div class="clear"></div>
 
 

<div class="m_howit"> 
 <?php /*   ================= анкета - начало  =================== */?>
 <div id="anketa" class="adm_tab_block ">
  <p class="big"><?=lang('main_user_your_partner_progr')?></p>
   <div class="tabl">
     <table class="uchet" cellpadding="0" cellspacing="0">
       <tr>
         <td colspan="2"><?=lang('main_user_info_profile')?></td>
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
         <td><?=lang('main_user_inn')?>: </td>
         <td><?php if($user_info['inn']!='0') { echo $user_info['inn']; } ?></td>
         </tr>
       
       <tr>
         <td><?=lang('main_user_adres')?>:</td>
         <td><?=$user_info['country']?> | <?=$user_info['town']?> | <?=$user_info['adres']?></td>
         </tr>
       
       <?php if(!empty($user_info['first_pay'])) { //echo "<pre>"; print_r($main_levels);  && !empty($main_levels) ?>
       <tr>
         <td><?=lang('main_user_minee')?> <?=lang('main_user_opened_level_2')?> <?=lang('main_user_levels_1')?>:</td>
         <td>
           <?php if(empty($main_levels_me)) { // echo "<pre>"; print_r($main_levels); ?>
           <?=lang('main_user_not_payed_regs')?>
           <?php }  else { ?>
           <?php 
						$main_levels_me = array_unique($main_levels_me); $levels_ids_list = implode(", ", $main_levels_me);  //echo $levels_ids_list; 
						} ?>
           <div class="level_balls">
             <?php foreach($level_balls_arr as $lba_key=>$lba_val) {?>							
             <div class="ball <?php  if($lba_key=='10') { echo "ball_it10";  } ?> <?php if(in_array($lba_key, $main_levels_me)) { echo "active";} ?>"><?=$lba_val?></div>
             <?php	}?>
            </div>
           </td>
         </tr>
       
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
           </div></td>
         </tr>
       <?php  } /* else { ?>
                    <tr>
                    	<td colspan="2"><?=lang('main_user_must_reg_1')?></td>
                    </tr>
                    <?php  } */
					
				  if(!empty($user_info['first_pay'])  && empty($main_levels_me)){ 
					?>
       Для того, чтобы получить статус Бенефициара и начать свою реферальную программу, откройте любой уровень в таблице ниже.
       
       <?php }
					 if(empty($user_info['first_pay'])  ){   // если не зарегился за 100 грн - начало
					?>
       <tr>
         <td colspan="2"><?php  $this->load->view('user/orders/reg_generate_pay_info');?>
           <div id="pay_reg"> </div></td>
         </tr>
       <?php } // если не зарегился за 100 грн - окончание ?>
       </table>
     
     <!-- <a class="like_button" href="<?=lang('main_lang')?>/edit"><?=lang('main_user_edit_do')?></a>-->
     
     <!--<form action="" method="get">  -->
     <input class="bottom_link" name="btn" type="button" value="<?=lang('main_user_edit_do')?>" onClick="window.location='/<?=lang('main_lang')?>/user/edit' "style="width: 230px;" />  
     <!--<input class="bottom" name="Кнопка" type="button" value="Подтвердить" />-->
     <!--</form>-->
     
     
     
     <div class="clear">
       
      </div>
     
     
   </div><!--tabl-->
   <div class="slide">
     <?php /*?>            	
             <!--<div class="next1"><img class="left" src="/media/css/user/img/icon_point.png" width="20" height="20" />
            <img class="right" src="/media/css/user/img/icon_point.png" width="20" height="20" />
            </div>
            <div class="registr1"><img src="/media/css/user/img/home_4p.png" width="181" height="180" /></div>-->
            <!--<div class="clear my_balance">Мой баланс: 0</div>
            <div class="clear my_balance_get" onClick="window.location='/user/take_my_komission_new'; ">Запросить вывод баланса</div>--><?php */?>
   </div><!--slide-->
   
   <div class="clear"></div>
   
   <div align="center"><img class="right" src="/media/css/user/img/icon_arrow_down.png" width="47" height="44" /></div>
   
   <div class="uroven_slogan"><?=lang('main_user_tekushi_uroven2')?></div>
   
   <div id="go_to_et"></div>
   
  <table class="refer all_levels" cellpadding="0" cellspacing="0" align="center" >
    <?php  // echo $user_info['main_levels'];
				  // $main_levels_arr = explode(",", $user_info['main_levels']);
				  /*   if( $user_info['my_level']==0  || $user_info['cur_lev_by_etap1']==0 ) */
			//  echo "<pre>"; print_r($levels_and_count);
				 //  class="level_label" ?>
    <tr>
      <td class="g_bg"> 
        <div class="etap_slogan"><?=lang('main_user_group_1')?></div> 
        <?=lang('main_level1')?> 
        <?php if( !in_array( 1,  $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(1);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[0]['price']?></strong> <?=lang('main_uah')?> </div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[0]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[0]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[0]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!--<div class="s_c_refs"><?php if($levels_and_count[0]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[0]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[0]['count_my_this_referals'] - $levels_and_count[0]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[0]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[0]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/1" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        
        </td>
      <td class="w_bg"></td>
      <td class="g_bg">
        <div class="etap_slogan"><?=lang('main_user_group_2')?></div> 
        <?=lang('main_level4')?> 
        <?php if( !in_array( 4, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(4);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[3]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?> 
        
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[3]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[3]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[3]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[3]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[3]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[3]['count_my_this_referals'] - $levels_and_count[3]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[3]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[3]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/4" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      <td class="w_bg"></td>
      <td class="g_bg">
        <div class="etap_slogan"><?=lang('main_user_group_3')?></div>                    
        <?=lang('main_level7')?> 
        <?php if( !in_array( 7, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(7);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[6]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[6]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[6]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[6]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[6]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[6]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[6]['count_my_this_referals'] - $levels_and_count[6]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[6]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[6]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/7" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      </tr>
    <?php  // if( $user_info['my_level']!=0) { ?>
    <!-- <tr>-->
    
    <tr>
      <td class="g_bg">
        <p><?=lang('main_level2')?></p>
        <?php if( !in_array( 2, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(2);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[1]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[1]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[1]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[1]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!--    <div class="s_c_refs"><?php if($levels_and_count[1]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[1]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div> -->
        <?php  $can_vivod = $levels_and_count[1]['count_my_this_referals'] - $levels_and_count[1]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[1]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[1]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/2" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        
        </td>
      <td class="w_bg"></td>
      <td class="g_bg">
        <p><?=lang('main_level5')?></p>
        <?php if( !in_array( 5, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(5);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[4]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[4]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[4]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[4]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[4]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[4]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[4]['count_my_this_referals'] - $levels_and_count[4]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[4]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[4]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/5" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      <td class="w_bg"></td>
      <td class="g_bg">
        <p><?=lang('main_level8')?></p>
        <?php if( !in_array( 8, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(8);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[7]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[7]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[7]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[7]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[7]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[7]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[7]['count_my_this_referals'] - $levels_and_count[7]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[7]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[7]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/8" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      </tr>
    <!--  <tr>-->
    
    <tr>
      <td class="g_bg">
        <p><?=lang('main_level3')?></p>
        <?php if( !in_array( 3, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(3);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[2]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[2]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[2]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[2]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[2]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[2]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[2]['count_my_this_referals'] - $levels_and_count[2]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[2]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[2]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/3" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      <td class="w_bg"></td>
      <td class="g_bg">
        <p><?=lang('main_level6')?></p>
        <?php if( !in_array( 6, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(6);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[5]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[5]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[5]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[5]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[5]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[5]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[5]['count_my_this_referals'] - $levels_and_count[5]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[5]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[5]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/6" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      <td class="w_bg"></td>
      <td class="g_bg">
        <p><?=lang('main_level9')?></p>
        <?php if( !in_array( 9, $main_levels_me) ) { ?>
        <div  class="like_button" onClick="go_to_etap(9);"><?=lang('main_registr_za')?><strong><?=$levels_and_count[8]['price']?></strong> <?=lang('main_uah')?></div><?php }  else {?>
        <div class="level_opened"><?=lang('main_user_opened_level')?></div>
        <?php } ?>
        <div class="s_c_refs s_c_refs_all_count"><?php if($levels_and_count[8]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[8]['count_my_this_referals'];}?> <?=lang('main_user_partnerov')?></div>
        <?php if($levels_and_count[8]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"><?=lang('main_1_zajavka_v_obrabotke')?></div><?php }  ?>
        <!-- <div class="s_c_refs"><?php if($levels_and_count[8]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[8]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
        <?php  $can_vivod = $levels_and_count[8]['count_my_this_referals'] - $levels_and_count[8]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[8]['count_visit_v_zaprose_payet']*5;  ?>
        <?php if($can_vivod>=1) { ?><div class="s_c_refs"><?=$can_vivod?><?=lang('main_partnerov_novih')?></div> <?php } ?>
        <?php if($can_vivod>=5 && $levels_and_count[8]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/9" title="<?=lang('main_user_vivesti_komissiy')?>"><?=lang('main_user_vivesti_komissiy')?></a></div><?php }  ?>
        </td>
      </tr>
    
    <?php // } ?>
  </table>
 </div>
<?php /*   ================= анкета - конец  =================== */?>
  
  
   <?php /*   ================= список рефералов - начало  =================== */?>
 <div id="referals"  class="adm_tab_block">
  <table class="refer" cellpadding="0" cellspacing="0" width="100%" >
    <tr>
      <td colspan="4"><p class="big" align="center"><?=lang('main_info_o_partn_zap')?></p></td>
      <td colspan="2"> 
        Обозначения:
        <div class="usl_ob_cube blue">Второй уровень рефералов</div>
        <div class="usl_ob_cube green">Третий уровень рефералов</div>
      </td>
    </tr>
    <?php if(isset($my_referals_all['list'])) {?>
    <tr>
      <td class="header_td" width="20%" colspan="4">#</td>
      <td class="header_td" width="25%"><?=lang('main_user_imya_partn')?></td>
      <td class="header_td" width="20%"><?=lang('main_user_partner_email')?></td>
      <td class="header_td" width="15%"><?=lang('main_user_tekushi_uroven')?></td>
      <td class="header_td" width="20%"><?=lang('main_user_registr_date')?></td>
    </tr>
    <?php  if(!empty($my_referals_all['list'])) { 
				   //echo "<pre>"; print_r($my_referals_all['list']); echo "</pre>";
					   foreach ($my_referals_all['list'] as $referal){?>
    <tr>
    
      <td><?php if(isset($referal["next_referals"]["total"])) { ?> <div class="open_close_btn open_close_sy_<?=$referal['id']?>" data-id="<?=$referal['id']?>" data-toggle="closed">+</div> <?php } ?></td> 
      <td><div class="t_ref_id"> <?=$referal['id']?> </div></td> 
      <td></td>
      <td></td>
      
      <td class="ref_name"><?=$referal['name'].' '.$referal['surname']?><?php // if(isset($referal["next_referals"]["total"]))  echo "<br>(рефералов: ".$referal["next_referals"]["total"].")"?></td>
      <td><?=$referal['email']?></td>
      <td> 
        <?php 
						//echo "<pre>"; print_r($referal['actual_levels']); echo "</pre>";
						$levels_ids_list = '';
						$main_levels = array(); 
						 if(isset($referal['actual_levels']) && !empty($referal['actual_levels'])) {
							// echo "<pre>"; print_r($referal['actual_levels']);
							 //echo "==="; 
						  foreach($referal['actual_levels'] as $level){
							$main_levels[] = $level['target'];  
						  } 
						  $main_levels = array_unique($main_levels); $levels_ids_list = implode(", ", $main_levels);  // echo $levels_ids_list;  
						 }
						 // echo $referal['count_payed_targets'] ;
						 
						?> 
        <div class="level_balls">
          <?php foreach($level_balls_arr as $lba_key=>$lba_val) {  ?>							
          <div class="ball <?php if($lba_key=='10') { echo "ball_it10"; } ?>  <?php if(in_array($lba_key, $main_levels)) { echo "active"; $level_count_refs[$lba_key] = $level_count_refs[$lba_key]+1; $count_1refs_levels[$lba_key] = $count_1refs_levels[$lba_key]+1; } ?>"><?=$lba_val?></div>
          <?php	}?>
        </div>
        <!--<?=$referal['target']?>--></td>
      <td><?=$referal['date_reg']?> </td>
    </tr> 
    <?php /*?>=========== уровень два - начало =============<?php */?>
    <?php if(isset($referal["next_referals"]["list"]) && !empty($referal["next_referals"]["list"])) {   // next_referals second  
									 foreach ($referal["next_referals"]["list"] as $referal2){ ?>
    <tr class="ref_childs referals<?=$referal['id']?> refs_2 " >
    <td><?php if(isset($referal2["next_referals"]["total"])) { ?> <div class="open_close_btn open_close_sy_<?=$referal2['id']?>" data-id="<?=$referal2['id']?>" data-toggle="closed">+</div> <?php } ?> </td> 
      <td></td>  
      <td><div class="t_ref_id"> <?=$referal2['id']?> </div></td> 
      <td></td>
      <td><?=$referal2['name'].' '.$referal2['surname']?></td>
      <td><?=$referal2['email']?></td>
      <td>
        <?php
											//echo "<pre>"; print_r($referal['actual_levels']); echo "</pre>";
											 $main_levels2 = array(); 
											 $levels_ids_list2 = '';
											 if(isset($referal2['actual_levels']) && !empty($referal2['actual_levels'])) {
												 //echo "===";
												
											  foreach($referal2['actual_levels'] as $level2){
												$main_levels2[] = $level2['target'];  
											  } 
											  $main_levels2 = array_unique($main_levels2); $levels_ids_list2 = implode(", ", $main_levels2); //echo $levels_ids_list2;  
											 }
											?> 
        <div class="level_balls">
          <?php foreach($level_balls_arr as $lba_key=>$lba_val) { ?>							
          <div class="ball  <?php if($lba_key=='10') { echo "ball_it10"; } ?>  <?php if(in_array($lba_key, $main_levels2)) { echo "active"; $level_count_refs[$lba_key] = $level_count_refs[$lba_key]+1;  $count_2refs_levels[$lba_key] = $count_2refs_levels[$lba_key]+1; } ?>"><?=$lba_val?></div>
          <?php	}?>
        </div>
        <!--<?=$referal2['target']?>--></td>
      <td><?=$referal2['date_reg']?> </td>
    </tr>
    
    <?php /*?>=========третий уровень - начало======<?php */?>
    <?php if(isset($referal2["next_referals"]["list"]) && !empty($referal2["next_referals"]["list"])) {   // next_referals second  
									 foreach ($referal2["next_referals"]["list"] as $referal3){ ?>
    <tr class="ref_childs referals<?=$referal2['id']?> refs_3 " >
      <td> </td> <td></td><td></td>
      <td><div class="t_ref_id">  <?=$referal3['id']?>  </div></td> 
      <td><?=$referal3['name'].' '.$referal2['surname']?></td>
      <td><?=$referal3['email']?></td>
      <td>
        <?php
											$main_levels3 = array(); 
											$levels_ids_list3  = '';
										//	echo "<pre>"; print_r($referal3['actual_levels']); echo "</pre>";
											 if(isset($referal3['actual_levels']) && !empty($referal3['actual_levels'])) {
												 //echo "===";
												 
											  foreach($referal3['actual_levels'] as $level3){
												$main_levels3[] = $level3['target'];  
											  } 
											  $main_levels3 = array_unique($main_levels3); $levels_ids_list3 = implode(", ", $main_levels3);  // echo $levels_ids_list3;  
											 }
											?> 
        <div class="level_balls">
          <?php foreach($level_balls_arr as $lba_key=>$lba_val) {  ?>							
          <div class="ball  <?php if($lba_key=='10') { echo "ball_it10"; } ?>  <?php if(in_array($lba_key, $main_levels3)) { echo "active"; $level_count_refs[$lba_key] = $level_count_refs[$lba_key]+1;  $count_3refs_levels[$lba_key] = $count_3refs_levels[$lba_key]+1; } ?>"><?=$lba_val?></div>
          <?php	}?>
        </div>
        <!--<?=$referal3['target']?>--></td>
      <td><?=$referal3['date_reg']?> </td>
    </tr>
    <?php  } } // next_referals ?>
    
    <?php /*?>=========третий уровень - конец======<?php */?>
    
    
    <?php  } } // next_referals ?>
    <?php /*?>=========== уровень два - конец =============<?php */?>
    <?php  } ?>
    
    
    
    <?php }  else { ?>
    <tr>
      <td colspan="4" align="center"><?=lang('main_user_net_partn_zapisej')?></td>
    </tr> 
    <?php  } ?>
    <?php }
				//echo "<hr> level_count_refs <pre>"; print_r($level_count_refs); echo "</pre>";   
				//echo "<hr> count_1refs_levels <pre>"; print_r($count_1refs_levels); echo "</pre>";  
				//echo "<hr> count_2refs_levels <pre>"; print_r($count_2refs_levels); echo "</pre>";   
				//echo "<hr> count_3refs_levels <pre>"; print_r($count_3refs_levels); echo "</pre>";   
				 ?>
    
  </table>
  </div>
   <?php /*   ================= список рефералов - конец  =================== */?>
  
  
   <?php /*   ================= список статистики - начало  =================== */?>
  <div id="stat"  class="adm_tab_block">
  <?php  $ip_arr =array("37.57.178.246","178.255.176.82","93.188.39.123","109.86.137.253","127.0.0.1" );
    if(!in_array($_SERVER['REMOTE_ADDR'], $ip_arr)){
    echo "Данная функция находится на обслуживании";  
    } else { ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="full_info_tbl" align="center">
    <tbody>
      <tr>
        <th rowspan="2">Этапы </th>
        <th colspan="4">Рефералы, кол-во <br>
        <em>всего / новых </em>
        </th> 
        <th  colspan="2">Начислено комиссии</th>
        <th rowspan="2">Действия</th> 
        </tr>
      <tr>
        <th>Всего</th>
        <th>Уровень 1</th>
        <th>Уровень 2</th>
        <th>Уровень 3</th>
        <th>источник</th>
        <th>Сумма</th> 
        </tr>
      <?php foreach($level_word_arr as $key_w=>$val_w) { ?> 
      <tr class="row_<?=$key_w?>">
        <td <?php  if( in_array( $key_w,  $main_levels_me) ) {  echo 'style=" font-weight: bold;" ';}  ?>><?=$val_w?></td>
        <td><?=$level_count_refs[$key_w]?></td>
        <td><?=$count_1refs_levels[$key_w]?> <?php if($key_w < 10){  $calc_1 = $count_1refs_levels[$key_w] - 5*$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l1']  ; echo " / ".$calc_1 ;}?></td>
        <td><?=$count_2refs_levels[$key_w]?> <?php if($key_w < 10){  $calc_2 = $count_2refs_levels[$key_w] - 5*$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l2']  ;  echo " / ".$calc_2; }?></td>
        <td><?=$count_3refs_levels[$key_w]?> <?php if($key_w < 10){  $calc_3 = $count_3refs_levels[$key_w] - 5*$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l3']   ; echo " / ".$calc_3 ;}?></td>
        <td style="text-align:left;">
          <?php  $is_k_1 = ''; $is_k_2 = ''; $is_k_3 = ''; $is_k_s = ''; $count_cantake_1 =''; $count_cantake_2 =''; $count_cantake_3 =''; $summ1_out=''; $summ2_out=''; $summ3_out=''; $summ_all_out = '';
	  if($key_w < 10){
		  if($count_1refs_levels[$key_w]> 0 && ($count_1refs_levels[$key_w]-5*$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l1'])>=5) {  // $count_1refs_levels[$key_w] % 5 == 0)
			  $is_can_count1 = floor($count_1refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
			  
			 // echo "<hr>1 <br>оплачено (payments) = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'];
			 // echo "<br>вывод, уровень 1  = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l1']."<hr>";
			  
			  //echo "<br>count_1refs_levels = ".$count_1refs_levels[$key_w];
			  //echo "<br>count_visit_v_zaprose_payet = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'];
			 // echo "<br> by_levels count_payed_l1 = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l1'];
			 // echo "<br> by_levels count_notpayed_l1 = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l1'];
			 
		//	 if($levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'])
			  $is_k_s .= "<br>есть комиссия уровня  1";  
			  $summ1_out = $levels_and_count[$key_w-1]['price']*5/100*$level_komiss_prc[$key_w][1];  
			// if(in_array($key_w , $main_levels_me)) {
				  $count_cantake_1 =  '<span class="tmk_ch" data-t="'.$key_w.'" data-kq="1" title="'.lang('main_user_vivesti_komissiy').'">'.lang('main_user_vivesti_komissiy').' '.$summ1_out.' грн </span>'; 
				  if($levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l1']>0){
					   $count_cantake_1 = ' <span class="tmk_nop" >Заявка уровня 1 в обработке</span>'; 
					   }
			  // echo " | кол-во комиссий ".$count_cantake_3;
			  
			  //echo "<br>".$key_w."== l uroven ".$levels_and_count[$key_w-1]['price'] . " * 5 /100 *  ".$level_komiss_prc[$key_w][1] . "  ";
			  $summ_all_out .= "<br>".$summ1_out." грн "; 
		  }
		  if($count_2refs_levels[$key_w]> 0 && ($count_2refs_levels[$key_w]-5*$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l2']) >=5 ) {  //  % 5 == 0
			  $is_can_count2 = floor($count_2refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
			  /*echo "<br>count_visit_v_zaprose_payet = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'];
			  echo "<br> by_levels count_payed_l2 = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l2'];
			  echo "<br> by_levels count_notpayed_l2 = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l2'];*/
			//  echo "<hr>2 <br>оплачено (payments)  = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'];
			 // echo "<br>вывод, уровень 2  = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l2']." ";
			 // echo "<br>заявка, уровень 2  = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l2']."<hr>";
			  $is_k_s .= "<br>есть комиссия уровня  2";  
			  $summ2_out = $levels_and_count[$key_w-1]['price']*5/100*$level_komiss_prc[$key_w][2];  
			  
			 //  if(in_array($key_w , $main_levels_me)) {
				   $count_cantake_2 = ' <span class="tmk_ch" data-t="'.$key_w.'" data-kq="2" title="'.lang('main_user_vivesti_komissiy').'">'.lang('main_user_vivesti_komissiy').'  '.$summ2_out.' грн </span>'; 
				   if($levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l2']>0){
					   $count_cantake_2 = ' <span class="tmk_nop" >Заявка уровня 2 в обработке</span>'; 
					   }
		 
			  // echo " | кол-во комиссий ".$count_cantake_3;
			  
			   //echo "<br>".$key_w."== ll uroven ".$levels_and_count[$key_w-1]['price'] . " * 5 /100 *  ".$level_komiss_prc[$key_w][2] . "  ";
			  $summ_all_out .= "<br>".$summ2_out." грн "; 
		  }
		  if($count_3refs_levels[$key_w]> 0 && ($count_3refs_levels[$key_w]-5*$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l3'])>=5) { //  % 5 == 0
			  $is_can_count3 = floor($count_3refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
			  /*echo "<br>count_visit_v_zaprose_payet = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'];
			  echo "<br> by_levels count_payed_l3 = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l3'];
			  echo "<br> by_levels count_notpayed_l3 = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l3'];*/
			//  echo "<hr>3 <br>оплачено (payments) = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'];
			//  echo "<br>вывод, уровень 3  = ".$levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_payed_l3']."<hr>";
			  $is_k_s .= "<br>есть комиссия уровня  3";  
			  $summ3_out = $levels_and_count[$key_w-1]['price']*5/100*$level_komiss_prc[$key_w][3];  
			//  if(in_array($key_w , $main_levels_me)) {
			  $count_cantake_3 =  '<span class="tmk_ch" data-t="'.$key_w.'" data-kq="3" title="'.lang('main_user_vivesti_komissiy').'">'.lang('main_user_vivesti_komissiy').'  '.$summ3_out.' грн </span>';  
			  if($levels_and_count[$key_w-1]['count_visit_v_zaprose_by_levels']['count_notpayed_l3']>0){
					   $count_cantake_3 = ' <span class="tmk_nop" >Заявка уровня 3 в обработке</span>'; 
					   }
			  // echo " | кол-во комиссий ".$count_cantake_3;
			  
			 // echo "<br>".$key_w."== lll uroven ".$levels_and_count[$key_w-1]['price'] . " * 5 /100 *  ".$level_komiss_prc[$key_w][3] . "  ";
			  $summ_all_out .= "<br>".$summ3_out." грн "; 
		  }
		  
	  }
	  echo $is_k_s;
	  ?> 
          </td>
        <td><?php echo $summ_all_out; //$summ1_out.$summ1_out.$summ1_out; ?></td>
        <td><?php //echo "key =".$key_w."=";
		if($is_k_s!='' && in_array($key_w , $main_levels_me) ) {
			 echo $count_cantake_1.$count_cantake_2.$count_cantake_3; 
			 } else if($is_k_s!='' && !in_array($key_w , $main_levels_me) ) {  
			 echo '<span class="tmk_nop">Откройте данный этап для получения коммиссии</span>';
			 }
		 ?></td> 
        </tr>
        
      <?php } ?> 
         <tr> 
          <td colspan="8">
          <div id="tmk_progress"> </div></td>  
        </tr>
      </tbody>
  </table>
     
  </div>
<?php  } /*   ================= список статистики - конец  =================== */?>

<div id="history_pay"  class="adm_tab_block">
  <div class="loading_content"></div>
</div>
<div id="history_comission"  class="adm_tab_block">
  <div class="loading_content"></div>
</div>
 
 </div><!--m_howit-->
        
 <div class="clear"></div>
        
   <div class="separator_red_line"></div>
<?php } ?> 
 <script>

 function load_tables(table){
	 
	 $.ajax({  
							type: "POST",  
							url:  "/user/load_stat/",
							cache: false, 
							data: { 
							   main_lang: main_lang ,							   
							   table: table 
						   },
							success: function(response){  
							  
									$('#'+table).html(response); 
									$('#'+table).fadeIn(300); 
								    
							} 
		 }); 
	 
	 }
	 
 function show_tab(block){
	  if(block=='history_pay' || block=='history_comission') {   load_tables(block); } 
	// console.log("show_tab = "+block);
	 $(".visible_on").removeClass("visible_on");
		 $(".current").removeClass("current");
		 $(".adm_tab_block").hide(200);
		 $("#"+block).show(200);
		 $("#"+block).addClass("visible_on");  
	  	 $("li[path="+block+"]").addClass("current"); 
	 }
	 
 $('.open_close_btn').on("click", function () {
	 var id_this = $(this).data('id'); 
	 //var main_toggle = $(this).data('toggle');  
	 var main_toggle = $(this).attr('data-toggle');  
	 //alert(id_this+" | "+main_toggle);
	 //alert(id_this);
	 // data-toggle
	 if(main_toggle=="closed"){
		 $(".referals"+id_this).show(300);
		 $(this).attr("data-toggle","opened"); 
		 $(this).html("-"); 
	 }
	 if(main_toggle=="opened"){
		 $(".referals"+id_this).hide(300);
		 $(this).attr("data-toggle","closed"); 
		 $(this).html("+");   
	 }
	 
	 return true;
	// alert(id_this);
 });
 
 $('.tmk_ch').on("click", function () {
	 var kq = $(this).data('kq'); 
	 var t = $(this).data('t');  
	 var main_lang = $('.language ul li a.actual').attr('main');	 
	   $("#tmk_progress").html('<div class="loading"> </div>');  
	   $('#tmk_progress').show(200);
	 $.ajax({  
							type: "POST",  
							url:  "/user/tmk_ch/",
							cache: false, 
							data: { 
							   main_lang: main_lang,
							   kq: kq,
							   t: t
						   },
							success: function(response){ 
							 $("#tmk_progress").html(response);  
							var response_obj = $.parseJSON(response);
									if(response_obj.status == '1') { 
									$('#tmk_progress').html(response_obj.message); 
									$('#tmk_progress').fadeIn(300); 
									
									
									setTimeout(function(){ 
									
									//alert("ОППА!!! вот и переход на подтверждение стать БАГАТЫМ!!!") ;
									$('#tmk_progress').html(response_obj.form_callb); 
									//call_form(link, d_t, d_t);
									
									 }, 3000);
									 
									
								   val_go_to_etap = 0;   
									} else if(response_obj.status =='0') {
										$('#tmk_progress').html(response_obj.message); 
										$('#tmk_progress').fadeIn(300); 
										}

							    
							}
							//  "/"+main_lang+
		 }); 
	// alert(id_this);
 });

$('.grouptabs ul li').on('click', function(){  
		 var block = $(this).attr('path');
		// console.log("click = "+block);
		 
		 $.cookie('open_block_ui', block, { expires: 1 }); 
		 show_tab(block); 
		});
		

//var open_block_ui = $.cookie('open_block_ui'); // => undefined
//console.log("open_block_ui cookie = "+$.cookie('open_block_ui'));
if($.cookie('open_block_ui')!=undefined) {  
show_tab($.cookie('open_block_ui')) 
 } else { 
 show_tab('anketa') 
 }
		
// var hash = window.location.hash;
</script>