<?php $this->load->view('user/header');?>
 
 <?php  
	$uriki_vid = array(
	"fop"=>  lang('main_user_uriki_vid_sobs_fop') ,
	"pp"=>  lang('main_user_uriki_vid_sobs_pp') ,
	"tov"=>  lang('main_user_uriki_vid_sobs_tov') 
	);         
 
	$nalog_sys = array(
	1=>  lang('main_user_uriki_nalog_sys_1') ,
	2=>  lang('main_user_uriki_nalog_sys_2') ,
    3=>  lang('main_user_uriki_nalog_sys_3') ,
    4=>  lang('main_user_uriki_nalog_sys_4') ,
    5=>  lang('main_user_uriki_nalog_sys_5') ,
	6=>  lang('main_user_uriki_nalog_sys_6') 
	);       
	
	 $user = $this->session->userdata;
 ?>

<div id="global">
<?php /*?>	<div class="top">
    	<div class="m_top"> 
            
        </div><!--m_top-->
    </div><!--top--><?php */?>
    
    <div class="header">
    
    <div class="wide_bg_m">
      <div class="m_header">
      <div class="logo fl"><a href="/<?=lang('main_lang')?>"><img src="/media/css/user/img/alafa.png" height="50" /> <span class="logo_h">АЛАФА</span></a></div> 
        <div class="menu fl">
          <ul>
            <?php   $count_pages = count($pages);  
				 for($i=0; $i<$count_pages; $i++){
					if($pages[$i]['show_top']=='1'){ 
					 $url = lang('main_lang')."/".$pages[$i]['url'];  
                  if($pages[$i]['id']=='1'){$url = lang('main_lang');}  
				  if($pages[$i]['module']=='gallery'){$url = lang('main_lang').'/gallery';}  
                  if($pages[$i]['module']=='documents'){$url = lang('main_lang').'/documents';} 
				  if($pages[$i]['module']=='reviews'){$url = lang('main_lang').'/reviews';}  
				  if($pages[$i]['module']=='news'){$url = lang('main_lang').'/news';}  
                   ?>
            <li><a href="<?php echo base_url();?><?=$url?>" class="menu <?php if (isset($current_page) && $current_page==$pages[$i]['id']) {echo 'active';} ?>" ><?=$pages[$i]['menu_name']?></a></li>
            <?php } 
				   } ?>   
            </ul>
          </div><!--menu-->
          
          
        
        
        <div class="language fr">
          <span id="main_lang"><?=lang('main_lang')?></span>
          <ul> <?php $qqq = substr ($_SERVER['REQUEST_URI'], 3);   $lang = $this->uri->segment(1);     if($lang=='')$lang = 'ru'; ?> 
            <li><a  main="ua"  href="<?=base_url()?>ua<?=$qqq?>" <?php if($lang=='ua'){echo 'class="actual"';}?> title="Перейти на Українську" >укр</a></li> 
            <li><a main="ru" href="<?=base_url()?>ru<?=$qqq?>"  <?php if($lang=='ru'){echo 'class="actual"';}?> title="Перейти на русский язык" >рус</a></li>
            <!-- <li><a  main="en"  href="<?=base_url()?>en<?=$qqq?>" <?php if($lang=='en'){echo 'class="actual"';}?> title="Go to English" >eng</a></li> --> 
            </ul>
          </div><!--lang-->
          <div class="logo_fond fr"><noindex><img src="/media/css/user/img/logo_fond_md_<?=lang('main_lang')?>.png" height="44" /></noindex></div>
            <?php /*?><div class="logo_fond"><noindex><a href="http://www.mid.org.ua" target="_blank"><img src="/media/css/user/img/logo_fond_md_<?=lang('main_lang')?>.png" height="70" /></a></noindex></div><?php */?>
        
        <div class="clear"></div>
      </div>
    </div>
 
    </div><!--header-->    <div class="clear"></div>
  <?php if(isset($index)) { ?><div class="slider_12"> </div><?php } ?>
  
  
  <?php if(isset($index) && ( !isset($user['email']) || !isset($user['user_id']))) { //echo $user['email']."  === ".$user['user_id']; ?>
   <div class="wide_green_bg">
            <div class="m_video">
                <div class="video"><?php  if (isset($blocks[7]) && $blocks[7]['text']!='' && $blocks[7]['text']!='&nbsp;'){ echo $blocks[7]['text'];  }  ?></div>
                <div class="opis"><?php  if (isset($blocks[8]) && $blocks[8]['text']!='' && $blocks[8]['text']!='&nbsp;'){ echo $blocks[8]['text'];  }  ?></div>
                <div class="clear"></div>
            </div> <!--mvideo-->
  		</div>
        <?php } ?>
        
<div class="red">
    	<div class="m_red">
       <div class="do_some_buttons"> 
       <?php
	    if (!isset($user['email']) || !isset($user['user_id'])) { ?>
         <div class="go_to_login_form" onClick="show_all_login();"><?=lang('main_user_go_to_kabinet')?></div>
         <?php  } else { ?>
         <div class="go_to_login_form" onClick="window.location='/<?=lang('main_lang')?>/logout' "><?=lang('main_user_logout')?></div>
         <div class="go_to_login_form"  onClick="window.location='/<?=lang('main_lang')?>/user'  "><?=lang('main_user_account')?></div>
         <div class="clear"></div>   
         <?php  } ?>
         <!--<div class="go_to_reg_form"><?=lang('main_user_do_reg_1')?></div>-->
       </div>
       <!-- 0000000000000000000000000000000000000000000000000000000000000000000000000000 --> 
       
        	<div class="text">
                <div class="some_te login_text"><?php  if (isset($blocks[0]) && $blocks[0]['text']!='' && $blocks[0]['text']!='&nbsp;'){ echo $blocks[0]['text'];  }  ?></div>
                <div class="some_te register_text"><?php  if (isset($blocks[1]) && $blocks[1]['text']!='' && $blocks[1]['text']!='&nbsp;'){ echo $blocks[1]['text'];  }  ?></div>
                <div class="some_te forget_text"><?php  if (isset($blocks[2]) && $blocks[2]['text']!='' && $blocks[2]['text']!='&nbsp;'){ echo $blocks[2]['text'];  }  ?></div>
            </div><!--text-->
            
            <div class="fullform">
            <div class="forma login_form">
 <fieldset>
            
                <form class="login_form" method="post" action="<?php echo base_url();?>login/loginSubmit" enctype="multipart/form-data" name="myform_login" id="myform_login">
                  <div align="center"><span><?=lang('main_user_reg_and_take_code')?></span></div>
                    <input name="username" type="text" placeholder="<?=lang('main_user_login')?>" required  />
                    <input name="pword" type="password" placeholder="<?=lang('main_user_parol')?>" required  />
                    <input name="lang"  type="hidden" value="<?=lang('main_lang')?>" />
                    <div id="try_auth_response" class="info_form_box" align="center"></div> 
                    <div align="center"><input class="bottom" name="btn_login" type="submit" value="<?=lang('main_vhod')?>" /></div>
                </form>
 </fieldset>
            	<div class="hrefs">
                	<a class="link_reg" onClick="do_regist();" href="javascript:void(0);"><?=lang('main_user_do_reg_1')?></a> 
                    <a class="forget_reg" onClick="do_forget();"  href="javascript:void(0);"><?=lang('main_user_forget_pass_q')?></a>
                </div><!--hrefs-->
                
            </div><!--forma-->
 <div class="forma register_form">
 <?php
$referal_id = get_cookie('2shans_referal_id');
if(isset($referal_code)) {$referal_id = $referal_code ; }
 
 ?>
 <fieldset>               
            <form class="register_form" method="post" action="<?php echo base_url();?>login/addregister" enctype="multipart/form-data" name="myform_regist" id="myform_regist">
                    <div align="center"><span><?=lang('main_user_reg_and_take_code1')?></span></div>
                    
                    <div class="for_fiz_l" onClick="action_register_form_fiziki_on();"><span class="activ_type"><?=lang('main_user_reg_fizlic')?></span></div>
                    <!--<div class="for_ur_l" onClick="action_register_form_uriki_on();"><span ><?=lang('main_user_reg_urlic')?></span></div>-->
                    
              <input name="referal" type="text"  value="<?php  if(isset($referal_id) && $referal_id!='') { echo $referal_id; $is_ref=1; } ?>" <?php if(isset($is_ref)) echo " readonly "; ?> placeholder="<?=lang('main_user_code_partnera')?>"   />  
                    <input name="name" type="text" value="" placeholder="<?=lang('main_form_name')?>" required  />
                     
                    <input name="email" type="text" placeholder="Email" required  />
                    <input name="pword" type="password" placeholder="<?=lang('main_user_parol')?>"  title="<?=lang('main_user_parol')?>" required  />
                    <input name="re_pword" type="password" placeholder="<?=lang('main_user_povtorite_parol')?>" title="<?=lang('main_user_povtorite_parol')?>"   required />
                    <div align="left" class="p_policy">
                  <input type="checkbox" name="policy"><?=lang('main_user_i_agree_1_q')?></div>
                <input name="lang"  type="hidden" value="<?=lang('main_lang')?>" />
                <input name="urik"  type="hidden" value="0" />
              <div id="try_reg_response" class="info_form_box"  align="center"></div>
                <div align="center"><input class="bottom" name="btn_reg" type="submit" value="<?=lang('main_user_do_reg_1')?>" /></div>
               
              </form>
</fieldset>
            	<div class="hrefs"> 
                    <a class="link_login" onClick="do_login();"  href="javascript:void(0);"><?=lang('main_user_do_enter')?></a>
                    <a class="link_forget" onClick="do_forget();"  href="javascript:void(0);"><?=lang('main_user_forget_pass_q')?></a>
                </div><!--hrefs-->
                
            </div><!--forma-->
<div class="forma forget_form">
            <fieldset>                
                <form class="forget_form" method="post" action="<?php echo base_url();?>login/remind_password" enctype="multipart/form-data" name="myform_forget" id="myform_forget">
                    <div align="center"><span><?=lang('main_user_napomnit_parolr')?></span></div>
                    <input name="email" type="text" placeholder="Email" /> 
                    <input name="lang"  type="hidden" value="<?=lang('main_lang')?>" />
                    <div id="try_forget_response" class="info_form_box"  align="center"></div> 
                    <div align="center"><input class="bottom" name="btn_fg" type="submit" value="<?=lang('main_user_vislat_novy_parol')?>" /></div>
                </form> 
            </fieldset>
            	<div class="hrefs">
                	<a class="link_reg" onClick="do_regist();"  href="javascript:void(0);"><?=lang('main_user_do_reg_1')?></a>
                    <a class="link_login" onClick="do_login();"  href="javascript:void(0);"><?=lang('main_user_do_enter')?></a> 
                </div><!--hrefs-->
                
            </div><!--forma-->
            
            
            
            <div class="waveline"></div>
    <div class="clear"></div>       
            </div><!-- fullform--><div class="clear"></div>
       
       
       
       
     <!-- 11111111111111111111111111111111111111111111111111111111111111111111 -->   
       
       
       
            
      </div><!--m_red-->
      <div class="clear"></div>
    </div><!--red--><div class="clear"></div>
    
    <div class="howitworks">
    <?php if(isset($index)) { ?>
    
    	<div class="m_howit"> 
        	<!--КАК ЭТО РАБОТАЕТ-->
            <?php  if (isset($blocks[9]) && $blocks[9]['text']!='' && $blocks[9]['text']!='&nbsp;'){ echo $blocks[9]['text'];  }  ?> 
        </div><!--m_howit-->
        
        
        
        <div class="clear"></div>
        <?php   if(isset($index)  && ( isset($user['email']) || isset($user['user_id']) )) { // ) && ( !isset($user['email']) || !isset($user['user_id']) ?>
  <div class="wide_green_bg">
            <div class="m_video">
                <div class="video"><?php  if (isset($blocks[7]) && $blocks[7]['text']!='' && $blocks[7]['text']!='&nbsp;'){ echo $blocks[7]['text'];  }  ?></div>
                <div class="opis"><?php  if (isset($blocks[8]) && $blocks[8]['text']!='' && $blocks[8]['text']!='&nbsp;'){ echo $blocks[8]['text'];  }  ?></div>
            </div> <!--mvideo-->
  		</div>
        <?php }  ?>
<?php if ((isset($template_top) && !empty($template_top)) ){ ?> 
               		<div class="m_howit">
               		  <?php  $this->load->view('user/'.$template_top);?> 
	  </div>
<?php } ?>
        
      <div class="clear"></div>
        
        <?php } ?> 
        <?php if(!isset($index)) { ?>
				<div class="m_howit">
				  <?php if ((isset($template_top) && !empty($template_top)) ){ ?> 
				  <?php  $this->load->view('user/'.$template_top);?> 
				  <?php } ?>
				  <?php if ((isset($template) && !empty($template) ) ){ ?> 
				  <?php  $this->load->view('user/'.$template);?> 
				  <?php } ?>
	  </div>
        <?php }   ?>
      <div class="clear"></div>
   
      
        <div class="prom_box_block">
        <!--РЕКЛАМА--> 
    <?php  if (isset($blocks[5]) && $blocks[5]!='' && $blocks[5]['text']!='' && $blocks[5]['text']!='&nbsp;'){ echo $blocks[5]['text'];  }  ?> 
        	<!--<p>Рекламное место</p>
            <div class="pic"><img src="/media/css/user/img/img_reklam.jpg" width="640" height="480" /></div>-->
        </div> <!--prom_box_block-->
        
    </div><!--howitw-->
    
    
    <div class="footer">
    	<div class="m_footer">
        <div class="navigate_bot">
        
         <div class="menu">
            	<ul>
                 <?php   $count_pages = count($pages);  for($i=0; $i<$count_pages; $i++){
					if($pages[$i]['note']!='partners'){ 
					 $url = lang('main_lang')."/".$pages[$i]['url'];  
                  if($pages[$i]['id']=='1'){$url = lang('main_lang');}  
				  if($pages[$i]['module']=='gallery'){$url = lang('main_lang').'/gallery';}  
                  if($pages[$i]['module']=='documents'){$url = lang('main_lang').'/documents';} 
				  if($pages[$i]['module']=='reviews'){$url = lang('main_lang').'/reviews';}  
				  if($pages[$i]['module']=='news'){$url = lang('main_lang').'/news';}  
                   ?>
                   <li><a href="<?php echo base_url();?><?=$url?>" class="menu <?php if (isset($current_page) && $current_page==$pages[$i]['id']) {echo 'active';} ?>" ><?=$pages[$i]['menu_name']?></a></li>
                   <?php } 
				   } ?>   
                </ul>
            </div><!--menu-->
        
        </div> <!-- ...  -->
<div class="prava"> 
	    <div class="fl"> <?=lang('main_user_all_rights_res')?> </div>         
          </div><!--/prava-->
 
            <div class="media"> 
            <div class="med"><!--Мы в медиа:   --></div>
            <a href="https://www.facebook.com/Alafa-1212047205513655/"><img src="/media/css/user/img/icon_f.png" width="34" height="34" /></a>
            <a href="https://www.instagram.com/alafa.alafa/"><img src="/media/css/user/img/icon_instagram.png" width="34" height="34" /></a>
            <a href="https://www.youtube.com/channel/UCX_ltIoiwhacMtlCcwQRoNw"><img src="/media/css/user/img/icon_youtube.png" width="34" height="34" /></a>
            <a href="https://new.vk.com/alafadobro"><img src="/media/css/user/img/icon_vk.png" width="34" height="34" /></a> 
            <a href="http://wallet.advcash.com/referral/3b959503-84d7-47cd-abb4-c6d28494274b" target="_blank"><img src="/media/images/promo_ru/paylogo.gif" height="32" /></a>
            </div>
          <div class="clear"></div>
        </div><!--m_footer-->
        <div class="clear"></div>
    </div><!--footer-->
</div> <!--global-->

<script> 

count_now_users() ;

 setInterval(function() {   
 count_now_users() ;
  }, 30000);
		
<?php if(isset($index)  || (!isset($user['email']) || !isset($user['user_id'])) && !isset($referal_registration) ) { ?>

//$(".forma").show(800);
$(".login_text").show(700);
$(".login_form").show(600);
 
<?php } 
if(isset($referal_registration)) { ?>
do_regist();
<?php } ?>  
//************************************************	
 //$(document).ready(function(){
	 
<?php if(!isset($index) || (isset($user['email']) && isset($user['user_id']))   ) {  ?>

 $(".red").addClass('red_inside_page');
 //$('.waveline').hide();
//alert('inside page');

 <?php } ?>  
 //   });
</script> 


</body>
</html>


<?php   $this->session->sess_update_time();  ?>
<?php
    
$ip = array("109.86.137.253", "93.73.54.100"); 
$this_site = parse_url(base_url());


if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!='' && !in_array($_SERVER['REMOTE_ADDR'], $ip) ){ 
    $this_host = $_SERVER['HTTP_HOST'];
    $trafic_from = parse_url($_SERVER['HTTP_REFERER']);
    if($trafic_from['host']!=$this_host){
        $data_stat['ip'] = $_SERVER['REMOTE_ADDR'];
        $data_stat['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data_stat['url_from'] = $_SERVER['HTTP_REFERER'];
        $data_stat['url_to'] = $_SERVER['REQUEST_URI'];
        $data_stat['domain_from'] = $trafic_from['host'];
        $this->model_user->Trafic_Add($data_stat);
        }
    }
     
if (!isset($_SERVER['HTTP_REFERER']) && !in_array($_SERVER['REMOTE_ADDR'], $ip) ){
	 
    $this_host = $_SERVER['HTTP_HOST'];
     
        $data_stat['ip'] = $_SERVER['REMOTE_ADDR'];
        $data_stat['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data_stat['url_from'] = "n/a";
        $data_stat['url_to'] = $_SERVER['REQUEST_URI'];
        $data_stat['domain_from'] = "n/a";
         $this->model_user->Trafic_Add($data_stat); 
    }    
?>
<?php $this->session->set_userdata('offers_page_redirect', $_SERVER['REQUEST_URI']); ?>  
<?php $user = $this->session->userdata;
	if (isset($user['email'])){$doe = '1';
	
	//print_r($user);
	 } 
 
	//echo "<pre>";
	//print_r($this->session->userdata);
	//echo "</pre>";
	?> 