<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.date_input.js"></script>
<script type="text/javascript">
$(function() {
  $(".shipping_date").date_input();
  $(".add_date").date_input();
  
  
  $('.reset').live('click', function() {
    $(this).closest('form').find('input[type=text], textarea').val('');
});

//========================

	$('.sort_by_payments').click(function() {    
	var sort_name = $(this).attr('sort_name');
	var sort_type = $(this).attr('sort_type');
	//$("#base_list").html('');
	
	$('#base_list').append('<div id="mask"></div>'); 
    $("#mask").append('<div class="loading_content"></div>');
    $('#mask').fadeIn(100);
	$("#base_list").append('<div class="loading_content"></div>'); 
	 			$.ajax({  
                    type: "POST",  
                    url:   "/manage_payments/change_sort_result/",  
					cache: false,
					data: { sort_name: sort_name, sort_type: sort_type }, 
			     	success: function(response){
					  
					  if(response.substring(0,4) == 'http'){
				      window.location = (response);
					  }
					  else{ 
						 $.jGrowl('<b>Произошла ошибка обработки </b><br>'+ response, { header: 'Уведомление' , life: 2000  });
						}
					   
						return false;   		
						} 
						  
                });
 
		return false;
	});
	//========================
    $('.reset').live('click', function() {
    $(this).closest('form').find('input[type=text]').val('');
});
//========================  
//========================
  
  
});
</script>  

<?php

$pb_statuses = array(
"success" => "успешный платеж",
"failure" => "неуспешный платеж",
"wait_secure" => "платеж на проверке",
"wait_accept" => "Деньги с клиента списаны, но магазин еще не прошел проверку",
"wait_lc" => "Аккредитив. Деньги с клиента списаны, ожидается подтверждение доставки товара",
"wait_processing" => "Платеж обрабатывается",
"sandbox" => "тестовый платеж",
"subscribed" => "Подписка успешно оформлена",
"unsubscribed" => "Подписка успешно деактивирована",
"reversed" => " Возврат клиенту после списания"
);

//echo "<pre>";
//print_r($payments); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('payments_admin_page', $_SERVER['REQUEST_URI']);

?>
<div align="left" class="td-caption-top"> 
 
Оплаты <?php if (isset($all_payments)) {?> ( Всего <?=$all_payments?> ) <?php } ?>   
 
 <?php
$sort_by = $this->session->userdata('sort_paym_result_adm'); 
if(isset($sort_by) && !empty($sort_by)) {?>
	<a href="<?php echo base_url();?>manage_payments/drop_sort_result">Сбросить сортировку</a>
<?php } ?>
 
</div>    
<div id="filter_products">

	   <!-- ------------------------Клиенты  начало------------------------- -->

<!--  //////////////////  Фильтр клиентов стандартный. начало  /////////////////////  --> 
 
<!-- фильтр -->
<div align="left">
<form id="filter_payments_form" name="filter_payments_form" method="post" action="<?php echo base_url();?>manage_payments/generate_filter/" enctype="multipart/form-data">
<table width="100%" cellspacing="0" cellpadding="0" align="center" class="filter_header border_rad_5">
<tr>
    <td width="350" class="filterpanel-t"> 
    <div class="ord_filt_col"> <span>Назначение</span>
  <select id="target" name="target" >
    <option value="alltargets">Любое</option>
    <?php if (!empty($targets)): ?>
		<?php foreach($targets as $target):?>
          <option value="<?=$target['id']?>" <?php if (isset($selected_target) && $selected_target == $target['id']){ echo ' selected="selected"';} ?> >
           <?=$target['menu_name']?>
          </option>
        <?php  endforeach ?>
    <?php  endif ?>
  </select> 
</div>

      <div class="ord_filt_col"> <span>Статус </span>
  <select id="pb_status" name="pb_status" >
    <option value="all_pb_status">Все статусы</option>
    <?php /* if (!empty($pb_statuses)): ?>
    <?php foreach($pb_statuses as $key=>$value):?>
    <option value="<?=$key?>" <?php if (isset($selected_pb_status) && $selected_pb_status == $key){ echo ' selected="selected"';} ?> >
      <?=$value?>
      </option>
    <?php  endforeach ?>
    <?php  endif  */ ?>
  </select> 
</div> 
<div class="ord_filt_col"> <span>Статус оплаты </span>
<select class="payment_type" name="payment_status"   >
              <option value="allpaystatuses" selected="selected" >Все статусы</option> 
                <option value="0" <?php if (isset($selected_payment_status) && $selected_payment_status =='0') {echo 'selected="selected" ';}?> >Ожидает оплаты</option>
                <option value="1" <?php if (isset($selected_payment_status) && $selected_payment_status=='1') {echo 'selected="selected" ';}?>>Оплачен </option> 
 </select> 
</div>            
      </td>  
    <td class="filterpanel-t"> 
             <div class="ord_filt_col">
      <div><span class="w_100">Создан счет с</span>
        <input type="text" name="date_reg_from" class="add_date" value="<?php if (isset($selected_date_reg_from) && $selected_date_reg_from!='old'){ echo $selected_date_reg_from;}?>" size="14" /> 
        по <input type="text" name="date_reg_to" class="add_date" value="<?php if (isset($selected_date_reg_to) && $selected_date_reg_to!='new'){ echo $selected_date_reg_to;}?>" size="14" />
      </div>
      
      <div><span class="w_100">Принята оплата  с </span>
         <input type="text" name="pay_done_from" class="add_date" value="<?php if (isset($selected_pay_done_from) && $selected_pay_done_from!='old'){ echo $selected_pay_done_from;}?>" size="14" /> 
         по <input type="text" name="pay_done_to" class="add_date" value="<?php if (isset($selected_pay_done_to) && $selected_pay_done_to!='new'){ echo $selected_pay_done_to;}?>" size="14" />
       </div>
    </div>
      </td>   
</tr>      
  <tr>
    <td width="350" class="filterpanel-t">
     <div id="founded_count_cust"></div>
  
      </td>  
    <td rowspan="2" valign="middle" class="filterpanel-t"><div align="left" >
 
     <input name="payment_region" id="payment_region" type="hidden"  value="all"/>
     <input name="payment_town" id="payment_town" type="hidden"  value="all"/>
     <input name="btn"  type="submit" class="button"  value="Фильтровать" />
     <div class="reset" > Очистить форму</div>
    </div>
 
      </td>
  </tr>
  <tr>
    <td class="filterpanel-b">
    
      <div align="center">
        Запрос <input name="filtr_name" id="filtr_name" type="text" value="<?php if (isset($selected_word) && $selected_word!='nsw'){ echo $selected_word;}?>" size="25" onkeyup="find_names(this);" onchange="find_names(this);" />
        </div>
    </td>
    </tr>
</table>
</form>
</div>
<!-- фильтр конец -->
<!--  //////////////////  Фильтр payments стандартный. конец  /////////////////////  --> 
<div id="base">
<?php   $this->load->view('admin/payments/filter_payments_list');?> 
</div>
 