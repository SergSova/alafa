<br>
 <?php
$providers_names_bp = array(
        '1parfum_price'=>"1Parfum",
		'podol_price'=>"Podol",
        'ostatki1_price'=>"2_Ostatki1",
        'parfex_price'=>"Parfex",
        'svesta_price'=>"Svesta",
        'alla_price'=>"Alla",
        'badagra_price'=>"Badagra",
		'bp_price'=>"BP",
		'delis_price'=>"9.Delis",
		'troeschina_price'=>"Troeschina",
		'raritet_price'=>"Raritet",
		'berkana_price'=>"Berkana",
		'posuda_price'=>"Posuda",
		'dzintars_price'=>"Dzintars", 
		'ostalnoe_price'=>"Ostalnoe",
		'central_price'=>"Central",
		'panparfum_price'=>"Panparfum" ,
		'topparfum_price'=>"TopParfum",
		'dnepr2k_price'=>"Dnepr2k",
		'intuitionpodol_price'=>"IntuitionPodol" ,
		'ivman_price'=>"23.Ivman" 
         );
		  
 $products = array(); 
 $products = $order_items;
 $order =  $order_id;
 if(!empty($products)){
$customer_cart = $products; 
 if (!empty($customer_cart)){ ?>
<?php 
 $user_status_cdp_sum = 0;
 $user_status_discount = 0;
  
 $user_status_discount = $order['cdp_discont_percent'];

 $all_to_pay_summ = 0;
 $notpromo_w_d = 0;
 ?>

	 <form name="cart_form" id="cart_form" enctype="multipart/form-data" >       
		 <table width="98%" cellpadding="0" cellspacing="0" class="cart_table" >
            <tr>
            <th align="left" class="checkout-t-hd left"></th>
            <th align="left" class="checkout-t-hd left">Артикул</th>
            <th align="left" class="checkout-t-hd left">Наименование</th>
            <th align="left" class="checkout-t-hd">Цена</th>
            <th align="left" class="checkout-t-hd">Кол-во</th>
			<th align="left" class="checkout-t-hd right"><!--<?=lang('main_do_delete')?> --></th>
            </tr>		
			<?php
			 $counter = 0;
			foreach($customer_cart as $sp):
			$counter++
			?>
          <tr>
          <td align="left"> <?php if (isset($sp['model_picture']) && $sp['model_picture']!='' && file_exists($sp['model_picture'])) { ?> 
		  <img src="<?=base_url()?><?=$sp['model_picture']?>" width="50" border="0" align="left" />
		  <?php } ?></td>
          <td align="left"><div class="product_code"> <?=$sp['model_articul']?></div>
           
          </td>
          <td align="left">
         
          <div class="product_name"><?=$sp['model_name']?>
           <?php if ($sp['model_promo']=='1'){echo "<span title='Товар акционный'>*</span>";} ?>
          </div> 
          
          </td>
           <td align="center" class="checkout-body-text"> 
		 <?=$sp['model_price']?> 
		 </td>
         
         <td align="center" class="checkout-body-text"> 
          <div style="font-size:14px; "> 
           <?=$sp['model_quantity']?>
          </div> 
   		 </td> 
	<td class="delete" align="left"><!--<?=$sp['model_id']?> -->
        
        <?php 
		
		 $providers_names = array(
        '1parfum_code'=>"1Parfum",
		'podol_code'=>"Podol",
        'ostatki1_code'=>"2_Ostatki1",
        'parfex_code'=>"Parfex",
        'svesta_code'=>"Svesta",
        'alla_code'=>"Alla",
        'badagra_code'=>"Badagra",
		'bp_code'=>"BP",
		'delis_code'=>"9.Delis",
		'troeschina_code'=>"Troeschina",
		'raritet_code'=>"Raritet",
		'berkana_code'=>"Berkana",
		'posuda_code'=>"Posuda",
		'dzintars_code'=>"Dzintars", 
		'ostalnoe_code'=>"Ostalnoe",
		'central_code'=>"Central" ,
		'panparfum_code'=>"Panparfum",
		'topparfum_code'=>"TopParfum",
		'dnepr2k_code'=>"Dnepr2k",
		'intuitionpodol_code'=>"IntuitionPodol" 
         );
		 
		 $providers_names_bp = array(
        '1parfum_price'=>"1Parfum",
		'podol_price'=>"Podol",
        'ostatki1_price'=>"2_Ostatki1",
        'parfex_price'=>"Parfex",
        'svesta_price'=>"Svesta",
        'alla_price'=>"Alla",
        'badagra_price'=>"Badagra",
		'bp_price'=>"BP",
		'delis_price'=>"9.Delis",
		'troeschina_price'=>"Troeschina",
		'raritet_price'=>"Raritet",
		'berkana_price'=>"Berkana",
		'posuda_price'=>"Posuda",
		'dzintars_price'=>"Dzintars", 
		'ostalnoe_price'=>"Ostalnoe",
		'central_price'=>"Central",
		'panparfum_price'=>"Panparfum",
		'topparfum_price'=>"TopParfum",
		'dnepr2k_price'=>"Dnepr2k",
		'intuitionpodol_price'=>"IntuitionPodol",
		'ivman'=>"23.Ivman"  
         );
		 
		  $providers_ids = array(
		  '1parfum_code'=>"1",
		'podol_code'=>"2",
        'ostatki1_code'=>"4",
        'parfex_code'=>"3",
        'svesta_code'=>"5",
        'alla_code'=>"6",
        'badagra_code'=>"7",
		'bp_code'=>"8",
		'delis_code'=>"9",
		'troeschina_code'=>"10",
		'raritet_code'=>"11",
		'berkana_code'=>"12",
		'posuda_code'=>"13" ,
		'dzintars_code'=>"14", 
		'ostalnoe_code'=>"15",
		'central_code'=>"16",
		'panparfum_code'=>"17" ,
		'topparfum_code'=>"19",
		'dnepr2k_code'=>"18" ,
		'intuitionpodol_code'=>"20" ,
		'ivman_code'=>"21" 
         );
		 
		$providers_ids_bp = array(
        '1parfum_price'=>"1",
		'podol_price'=>"2",
        'ostatki1_price'=>"4",
        'parfex_price'=>"3",
        'svesta_price'=>"5",
        'alla_price'=>"6",
        'badagra_price'=>"7",
		'bp_price'=>"8",
		'delis_price'=>"9",
		'troeschina_price'=>"10",
		'raritet_price'=>"11",
		'berkana_price'=>"12",
		'posuda_price'=>"13",
		'dzintars_price'=>"14", 
		'ostalnoe_price'=>"15",
		'central_price'=>"16",
		'panparfum_price'=>"17",
		'topparfum_price'=>"19",
		'dnepr2k_price'=>"18",
		'intuitionpodol_price'=>"20" ,
		'ivman_price'=>"21"  
         );
		 
		 $providers_id_to_name = array(
        '1'=>"1parfum",
		'2'=>"podol",
        '4'=>"ostatki1",
        '3'=>"parfex",
        '5'=>"svesta",
        '6'=>"alla",
        '7'=>"badagra",
		'8'=>"bp",
		'9'=>"delis",
		'10'=>"troeschina",
		'11'=>"raritet",
		'12'=>"berkana",
		'13'=>"posuda",
		'14'=>"dzintars", 
		'15'=>"ostalnoe",
		'16'=>"central",
		'17'=>"panparfum",
		'19'=>"topparfum",
		'18'=>"dnepr2k",
		'20'=>"intuitionpodol",
		'21'=>"ivman"  
         ); 
		 ?>
         
         
     <!-- <select name="set_provider_prices_<?=$sp['id']?>" id="set_provider_prices_<?=$sp['id']?>" >
      <option value="0" disabled="disabled" selected="selected">Поставщик</option>   -->
   <?php $is_in_sklad = 0; foreach ($sp['provider_prices'] as $provider_key => $value) { 
	 if(is_numeric($value) && $value > 0 && strpos( $provider_key, "code") === false ){ ?>
            
          
	   <?php  if (isset($sp['provider']) && $sp['provider']==$providers_ids_bp[$provider_key]){ $is_in_sklad = 1;  ?>  <?="".$value." &rarr;  ".$providers_names_bp[$provider_key]." "?>
       <?php } } ?> 
	    
	   <?php } ?>  
       
        <?php if($sp['provider']!= '0' && $is_in_sklad=='0') { ?> <?=$sp['provider_price']." &rarr;  ".$providers_id_to_name[$sp['provider']]."  ----- ! (нет у поставщика) ! "?>  <?php } ?> 
        
     <!-- </select>    -->
        </td>
  		</tr>
	         <?php endforeach ?>
 
        </table>
	 </form>	 
 	<?php   }
	
	} else { // endif ?>
    Корзина пуста 
    <?php }?> 