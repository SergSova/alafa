<script type="text/javascript">
 function confirmGenerateNewOrder() {
	if (confirm("Вы уверены, что хотите СОХРАНИТЬ обновлённый список товаров в заказе ??? \n\r После подтверждения данного действия старый заказ будет аннулирован и будет создан новый.\n\r  Пользователь получит соответствующее уведомление на электронную почту.")) {
		return true;
	} else {
		return false;
	}
}
</script>
  <?php
// echo $this->session->userdata('user_status_name')."<br>";
// echo $this->session->userdata('user_status_id')."<br>";
// echo $this->session->userdata('user_status_discount')."<br>";
  
 if(!empty($order_items)){
$customer_cart = $order_items;
//echo "<pre>"; print_r($customer_cart);
//echo "<pre>"; print_r($this->session->userdata);
//echo "procent".$cdp_discont."<br>";
//echo "procent".$cdp_discont_percent."<br>";
// }
 if (!empty($customer_cart)){ ?>
  <form name="form1" method="post" action="<?php echo base_url();?>manage_bills/create_new_items_list_order/" enctype="multipart/form-data" >
    <table width="98%" cellpadding="0" cellspacing="0" class="cart_table" >
      <tr>
        <th align="left" class="checkout-t-hd"></th>
        <th align="left" class="checkout-t-hd">Артикул </th>
        <th align="left" class="checkout-t-hd">Продукция </th>
        <th align="left" class="checkout-t-hd">Стоимость <br>за единицу, грн.</th>
        <th align="left" class="checkout-t-hd">Количество, ед.</th>
        <th align="left" class="checkout-t-hd">Сумма, грн.</th>
       </tr>		
      <?php
			 $counter = 0;
			foreach($customer_cart as $sp):
			$counter++
			?>
      <tr>
        <td align="left">
          <a href="<?php echo base_url();?>manage_bills/delete_from_cart/<?=$order[0]['id']?>/<?php echo $sp['model_id']; ?>"  onclick="return confirmDelete();">
          <img src="../../../media/images/delete.png" width="20" height="20" alt="Удалить из корзины" title="Удалить из корзины" border="0" />
          </a>
          
        </td>
        <td align="left">
          <?php  echo "<b>".$sp['model_articul']."</b>"; ?>
        </td>
        <td align="left">
          <?=$sp['model_name']?>
          <input name="cart[<?=$counter?>][color]" type="hidden" id="type"  value="<?=$sp['model_color']?>"  />
          <input name="cart[<?=$counter?>][id_order]" type="hidden" id="type"  value="<?=$sp['id_order']?>"  />
          <input name="cart[<?=$counter?>][model_id]" type="hidden" id="id"  value="<?=$sp['model_id']?>"  />
          <input name="cart[<?=$counter?>][model_name]" type="hidden" value="<?php  print ($sp['model_name']);?>" />
          <input name="cart[<?=$counter?>][promo]" type="hidden" id="promo"  value="<?php  print ($sp['model_promo']);?>"  />
          <input name="cart[<?=$counter?>][model_articul]" type="hidden" value="<?php  print ($sp['model_articul']);?>" />
        </td>
        
        <td align="left" class="checkout-body-text">
          <?php /* discont for pdp begin */  if($order[0]['user_group']=='1' && $sp['model_promo']!='1'){  
		//  echo "pdp";
		//  $percent = $pdp_discont;
		//  $count_percent = 1- ($percent/100);
		 // $sp['model_price'] = $sp['model_price']*$count_percent;
		 }
		  /* discont for pdp end */?> 
          <?=$sp['model_price']?>
          <input type="hidden" name="cart[<?=$counter?>][model_price]" value="<?=$sp['model_price']?>" />
        </td>
        <td align="center" class="checkout-body-text">
          
          <select name="cart[<?=$counter?>][quantity]" id="quantity">
            
            <?php for($i=1; $i<=6; $i++){ ?>
            <option value="<?=$i?>"  <?php if($sp['model_quantity'] == $i){ echo ' selected="selected" ';}  ?>><?=$i?></option>
            <?php } ?>
          </select>   
        </td>
        <td align="right" class="checkout-body-text">
          <?php echo  $sp['model_price']*$sp['model_quantity'];?>
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
					//if($tovar['model_promo']=='promotional'){
				//	$price_promo = $price_promo + $tovar['model_price']*$tovar['model_quantity'];	//$sp['model_price']
				$price_promo = $price_promo + $tovar['model_price']*$tovar['model_quantity'];	 
				}
			endforeach;
		  if($order[0]['user_group']=='1'){  
		//  $percent = $pdp_discont;
		//  $count_percent = 1- ($percent/100);
	     	$price_notpromo = 0;
			foreach($customer_cart as $tovar):
			if($tovar['model_promo']!='1'){
			 //	$tovar['model_price'] = $tovar['model_price']*$count_percent; 
			$price_notpromo = $price_notpromo + $tovar['model_price']*$tovar['model_quantity'];	
			}
			endforeach;
	
			} /* FOR PDP - End */
		/* -------------- 
		FOR All other customers - begin */
		if ($order[0]['user_group']!='1') {
				$price_notpromo = 0;
				foreach($customer_cart as $tovar):
				if($tovar['model_promo']!='1'){
				$price_notpromo = $price_notpromo + $tovar['model_price']*$tovar['model_quantity'];	
				}
			
			endforeach;
	 		// echo $price_notpromo." - not promo price <br>";
			// echo $price_promo." -   promo price <br>";
				}

	 	echo $price_promo + $price_notpromo;
//	echo "promo - ".$price_promo."<br> not promo - ".$price_notpromo;
			?></div>
        </td>
      </tr>
      <?php 	if(isset($cdp_discont)){ ?>
      <tr>
        <td colspan="5" align="left"><b>Ваша скидка составляет, грн.: <?php echo $cdp_discont_percent."%"; ?>  </b></td>
        <td align="right">
          <?php  
				echo $price_promo + ($price_notpromo - $price_notpromo*$cdp_discont);
				?>
          </td>
       </tr> 
      <tr>
        <td colspan="5" align="left"><b>Итого к оплате с учётом скидки, грн.: </b></td>
        <td align="right">
          <div class="cart_total">
            <?php   echo $price_promo + $price_notpromo*$cdp_discont;?>
            </div>
          </td>
       </tr>
      <?php } ?>
      </table>
    <div align="center">
    <input type="hidden" name="order_id" value="<?=$order[0]['id']?>" />
      <input name="submit_math"  type="submit" class="button"  value="Пересчитать сумму" />
      <input name="submit_checkout"  type="submit" class="button"  value="Сохранить обновлённый список"  onclick="return confirmGenerateNewOrder();" />
      </div>
    </form>
  <?php }
	
	}else { // endif ?>
  Корзина пуста 
  <?php }?>
 
