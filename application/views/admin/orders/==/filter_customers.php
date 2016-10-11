<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var serverName = SERVER_HTTP_HOST();						   
	$(function() {
		$( "#filtr_name" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: serverName+"/manage_offer/customer_name/",
				data: { term: $("#filtr_name").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				//	alert (data);
				}
			});
		},
		minLength: 2
		});
	});
});
</script>
<?php
//echo "<pre>";
//print_r($customers); exit();
//echo $_SERVER['REQUEST_URI'];
$this->session->set_userdata('customers_admin_page', $_SERVER['REQUEST_URI']);

 
?>
<div align="left" class="td-caption-top">
<div style="float:left; padding-right:10px;">Клиенты <?php if (isset($all_customers)) {?> ( Всего <?=$all_customers?> чел.) <?php } ?></div>


      <div class="table_panel">
      <a href="<?php echo base_url();?>manage_offer/add_customer" class="tlink">
  <!--  <img src="<?php  echo base_url();?>media/images/add_material.png" alt="Добавить клиента " title="Добавить клиента" height="30"  align="left" border="0"/> -->
    Добавить клиента</a>
      
      </div>
	
</div>    
<div id="filter_offers">
	   <!-- ------------------------Клиенты  начало------------------------- -->

<!--  //////////////////  Фильтр клиентов и менеджеров стандартный. начало  /////////////////////  --> 
 
<!-- фильтр -->
<div align="left">
 <!--  action="<?php echo base_url();?>manage_offer/filter_offers/"  -->
<form  id="filter_customers_form"   onsubmit="filter_customers(this);   return false"  enctype="multipart/form-data">
<table width="100%" cellspacing="0" cellpadding="0" align="center" class="table-u-b">
  <tr>
    <td width="250" class="filterpanel-t">Запрос 
    <!--<td width="150" class="filterpanel-t">Менеджер</td> -->
    <td width="150" class="filterpanel-t">Группа</td>
    <td width="150" class="filterpanel-t">Регион</td>
    <td width="150" class="filterpanel-t">Город</td>
    <td class="filterpanel-t">&nbsp;</td>
  </tr>
  <tr>
    <td class="filterpanel-b">
      <div align="center">
        <input name="filtr_name" id="filtr_name" type="text"  value="" size="25"/>
      </div>
    </td>
 <td align="center" class="filterpanel-b">
 <select id="customer_group" name="customer_group" >
      <option value="all">Все группы</option>
      <?php if (!empty($groups)): ?>
      <?php foreach($groups as $groups_filt):?>
      <option value="<?=$groups_filt['id']?>"   >
        <?=$groups_filt['name']?>
        </option>
      <?php  endforeach ?>
      <?php  endif ?>
    </select></td>
    <td align="center" class="filterpanel-b"><select id="customer_region" name="customer_region"  onchange="loadTownForFilter(this);" >
      <option value="all">Все регионы</option>
      <?php if (!empty($regions)): ?>
      <?php foreach($regions as $regions_filt):?>
      <option value="<?=$regions_filt['id']?>"   >
        <?=$regions_filt['name']?>
        </option>
      <?php  endforeach ?>
      <?php  endif ?>
    </select></td>
     <td align="center" class="filterpanel-b">
          <select id="customer_town" name="customer_town" >
            <option value="all">Все города</option>
          </select> 
    </td>
    <td class="filterpanel-b"><div align="center">
      <input name="btn"  type="submit" class="button"  value="Фильтровать" />
      </div></td>
  </tr>
</table>
</form>
</div>
<!-- фильтр конец -->
<!--  //////////////////  Фильтр Продукция стандартный. конец  /////////////////////  --> 
<div id="base">
<?php   $this->load->view('admin/customers/filter_customers_list');?> 
</div>