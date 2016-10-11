<script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var serverName = SERVER_HTTP_HOST();						   
	$(function() {
		$( "#filtr_name" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: serverName+"/manage_offer/offer_name/",
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
<script type="text/javascript">
function confirmDelete() {
	if (confirm("Вы уверены, что хотите удалить товар из заказа  ???\r\n После удаления не забудьте сделать пересчёт суммы и создать новый счёт.")) {
		return true;
	} else {
		return false;
	}
}
</script>
<a href="<?php echo base_url();?>manage_offer/customer/<?=$order[0]['id_user']?>" target="_blank" class="tlink" title="Перейти к полной информации клиенте" > 
 Клиент - <?=$order[0]['surname']." ".$order[0]['name']?></a><br>
 <a href="<?php echo base_url();?>manage_bills/order/<?=$order[0]['id']?>" target="_blank" class="tlink" title="Перейти к полной информации о заказе" > 
Заказ номер - <?=$order[0]['id']?>
</a>
<br><br>
 
<div class="table_panel">
<a href="#" title="Добавить ещё товары"  onclick="add_cart_items();" > Добавить ещё товары</a>
</div>

<!-- фильтр -->
<div align="left" id="add_cart_item_block" style="display:none">
 <!--  action="<?php echo base_url();?>manage_offer/filter_offers/"  -->
<form id="filter_offers_for_cart_form"   onsubmit="filter_offers_for_cart(this);   return false;"  enctype="multipart/form-data">

<table width="100%" cellspacing="0" cellpadding="0" align="center" class="filter_header border_rad_5">
  <tr>
    <td width="250" class="filterpanel-t">Запрос  
    <td width="150" class="filterpanel-t">Категория</td>
     
   <!-- <td width="150" class="filterpanel-t">Бренд</td> -->
    <td class="filterpanel-t">&nbsp;</td>
  </tr>
  <tr>
    <td class="filterpanel-b">
      <div align="center">
        <input name="filtr_name" id="filtr_name" type="text"  value="" size="25"/>
        <input name="order_id" id="order_id" type="hidden"  value="<?=$order[0]['id']?>" />
      </div>
    </td>
    <td align="center" class="filterpanel-b"><select id="parent_category" alt="Категория"  name="parent_category" >
              <option value="">Выберите категорию</option>
              <?php if (!empty($categories)): ?>
              <?php foreach($categories as $category):?> 
              <option class="cat_val_parent" value="<?=$category['id']?>" <?php if (isset($selected_category) && $selected_category == $category['id']){ echo ' selected="selected"';} ?> >
			  <?=$category['menu_name']?></option>
				  <?php if(isset($category['catalogs']) && !empty($category['catalogs'])) { ?>
					  <?php foreach($category['catalogs'] as $catalog):?>
                      <option class="cat_val_child" value="<?=$catalog['id']?>" <?php if (isset($selected_category) && $selected_category == $catalog['id']){ echo ' selected="selected"';} ?> >
			    -  <?=$catalog['menu_name']?></option>
                      <?php  endforeach ?>
                  <?php } ?>
              <?php  endforeach ?><?php  endif ?>
          </select>  </td>
 
    
     <?php /*  <td align="center" class="filterpanel-b"><select id="brand" name="brand">
      <option value="all">Все бренды</option>
      <?php if (!empty($brands)): ?>
      <?php foreach($brands as $brand):?>
      <option value="<?=$brand['id']?>">
        <?=$brand['menu_name']?>
        </option>
      <?php  endforeach ?>
      <?php  endif ?>
    </select></td> */ ?> 
   
    <td class="filterpanel-b"><div align="center"> <input name="btn"  type="submit" class="button"  value="Фильтровать" /> </div></td>
  </tr>
</table>
</form>
<br><br>
</div>

<!-- фильтр конец -->

<div id="add_cart_item_filtered_block"></div> 
<!-- -->
 <!-- <div id="add_cart_item_block"></div> -->
<!-- -->
<div id="main_order_items">
 <?php  $this->load->view('admin/orders/orders_cart_edit_item_list');?> 
 
</div>
