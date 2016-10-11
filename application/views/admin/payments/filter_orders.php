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

	$('.sort_by_order_vivods').click(function() {    
	var sort_name = $(this).attr('sort_name');
	var sort_type = $(this).attr('sort_type');
	//$("#base_list").html('');
	
	$('#base_list').append('<div id="mask"></div>'); 
    $("#mask").append('<div class="loading_content"></div>');
    $('#mask').fadeIn(100);
	$("#base_list").append('<div class="loading_content"></div>'); 
	 			$.ajax({  
                    type: "POST",  
                    url:   "/manage_order_vivods/change_sort_result/",  
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
//echo "<pre>";
//print_r($order_vivods); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('order_vivods_admin_page', $_SERVER['REQUEST_URI']);

?>
<div align="left" class="td-caption-top"> 
 
Запрос вывода комиссии <?php if (isset($all_order_vivods)) {?> ( Всего <?=$all_order_vivods?> ) <?php } ?> 
 
 <?php
$sort_by = $this->session->userdata('sort_paym_result_adm'); 
if(isset($sort_by) && !empty($sort_by)) { ?>
	<a href="<?php echo base_url();?>manage_payments/drop_sort_result">Сбросить сортировку</a>
<?php } ?>
 
</div>    
<div id="filter_products">

	   <!-- ------------------------Клиенты  начало------------------------- -->

<!--  //////////////////  Фильтр клиентов стандартный. начало  /////////////////////  --> 
 
<!-- фильтр -->
<div align="left">
<form id="filter_order_vivods_form" name="filter_order_vivods_form" method="post" action="<?php echo base_url();?>manage_payments/generate_filter_order_vivod/" enctype="multipart/form-data">
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
 
<div class="ord_filt_col"> <span>Статус оплаты </span>
<select class="order_vivod_type" name="order_vivod_status"   >
              <option value="allpaystatuses" selected="selected" >Все статусы</option> 
                <option value="0" <?php if (isset($selected_order_vivod_status) && $selected_order_vivod_status =='0') {echo 'selected="selected" ';}?> >Ожидает </option>
                <option value="1" <?php if (isset($selected_order_vivod_status) && $selected_order_vivod_status=='1') {echo 'selected="selected" ';}?>>Отправлен</option> 
 </select> 
</div>            
      </td>  
    <td class="filterpanel-t"> 
             <div class="ord_filt_col">
      <div><span class="w_100">Создан  с</span>
        <input type="text" name="date_reg_from" class="add_date" value="<?php if (isset($selected_date_reg_from) && $selected_date_reg_from!='old'){ echo $selected_date_reg_from;}?>" size="14" /> 
        по <input type="text" name="date_reg_to" class="add_date" value="<?php if (isset($selected_date_reg_to) && $selected_date_reg_to!='new'){ echo $selected_date_reg_to;}?>" size="14" />
      </div>
      
      <div><span class="w_100">Отправлена оплата  с </span>
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
 
     <input name="order_vivod_region" id="order_vivod_region" type="hidden"  value="all"/>
     <input name="order_vivod_town" id="order_vivod_town" type="hidden"  value="all"/>
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
<!--  //////////////////  Фильтр order_vivods стандартный. конец  /////////////////////  --> 
<div id="base">
<?php   $this->load->view('admin/payments/filter_orders_list');?> 
</div>
 