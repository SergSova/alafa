 <b>
<a href="<?php echo base_url();?>manage_bills/order_edit_items/<?php  print ($order[0]['id']);?>" target="_blank" class="tlink" title="Изменить заказ" onclick="return confirmEditOrderItems();" > 
Изменить товары в заказе
</a>
</b>
<br>
 <?php
 
 $offers = array(); 
 $offers = $order[0]['order_items'];
 if(!empty($offers)){
$customer_cart = $offers;
//echo "<pre>"; print_r($customer_cart);
//echo "<pre>"; print_r($this->session->userdata);
//echo "procent".$cdp_discont."<br>";
//echo "procent".$cdp_discont_percent."<br>";
// }
 if (!empty($customer_cart)){ ?>

		 <table width="90%" cellpadding="0" cellspacing="0" class="cart_table" >
            <tr> 
            <th align="left" class="checkout-t-hd">N </th>
            <th align="left" class="checkout-t-hd">Артикул </th>
            <th align="left" class="checkout-t-hd">Продукция </th>
			<th  align="left" class="checkout-t-hd">Стоимость <br>за единицу, грн.</th>
			<th align="left" class="checkout-t-hd">Количество, ед.</th>
            <th align="left" class="checkout-t-hd">Сумма, грн.</th>
            </tr>		
			<?php
			 $counter = 0;
			foreach($customer_cart as $sp):
			$counter++
			?>
          <tr>
          <td align="left"><?=$counter?></td>
          <td align="left"><?php  echo "<b>".$sp['model_articul']."</b>"; ?></td>
		  <td align="left"><?=$sp['model_name']?></td>
	 
		 <td align="center" class="checkout-body-text">
          <?php /* discont for pdp begin */  if($order[0]['user_group']=='1' && $sp['model_promo']!='1'){  
		 // $percent = $pdp_discont;
		//  $count_percent = 1- ($percent/100);
		//  $sp['model_price'] = $sp['model_price']*$count_percent;
		}
		  /* discont for pdp end */?> 
          <?=$sp['model_price']?> 
          <?php /* discont for pdp begin    if($this->session->userdata('user_status_id')=='1' && $sp['model_promo']!='promotional'){  
		  $percent = $this->session->userdata('user_status_discount');
		  $count_percent = 1- ($percent/100);
		  $sp['model_price'] = $sp['model_price']*$count_percent;}
		    discont for pdp end */?>  
		 </td>
	 	<td align="center" class="checkout-body-text"> <?=$sp['model_quantity']?>
	 
    </td>
    <td align="right" class="checkout-body-text">
    <?php echo  $sp['model_price']*$sp['model_quantity'];
	$prosto_summa_v_konce_stroki = $sp['model_price']*$sp['model_quantity'];
	?>
    </td>
  		</tr>
	         <?php endforeach ?>
        <tr>
         <td colspan="5" align="left"><b>Итоговая сумма, грн.:</b></td>
        <td align="right">
        <div class="cart_total">
        <?php  $price_promo = 0;
			foreach($customer_cart as $tovar):
				if($tovar['model_promo']=='1'){
					$price_promo = $price_promo + $tovar['model_price']*$tovar['model_quantity'];	
				}
			endforeach;
		/*  if($order[0]['user_group']=='1'){  
		  $percent = $pdp_discont;
		  $count_percent = 1- ($percent/100);
	     	$price_notpromo = 0;
			foreach($customer_cart as $tovar):
			if($tovar['model_promo']!='1'){
		//	 	$tovar['model_price'] = $tovar['model_price']*$count_percent; 
			$price_notpromo = $price_notpromo + $tovar['model_price']*$tovar['model_quantity'];	
			}
			endforeach;
	
			}*./ /* FOR PDP - End */
		/* -------------- 
		FOR All other customers - begin */
		if ($order[0]['user_group']!='1') {
				$price_notpromo = 0;
				foreach($customer_cart as $tovar):
				if($tovar['model_promo']!='1'){
				$price_notpromo = $price_notpromo + $tovar['model_price']*$tovar['model_quantity'];	
				}
			
			endforeach;
	//		 echo $price_notpromo." - not promo price <br>";
				}

	 	echo $price_promo + $price_notpromo;
 	//echo "<br> promo - ".$price_promo."<br> not promo - ".$price_notpromo;
			?></div>
        </td>
  		</tr>
        
        </table>
 
</b>
<br><br>	
 	<?php }
	
	}else { // endif ?>
	Корзина пуста 
    <?php }?>
