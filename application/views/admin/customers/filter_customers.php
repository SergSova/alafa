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

	$('.sort_by_customers').click(function() {    
	var sort_name = $(this).attr('sort_name');
	var sort_type = $(this).attr('sort_type');
	//$("#base_list").html('');
	
	$('#base_list').append('<div id="mask"></div>'); 
    $("#mask").append('<div class="loading_content"></div>');
    $('#mask').fadeIn(100);
	$("#base_list").append('<div class="loading_content"></div>'); 
	 			$.ajax({  
                    type: "POST",  
                    url:   "/manage_customers/change_sort_result/",  
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
<script type="text/javascript">
function find_names(findme){
	if($("#filtr_name").val().length > 2 ){
		$("#founded_count_cust").append('<div class="load_mini"></div>');
	 
		 	var serverName = SERVER_HTTP_HOST();
				$.ajax({  
						type: "POST",  
						url:   serverName+"/manage_customers/customer_name",
						cache: false,
						data: { term: $("#filtr_name").val()},
						 success: function(response){ 
							$(".load_mini").remove();
							$("#founded_count_cust").show(100);
							$("#founded_count_cust").html(response);
						
							 }
					});
					
					} 
					else {
						$("#founded_count_cust").hide(100);
						} 
	}
</script>
<?php
//echo "<pre>";
//print_r($customers); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('customers_admin_page', $_SERVER['REQUEST_URI']);

?>
<div align="left" class="td-caption-top"> 
<a href="<?php echo base_url();?>manage_customers/add_customer" class="tlink">
<img src="<?=base_url()?>media/images/add_material.png" title="Добавить клиента" alt="Добавить клиента" height="25"  border="0" align="top"/></a>
Клиенты <?php if (isset($all_customers)) {?> ( Всего <?=$all_customers?> чел.) <?php } ?> 
 
 <?php
$sort_by = $this->session->userdata('sort_cust_result_adm'); 
if(isset($sort_by) && !empty($sort_by)) {?>
	<a href="<?php echo base_url();?>manage_customers/drop_sort_result">Сбросить сортировку</a>
<?php } ?>
 
</div>    
<div id="filter_products">

	   <!-- ------------------------Клиенты  начало------------------------- -->

<!--  //////////////////  Фильтр клиентов стандартный. начало  /////////////////////  --> 
 
<!-- фильтр -->
<div align="left">
<form id="filter_customers_form" name="filter_customers_form" method="post" action="<?php echo base_url();?>manage_customers/generate_filter/" enctype="multipart/form-data">
<table width="100%" cellspacing="0" cellpadding="0" align="center" class="filter_header border_rad_5">
<tr>
    <td width="350" class="filterpanel-t"> 
       
      </td>  
    <td class="filterpanel-t"> 
             <div class="ord_filt_col">
      <div><span class="w_100">Регистрация с</span>
        <input type="text" name="date_reg_from" class="add_date" value="<?php if (isset($selected_date_reg_from) && $selected_date_reg_from!='old'){ echo $selected_date_reg_from;}?>" size="14" /> 
        по <input type="text" name="date_reg_to" class="add_date" value="<?php if (isset($selected_date_reg_to) && $selected_date_reg_to!='new'){ echo $selected_date_reg_to;}?>" size="14" />
      </div>
      
      <div><span class="w_100">Посл. вход с</span>
         <input type="text" name="last_visit_from" class="add_date" value="<?php if (isset($selected_last_visit_from) && $selected_last_visit_from!='old'){ echo $selected_last_visit_from;}?>" size="14" /> 
         по <input type="text" name="last_visit_to" class="add_date" value="<?php if (isset($selected_last_visit_to) && $selected_last_visit_to!='new'){ echo $selected_last_visit_to;}?>" size="14" />
       </div>
    </div>
      </td>   
</tr>      
  <tr>
    <td width="350" class="filterpanel-t">
     <div id="founded_count_cust"></div>
  
      </td>  
    <td rowspan="2" valign="middle" class="filterpanel-t"><div align="left" >
 
     <input name="customer_region" id="customer_region" type="hidden"  value="all"/>
     <input name="customer_town" id="customer_town" type="hidden"  value="all"/>
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
<!--  //////////////////  Фильтр Customers стандартный. конец  /////////////////////  --> 
<div id="base">
<?php   $this->load->view('admin/customers/filter_customers_list');?> 
</div>
 