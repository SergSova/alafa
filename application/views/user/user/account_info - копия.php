
 

 <?php if (!empty($user_info)){
	// $user_status_discount = $this->session->userdata('user_status_discount');
	  ?>
<div class="m_howit"> <p class="big">Ваша партнерская программа</p>
        	<div class="tabl">
            	<table class="uchet" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td colspan="2">ИНФОРМАЦИЯ УЧЕТНОЙ ЗАПИСИ</td>
                    </tr>
                    <tr>
                    	<td>Имя:</td>
                        <td><?=$user_info['name']?></td>
                    </tr>
                    <tr>
                    	<td>Фамилия:</td>
                        <td><?=$user_info['surname']?></td>
                    </tr>
                    <tr>
                    	<td>E-mail:</td>
                        <td><?=$user_info['email']?></td>
                    </tr>
                    <tr>
                    	<td>Телефон: </td>
                        <td><?=$user_info['phone']?></td>
                    </tr>
                    <tr>
                    	<td>ИНН: </td>
                        <td><?php if($user_info['inn']!='0') { echo $user_info['inn']; } ?></td>
                    </tr>
                    <tr>
                    	<td>Адрес:</td>
                        <td><?=$user_info['town']?></td>
                    </tr>
                     <tr>
                    	<td>Мои открытые уровни:</td>
                        <td><?php if(empty($main_levels)) { // echo "<pre>"; print_r($main_levels); ?>
                        Вы не подтвердили регистрацию
                        <?php }  else { ?>
						<?php $levels_ids_list = implode(", ", $main_levels); echo $levels_ids_list; } ?></td>
                    </tr>
                    
                    <?php if(!empty($user_info['my_actual_levels'])) { ?>
                    <tr>
                    	<td>Ваш персональный код:</td>
                        <td><div class="personal_code">
                          <?php $ref_num = numberFormat($user_info['id'], 6); echo $ref_num;?>
                        </div></td>
                    </tr>
                    <tr>
                    	<td>Ваша партнерская ссылка:</td>
                        <td><div class="personal_link">
                        по-русски <input type="text" value="<?=base_url().'ru/rl/'.$ref_num?>" > 
                        по-украински <input type="text" value="<?=base_url().'ua/rl/'.$ref_num?>" > 
                        </div></td>
                    </tr>
                    <?php  }  else { ?>
                    <tr>
                    	<td colspan="2">Чтобы получить персональный код, подтвердите регистрацию</td>
                    </tr>
                    <?php  } ?>
                    
                </table>
                
               <!-- <a class="like_button" href="<?=lang('main_lang')?>/edit">Редактировать</a>-->
           
            <!--<form action="" method="get">  -->
            <input class="bottom" name="Кнопка" type="button" value="Редактировать" onClick="window.location='/<?=lang('main_lang')?>/user/edit' " />  
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
            	
             <div class="next1"><img class="left" src="/media/css/user/img/icon_point.png" width="20" height="20" />
            <img class="right" src="/media/css/user/img/icon_point.png" width="20" height="20" />
            </div>
            <div class="registr1"><img src="/media/css/user/img/home_1p.png" width="181" height="180" />
              </div>
            
            </div><!--slide-->
            
            <div class="clear"></div>
  <p class="big">Ваш текущий уровень</p>
            
 <div id="go_to_et"></div>
            
<table class="refer all_levels" cellpadding="0" cellspacing="0" align="center">
                 <?php  // echo $user_info['main_levels'];
				  // $main_levels_arr = explode(",", $user_info['main_levels']);
				  /*   if( $user_info['my_level']==0  || $user_info['cur_lev_by_etap1']==0 ) */
			//  echo "<pre>"; print_r($levels_and_count);
				 //  class="level_label" ?>
      <tr>
                	<td><p>Уровень 1</p>
                      <?php if( !in_array( 1,  $main_levels) ) { ?>
                   	  <div  class="like_button" onClick="go_to_etap(1);">Перейти за <strong><?=$levels_and_count[0]['price']?></strong> грн </div><?php }  else {?>
                      <div class="level_opened">открыт</div>
                      <?php } ?>
                      <div class="s_c_refs"><?php if($levels_and_count[0]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[0]['count_my_this_referals'];}?> партнеров</div>
                      <?php if($levels_and_count[0]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/0" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                    </td>
                    <td>
                       <p>Уровень 4</p>
                       <?php if( !in_array( 4, $main_levels) ) { ?>
                   	   <div  class="like_button" onClick="go_to_etap(4);">Перейти за <strong><?=$levels_and_count[3]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                       <div class="s_c_refs"><?php if($levels_and_count[3]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[3]['count_my_this_referals'];}?> партнеров</div>
                       <?php if($levels_and_count[3]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/3" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                    </td>
                    <td>
                        <p>Уровень 7</p>
                        <?php if( !in_array( 7, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(7);">Перейти за <strong><?=$levels_and_count[6]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                        <div class="s_c_refs"><?php if($levels_and_count[6]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[6]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[6]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/6" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                     </td>
                </tr>
                 <?php  // if( $user_info['my_level']!=0) { ?>
    <tr>
    
    <tr>
                	<td>
                        <p>Уровень 2</p>
                        <?php if( !in_array( 2, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(2);">Перейти за <strong><?=$levels_and_count[1]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                       
                        <div class="s_c_refs"><?php if($levels_and_count[1]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[1]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[1]['count_visit_v_zaprose_not_payet']>0) { ?><div class="s_c_refs"> 1 заявка вывода комиссии в обработке</div><?php }  ?>
                       <!-- <div class="s_c_refs"><?php if($levels_and_count[1]['count_visit_v_zaprose_payet']<1) {echo "нет";} else { echo $levels_and_count[1]['count_visit_v_zaprose_payet'];}?> - выводилил с них комиссию</div>-->
                        <?php  $can_vivod = $levels_and_count[1]['count_my_this_referals'] - $levels_and_count[1]['count_visit_v_zaprose_not_payet']*5 - $levels_and_count[1]['count_visit_v_zaprose_payet']*5;  ?>
                        <div class="s_c_refs"><?=$can_vivod?> -  партнеров новых</div>
                        <?php if($can_vivod>=5 && $levels_and_count[1]['count_visit_v_zaprose_not_payet'] < 1) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/2" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                        
                    </td>
                    <td>
                        <p>Уровень 5</p>
                        <?php if( !in_array( 5, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(5);">Перейти за <strong><?=$levels_and_count[4]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                        <div class="s_c_refs"><?php if($levels_and_count[4]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[4]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[4]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/4" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                    </td>
                    <td>
                        <p>Уровень 8</p>
                        <?php if( !in_array( 8, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(8);">Перейти за <strong><?=$levels_and_count[7]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                        <div class="s_c_refs"><?php if($levels_and_count[7]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[7]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[7]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/7" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                     </td>
                </tr>
    <tr>
    
    <tr>
                	<td>
                        <p>Уровень 3</p>
                        <?php if( !in_array( 3, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(3);">Перейти за <strong><?=$levels_and_count[2]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                        <div class="s_c_refs"><?php if($levels_and_count[2]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[2]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[2]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/2" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                    </td>
                    <td>
                        <p>Уровень 6</p>
                        <?php if( !in_array( 6, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(6);">Перейти за <strong><?=$levels_and_count[5]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                        <div class="s_c_refs"><?php if($levels_and_count[5]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[5]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[5]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/5" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                    </td>
                    <td>
                        <p>Уровень 9</p>
                        <?php if( !in_array( 9, $main_levels) ) { ?>
                    	<div  class="like_button" onClick="go_to_etap(9);">Перейти за <strong><?=$levels_and_count[8]['price']?></strong> грн</div><?php }  else {?>
                        <div class="level_opened">открыт</div>
                        <?php } ?>
                        <div class="s_c_refs"><?php if($levels_and_count[8]['count_my_this_referals']<1) {echo "нет";} else { echo $levels_and_count[8]['count_my_this_referals'];}?> партнеров</div>
                        <?php if($levels_and_count[8]['count_my_this_referals']>=5) { ?><div class="s_c_refs_komis"><a href="/<?=lang('main_lang')?>/tmk/8" title="Вывести комиссию">Вывести комиссию</a></div><?php }  ?>
                     </td>
                </tr>
<!--    <tr>
    
    
                	<td><span class="have_this_referals"> <?=$levels_and_count[1]['count_my_this_referals']?> партнеров</span></td>
                    <td>-</td>
                    <td>-</td>
                </tr>-->
                
           <!--     <tr>
                	<td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                	<td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> -->
                <?php // } ?>
  </table>
            
            <br><br><br>
            <table class="refer" cellpadding="0" cellspacing="0">
            	<tr>
                	<td colspan="3"><p class="big">ИНФОРМАЦИЯ ПАРТНЕРСКИХ ЗАПИСЕЙ</p></td>
                </tr>
                <?php if(isset($my_referals_all)) {?>
                <tr>
                	<td class="header_td">Имя партнера</td>
                    <td class="header_td">Текущий уровень</td>
                    <td class="header_td">Дата регистрации</td>
                </tr>
				   <?php  if(!empty($my_referals_all)) {
					   foreach ($my_referals_all as $referal){?>
                   <tr>
                        <td><?=$referal['user']['name'].' '.$referal['user']['surname']?></td>
                        <td><?=$referal['target']?></td>
                        <td><?=date("Y-m-d", $referal['datetime_create'])?></td>
                    </tr> 
                    <?php  } ?>
                    <?php }  else { ?>
                    <tr>
                        <td colspan="3">на данный момент подтвержденные партнерские записи отсутствуют</td>
                    </tr>
                    
				  <?php  } ?>
				<?php } ?>
               <!--  <tr>
                	<td>Василий(вася.ру)</td>
                    <td>21.11.2014</td>
                </tr>
                <tr>
                	<td>Василий(вася.ру)</td>
                    <td>21.11.2014</td>
                </tr>
                <tr>
                	<td>Василий(вася.ру)</td>
                    <td>21.11.2014</td>
                </tr>-->
            </table>
        </div><!--m_howit--><div class="clear"></div>
        
        
   <?php } ?> 
 
 