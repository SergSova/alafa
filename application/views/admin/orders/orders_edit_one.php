<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
<script type="text/javascript" > 
function load_tour_dates_q() {
 
		$.post("<?=base_url()?>ru/shop/data_load_tour_dates/", {id: ""+$("#tour").val()+""}, function(data) {    
	 
			$('#tour_date').html(data); // Fill the suggestions box
		});
	 
}

//preventSelection(document); // blockiruet copy
</script>
<div class="edit_customer">  
<div align="center" class="td-caption-top">Изменение иформации о заказе</div>
  <div id="general">
  <div id="edit_customer_info" class="jGrowl middle-right"> </div>

  <?php if (!empty($order)): ?>
  <?php foreach($order as $ord):?> 
<form id="goods_offer_edit" name="goods_offer_edit_form"  method="post" action="<?php echo base_url();?>manage_bills/edit_order_one_done" enctype="multipart/form-data" onsubmit = "return checkformnew(this)">
  <table width="90%" border="0" cellspacing="0" cellpadding="1" class="listtable">
  <tr>
    <td class="td-caption caption-nt" width="150">Номер заказа</td>
    <td class="column"><?=$ord['id']?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Дата заказа</td>
    <td class="column"><?=$ord['date_order']?></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Пользователь</td>
    <td class="column">
	 <input name="surname" id="surname" type="text" value="<?=$ord['surname']?>" size="50"/>Фамилия<br>
     <input name="name" id="name" type="text" value="<?=$ord['name']?>" size="50"/>Имя <br>
     <input name="byfather" id="byfather" type="text" value="<?=$ord['byfather']?>" size="50"/>Отчество   
	 </td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Страна, город</td>
    <td class="column">
	<input name="country" id="country" type="text" value="<?=$ord['country']?>" size="70"/>Страна <br>
	<input name="town" id="town" type="text" value="<?=$ord['town']?>" size="70"/>Город<br> 
	 </td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Email</td>
    <td class="column">
	<input name="email" id="email" type="text" value="<?=$ord['email']?>" size="70"/>
	</td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Телефон</td>
    <td class="column">
	<input name="phone" id="phone" type="text" value="<?=$ord['phone']?>" size="70"/>
	</td>
  </tr>
 
  <tr>
    <td class="td-caption caption-nt">Примечание</td>
    <td class="column">
	<textarea name="note" rows="2" cols="40"><?=$ord['note']?></textarea>
	</td>
  </tr> 
  
  <tr>
    <td class="td-caption caption-nt">Тур</td>
    <td class="column"><?php 
	/*foreach($offers as $of){
		if($of['id'] == $ord['tour']) {echo $of['menu_name'];}
	} */ 
	//echo $ord['tour'];
	?>
    <?php $tours = $this->model_user_shop->load_tours(); ?>
            <select id="tour" name="tour" onchange="load_tour_dates_q(this)"> 
            <option value="" selected="selected"  required >Выбери тур</option>
             <?php if (!empty($tours)): ?>
				  <?php foreach($tours as $tour):?> 
                  <option value="<?=$tour['id']?>" <?php if ($tour['id'] == $ord['tour']) { echo ' selected="selected"';} ?>><?=$tour['menu_name']?></option>
             <?php  endforeach ?><?php endif ?> 
             </select>   
             </td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Дата тура</td>
    <td class="column">  <select id="tour_date" name="tour_date">
                   <option value="" selected="selected"  >Не заменять</option>
                   </select>
				   <?=$ord['tour_date']?>
                   </td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Колличество людей в поездке</td>
    <td class="column"> <textarea name="note" rows="2" cols="40"><?=$ord['people']?></textarea></td>
  </tr>
  <tr>
    <td class="td-caption caption-nt">Экипировка</td>
    <td class="column"><div>
      <?php if($ord['equipment'] == '0') {echo "Экипировка ЕСТЬ ";} else {'Нужна экипировка, размер = '.$ord['size'];}?>
    </div>
    <label><input name="equipment" type="radio" value="1" id="eq_need" onclick="$('#inp_size').show(500);" <?php if($ord['equipment'] == '1') {echo ' checked="checked" ';} ?>  /> Мне нужна экипировка</label><br>
          <label><input name="equipment" type="radio" value="2" onclick="$('#inp_size').hide(500); $('#inp_size input').val('');" checked="checked"/> У меня есть экипировка</label>
          <div id="inp_size" style="display:none;" ><br>Укажите размер одежды  <input name="size" type="text"  value="" /></div> 
        </td>
  </tr>  
  
  
</table> 
 <div align="center"> 
 
 <input name="id_ed" type="hidden" value="<?php  print ($ord['id']);?>" />
 <input name="from" type="hidden" value="<?php  print ($from);?>" />
 <input name="btn"  type="submit" class="button"  value="Изменить информацию о заказе" />
 </div>
</form>
 <?php endforeach ?>
 <?php endif ?> 
</div>
<br><br>
<!-- =================== offer list of order - nachalo ======================= -->
<?php // $this->load->view('admin/orders/orders_cart_show');?> 
<!-- =================== offer list of order - konets ======================= -->