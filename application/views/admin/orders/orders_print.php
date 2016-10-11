<?php $this->load->view('admin/print_header');?>
<div align="center">
  <div id="print_page"> 
  <div align="center" class="td-caption-top">Квитанция № <b><?=$order_list['id']?></b></div> 
<!--<div align="center">Квитанция № <b><?=$order_id?></b></div> -->
<hr>
<br>
<div align="center">
  <div align="center" id="content" class="cart_table"  style="width:90%;">
    <?php
 $id_order = $order_list['id'];
 $id_user = $order_list['id_user'];
 $date_order = $order_list['date_order'];
 $name = $order_list['name'];
 $surname = $order_list['surname'];
 $byfather = $order_list['byfather'];
 $region = $order_list['region'];
 $town = $order_list['town'];
 $adres = $order_list['adres'];
 $postindex = $order_list['postindex'];
 $email = $order_list['email'];
 $phone = $order_list['phone'];
 $note = $order_list['note'];
 $total_sum = $order_list['total_sum'];
 $total_sum_to_pay = $order_list['total_sum_to_pay'];
 $cdp_discont_percent = $order_list['cdp_discont_percent'];
 $cdp_skidka = $order_list['cdp_skidka'];
 $user_group_name = $order_list['user_group']['name'];
 $user_group_id = $order_list['user_group']['id'];
 $user_group_descr = $order_list['user_group']['descr'];
 

 $delivery_to = $order_list['delivery_to']; // 1- kiev, 2- ne kiev
 if($order_list['delivery_to']=='1'){$delivery_to = 'Киев';
	 if($order_list['delivery_method']=='1'){$delivery_method = 'Самовывоз';}
	 if($order_list['delivery_method']=='2'){$delivery_method = 'Доставка Курьером';}
 }
 if($order_list['delivery_to']=='2'){$delivery_to = 'регион страны ';
 $delivery_method = '';
 }
 
	if($order_list['delivery_service']=='0'){
	  $delivery_service = '';
	}else{$delivery_service = $order_list['delivery_service'];}
 $delivery_sklad = $order_list['delivery_sklad'];
 $delivery_cost = $order_list['delivery_cost'];
 $payment_method = $order_list['payment_method'];
 
 
	 if($order_list['payment_type']=='1'){$payment_type = 'Наличный расчёт';}
	 if($order_list['payment_type']=='2'){$payment_type = 'Безналичный расчёт';}
 
 
 $offers_list = $order_list['order_items'];
 $offers = '';
 
 $offers .=   '<table width="99%" border="1" cellspacing="0" cellpadding="1" class="cart_table" >';
 $offers .=   '
   <tr>
    <td>No</td>
    <td>Артикул</td>
    <td>Наименование</td>
    <td>Кол-во</td>
    <td>Цена</td>
    <td>Сумма</td>
  </tr>
 ' ; 
  $count = 1;  
  foreach ( $offers_list as $offer) { 
  
  $offers .=    
  '<tr><td>'.$count.'</td>
  <td>'.$offer['model_articul'].'</td>
  <td>'.$offer['model_name'].'</td>
  <td>'.$offer['model_quantity'].'</td>
  <td>'.$offer['model_price'].'</td>
  <td>'.($offer['model_quantity']*$offer['model_price']).'</td></tr>' ;
  $count++; 
  } 
 $offers .=   '</table>'; 
  

$search = array (
 '#id_order#',
 '#id_user#',
 '#date_order#',
 '#name#',
 '#surname#',
 '#byfather#',
 '#region#',
 '#town#',
 '#adres#',
 '#postindex#',
 '#email#',
 '#phone#',
 '#note#',
 '#total_sum#',
 '#total_sum_to_pay#',
 '#cdp_discont_percent#',
 '#cdp_skidka#',
 '#user_group_name#',
 '#user_group_id#',
 '#user_group_descr#',
 '#delivery_to#',
 '#delivery_method#',
 '#delivery_service#',
 '#delivery_sklad#',
 '#delivery_cost#',
 '#payment_type#',
 '#payment_method#',
 '#offers#'
);
$replace = array (
$id_order,
 $id_user,
 $date_order,
 $name,
 $surname,
 $byfather,
 $region,
 $town,
 $adres,
 $postindex,
 $email,
 $phone,
 $note,
 $total_sum,
 $total_sum_to_pay,
 $cdp_discont_percent,
 $cdp_skidka,
 $user_group_name,
 $user_group_id,
 $user_group_descr,
 $delivery_to,
 $delivery_method,
 $delivery_service,
 $delivery_sklad,
 $delivery_cost,
 $payment_type,
 $payment_method,
 $offers
);
$document = $order_template['text'];
$text = str_replace($search, $replace, $document);

 echo $text;
  
  ?>

  </div>
  </div>
</div>


<!-- -->
    
  </div>
</div>
</body>
</html>