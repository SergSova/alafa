

<div class="td-caption-top" align="left">Активность на сайте   <?php if($users['total']){echo "(Активных сессий ".$users['total']."  )";} ?></div>

<?php
//$time = time();   
//$time_check = $time - 300 ;
	if (empty($users)){
	echo "Список пуст.";
	} ?>

<div align="center">
<table width="100%"  cellspacing="0" cellpadding="0" align="center" class="listtable">
              <tr> 
                <td class="td-caption-h">Пользователи  ( <span id="user_count_done"></span> )</td>
                <td class="td-caption-h">Гости ( <span id="guests_count_done"></span> ) </td> 
                <td class="td-caption-h">Администраторы и Менеджеры</td>
              </tr>
             
                  <tr> 
                  <td class="type_row" align="left" valign="top">
              <?php
			   $users_count = 0;
			   if (!empty($users['user_list'])): // echo "<pre>"; print_r($users);  
               foreach($users['user_list'] as $uls):    
			    
			   if (!empty($uls['user_data'])){ //  && $uls['last_activity'] > $time_check
					  $info = unserialize($uls['user_data']);
					 // $qq = $info['cart'];
					  $name = '';
					  $style_a = 'tlink'; 
					  // user_status_id user_status_name 
					 // $user_status_id = $info['user_status_id'];
					 // if(isset($info['user_status_id']) && $info['user_status_id']=='1'){$style_a = 'tlink_red';}
					  if(isset($info['user_status_id']) && $info['user_status_id']=='2'){$style_a = 'tlink_green';}
					 // $user_status_name = $info['user_status_name'];
						 if(isset($info['email'])){
							if($info['surname']=='' && $info['name']==''){ 
							$name = $info['email'];
							} 
							else{
								$name = $info['surname']." ".$info['name'];
							} 
								
						   $users_count++;   
						 }
						
						/* for users and cart - begin ====================== */ 
					 
					 
						echo $name."<br>";
						 
					/* for users and cart - end ====================== */ 
						
					} 
				   ?>
            
              <?php endforeach ?>
               
              <?php endif ?> 
              <div id="users_count"  style="display:none"><?=$users_count?></div> 
                  </td>
                  <td class="type_row" align="left" valign="top">
				  <?php $guests_count = 0; $guests_count_width_cart = 0;
				   if (!empty($users['user_list'])): ?>
              	  <?php foreach($users['user_list'] as $uls):?>
		
                  <?php /////////////////////////////    && (substr($uls['user_agent'],'compatible')===false)
				  
				   //  && $adm_ind!="1"
				   $adm_ind = "";
				if (!empty($uls['user_data'])){
					  $info_admin = unserialize($uls['user_data']); 
					 if(isset($info_admin['status']) && ($info_admin['status']=='admin' || $info_admin['status']=='manager')){
						 $adm_ind = 1;
					 // echo $info['username']."<br>";
					 }
					   }
				if ($adm_ind!="1" && !isset($info_admin['email'])) {
				  /////////////////////////////
				  $bot = "";
					// - proverka dla bota - nachalo user_agent $uls['user_agent'] 
					     if  ((strpos($uls['user_agent'],'Yandex')!==false)) { $bot='Yandex'; }
					else if  (strpos($uls['user_agent'],'Google')!==false /*Googlebot*/ || (strpos($uls['user_agent'],'Mediapartners-Google')!==false) || (strpos($uls['user_agent'],'Google Search Appliance')!==false)) {$bot='Google';}
					else if  (strpos($uls['user_agent'],'StackRambler')!==false) {$bot='Rambler';}
				/////////////////	
				
				/////////////////
				   if (!empty($uls['user_data']) && $bot=="" ){ // && $uls['last_activity'] > $time_check  && $adm_ind!="" 
					  $info = unserialize($uls['user_data']); 
						 if(!isset($info['email']) && !isset($info['status'])){
						    $name = "Правильный гость ".$uls['ip_address']; 
							 $name = $uls['ip_address'];
							 echo $name."<br>";  
						  
						 }
					 $guests_count++; // - - - - - 	 
					} else {$name = $uls['ip_address'];
					
				 
					 //  $guests_count++;
					 echo $name."<br>" ;
					 
					 }
					// $guests_count++;
					//echo $name."<br>" ;
				//////////////////////////////
				} /* konets esli ne admin */ ?>
              <?php endforeach ?>
              <?php endif ?> 
               <div id="guests_count" style="display:none"><?=$guests_count?></div> 
              </td>
             <!--  <td class="type_row" align="left" valign="top">
				  <?php $robots_count = 0;  
				   if (!empty($users['user_list'])): ?>
              	  <?php foreach($users['user_list'] as $uls):?>
		 
                  <?php  // if (empty($uls['user_data'])){ 
				  //  && $uls['last_activity'] > $time_check
				  /////////////////////////////  
				    $name = $uls['ip_address'];
					// $robots_count++;
					$bot="";
					// - proverka dla bota - nachalo user_agent $uls['user_agent'] 
					     if  ((strpos($uls['user_agent'],'Yandex')!==false)) { $bot='Yandex'; $robots_count++;}
					else if  (strpos($uls['user_agent'],'Google')!==false /*Googlebot*/ || (strpos($uls['user_agent'],'Mediapartners-Google')!==false) || (strpos($uls['user_agent'],'Google Search Appliance')!==false)) {$bot='Google'; $robots_count++;}
					else if  (strpos($uls['user_agent'],'StackRambler')!==false) {$bot='Rambler'; $robots_count++;}
					//else if  (substr($uls['user_agent'],'MSIE')!==false) {$bot='MSIE'; $robots_count++;}
					// - proverka dla bota - konets MSIE
					if($bot!=""){
						echo $bot." ".$name."<br>" ; 
						}
					 
					// $robots_count++;
					//echo $name."<br>" ;
				//////////////////////////////
				 // }?>
              <?php endforeach ?>
              <?php endif ?> 
               <div id="robots_count" style="display:none"><?=$robots_count?></div>
               
              </td> -->
                  <td align="left" valign="top" class="type_row"> 
                 <?php if (!empty($users['user_list'])): ?>
              <?php foreach($users['user_list'] as $uls):?>
				  <?php  
				 //echo $uls['ip_address']."<br>";
				 // $user = $this->session->userdata
				   if (!empty($uls['user_data'])){
					  $info = unserialize($uls['user_data']); 
					 if(isset($info['status']) && ($info['status']=='admin' || $info['status']=='manager')){
					  echo $info['username']."<br>";
					 }
					   }
				  ?>
              <?php endforeach ?>
              <?php endif ?> 
                </td>
                
              </tr>
               
  </table> 
            
            
            
</div>

<div align="left" style="width:500px;">
 <?php if (!empty($users['user_list'])):
			  //  echo "<pre>"; print_r($users);
			   ?>
              <?php foreach($users['user_list'] as $uls):?>
				  <?php // print ($ma['fio']); customer_cart
				 // echo $uls['ip_address']."<br>";
				 
				  if (!empty($uls['user_data'])){
					  $info = unserialize($uls['user_data']); 
					 if(isset($info['customer_cart']) ){
					//  echo $info['username']."<br>";
					// print_r($info['customer_cart']);
					 }
					   }
				 
				  ?>
              <?php endforeach ?>
              <?php endif ?> 
 </div>
<script type="text/javascript">
$(document).ready(function(){
	// Users
var users_count=document.getElementById('users_count').innerHTML;
document.getElementById('user_count_done').innerHTML = users_count;
// guests_count_done
var guests_count=document.getElementById('guests_count').innerHTML;
document.getElementById('guests_count_done').innerHTML = guests_count;
//guests_count_width_cart
var guests_count_width_cart=document.getElementById('guests_count_width_cart').innerHTML;
document.getElementById('guests_count_width_cart_done').innerHTML = guests_count_width_cart;
});
//robots_count
// robots_count_done
var robots_count=document.getElementById('robots_count').innerHTML;
document.getElementById('robots_count_done').innerHTML = robots_count;
</script>
