
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
	
$level_komiss_prc = array(
	"1"=> "25" , 	"2"=> "6" , 	"3"=> "5" ,
	"4"=> "25" , 	"5"=> "6" , 	"6"=> "5" ,
	"7"=> "30" , 	"8"=> "6" , 	"9"=> "5" ,
	"10"=> 0
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

 <?php if (!empty($user_info)){
	// $user_status_discount = $this->session->userdata('user_status_discount');
	  ?>
<div class="m_howit"> <p class="big"><?=lang('main_user_your_partner_progr')?></p>
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
            <input class="bottom" name="btn" type="button" value="<?=lang('main_user_edit_do')?>" onClick="window.location='/<?=lang('main_lang')?>/user/edit' "style="width: 230px;" />  
            <!--<input class="bottom" name="Кнопка" type="button" value="Подтвердить" />-->
            <!--</form>-->
            
            
            
            <div class="clear">
            <?php /*
			echo "<pre>";
			print_r($levels_and_count);
			echo "</pre>"; */
			?>
            
            
            
            </div>
            
            
            </div><!--tabl-->
            <div class="slide">
            	
             <!--<div class="next1"><img class="left" src="/media/css/user/img/icon_point.png" width="20" height="20" />
            <img class="right" src="/media/css/user/img/icon_point.png" width="20" height="20" />
            </div>
            <div class="registr1"><img src="/media/css/user/img/home_4p.png" width="181" height="180" /></div>-->
            <div class="clear my_balance">Мой баланс: 0</div>
            <div class="clear my_balance_get" onClick="window.location='/user/take_my_komission_new'; ">Запросить вывод баланса</div>
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
                	<td class="g_bg"> <p>
                     <div class="etap_slogan"><!--<?=lang('main_user_postroit_teplicu')?>-->Группа 1</div>
					<div align="center"><img src="/media/css/user/img/home_1p.png" width="181" height="180" /></div>
					<?=lang('main_level1')?></p>
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
                       <p>
                      <div class="etap_slogan"><!--<?=lang('main_user_postroit_dom')?>-->Группа 2</div>
					   <div align="center"><img src="/media/css/user/img/home_2p.png" width="181" height="180" /></div>
					   <?=lang('main_level4')?></p>
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
                        <p>
                        <div class="etap_slogan"><!--<?=lang('main_user_postroit_korovnik')?>-->Группа 3</div>                   
                        <div align="center"><img src="/media/css/user/img/home_3p.png" width="181" height="180" /></div>
						<?=lang('main_level7')?></p>
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
<div class="hidden_temp" > <br><br><br> <!--style="display:none;"-->
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
      <td class="header_td" width="5%"></td>
      <td class="header_td" width="5%">#</td>
      <td class="header_td" width="25%"><?=lang('main_user_imya_partn')?></td>
      <td class="header_td" width="25%"><?=lang('main_user_partner_email')?></td>
      <td class="header_td" width="20%"><?=lang('main_user_tekushi_uroven')?></td>
      <td class="header_td" width="20%"><?=lang('main_user_registr_date')?></td>
      </tr>
    <?php  if(!empty($my_referals_all['list'])) { 
				   //echo "<pre>"; print_r($my_referals_all['list']); echo "</pre>";
					   foreach ($my_referals_all['list'] as $referal){?>
    <tr>
      <td><?php if(isset($referal["next_referals"]["total"])) { ?> <div class="open_close_btn" data-id="<?=$referal['id']?>" data-toggle="closed">+</div> <?php } ?></td>
      <td><div class="t_ref_id">
        <?=$referal['id']?>
        </div></td> 
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
      <td><?php if(isset($referal2["next_referals"]["total"])) { ?> <div class="open_close_btn" data-id="<?=$referal2['id']?>" data-toggle="closed">+</div> <?php } ?> </td>
      <td  align="center"><div class="t_ref_id">
        <?=$referal2['id']?>
        </div></td> 
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
      <td> </td>
      <td align="right"><div class="t_ref_id">
        <?=$referal3['id']?>
        </div></td> 
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
  <table width="700" border="0" cellspacing="0" cellpadding="0" class="full_info_tbl">
    <tbody>
      <tr>
        <th rowspan="2">Этапы </th>
        <th colspan="4">Рефералы, кол-во</th> 
        <th  colspan="2">Начислено комиссии</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
      <tr>
        <th>Всего</th>
        <th>Уровень 1</th>
        <th>Уровень 2</th>
        <th>Уровень 3</th>
        <th>За уровень</th>
        <th>Сумма</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
      <?php foreach($level_word_arr as $key_w=>$val_w) { ?> 
      <tr class="row_<?=$key_w?>">
        <td><?=$val_w?></td>
        <td><?=$level_count_refs[$key_w]?></td>
        <td><?=$count_1refs_levels[$key_w]?></td>
        <td><?=$count_2refs_levels[$key_w]?></td>
        <td><?=$count_3refs_levels[$key_w]?></td>
        <td>
          <?php  $is_k_1 = ''; $is_k_2 = ''; $is_k_3 = ''; $is_k_s = ''; $count_cantake_1 =''; $count_cantake_2 =''; $count_cantake_3 ='';
	  if($key_w < 10){
		  if($count_1refs_levels[$key_w]> 0 && $count_1refs_levels[$key_w] % 5 == 0) { 
			  $is_can_count = floor($count_1refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
			  $is_k_s .= "<br>есть комиссия уровня  1";  
			  //$count_cantake_1 = $levels_and_count[$key_w-1]['price']*$level_komiss_prc[$key_w]/100;  
		  }
		  if($count_2refs_levels[$key_w]> 0 && $count_2refs_levels[$key_w] % 5 == 0) { 
			  $is_can_count = floor($count_2refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
			  $is_k_s .= "<br>есть комиссия уровня  2";  
			  //$count_cantake_2 = $levels_and_count[$key_w-1]['price']*$level_komiss_prc[$key_w]/100;  
		  }
		  if($count_3refs_levels[$key_w]> 0 && $count_3refs_levels[$key_w] % 5 == 0) { 
			  $is_can_count = floor($count_1refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
			  $is_k_s .= "<br>есть комиссия уровня  3";  
			  $count_cantake_3 =  '<a href="/<?=lang(\'main_lang\')?>/tmk/'.$key_w.'"  title="<?=lang(\'main_user_vivesti_komissiy\')?>"><?=lang(\'main_user_vivesti_komissiy\')?></a>'; 
			  //$levels_and_count[$key_w-1]['price']*$level_komiss_prc[$key_w]/100;  
		  }
		  
	  }
	  echo $is_k_s;
	  ?>
          
          
          </td>
        <td><?php echo $count_cantake_1.$count_cantake_2.$count_cantake_3; ?></td>
        <td><?php echo $count_cantake_3;?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <?php } ?> 
      </tbody>
  </table>
</div>

        </div><!--m_howit--><div class="clear"></div>
        
   <div class="separator_red_line"></div>
<?php } ?> 
 <script>
 $('.open_close_btn').on("click", function () {
	 var id_this = $(this).data('id'); 
	 var main_toggle = $(this).data('toggle');  //alert(main_toggle);
	 // data-toggle
	 if(main_toggle=="closed"){
		 $(".referals"+id_this).show(300);
		 $(this).attr("data-toggle","opened"); 
		 $(this).html("-"); 
	 }
	 if(main_toggle=="opened"){
		 $(".referals"+id_this).hide(300);
		 $(this).attr("data-toggle","cloced"); 
		 $(this).html("+");   
	 }
	 
	 
	// alert(id_this);
 });
 
	 
</script>