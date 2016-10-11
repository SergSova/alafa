 <script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script>    
<script type="text/javascript">
$(document).ready(
  function()
  {
  	$(".listtable tr").mouseover(function() {
  		$(this).addClass("over");
  	});
  
  	$(".listtable tr").mouseout(function() {
  		$(this).removeClass("over");
  	});
  	
  	$(".listtable tr:even").addClass("alt");
  }
);
</script>
<div id="base_list">
<!-- ------------------------ начало------------------------- -->
 
<?php if (empty($offers['offerslist'])){
	echo '<br>
	<div style="color:#900;">По данному запросу данных в базе не обнаружено </div>';
	} ?>

<?php if  (isset($offers['total'])){?>
<div class="filter_alert">По данному запросу найдено Совпадений:  <b><?=$offers['total']?></b></div>
<?php  } ?>
 

<table width="98%" cellspacing="0" cellpadding="0" align="center" class="listtable">
    <tr>
                <!--<td width="8%" class="td-caption-h">Id</td>-->
                <td class="td-caption-h">Артикул</td>
                <td class="td-caption-h">Название</td> 
                <td class="td-caption-h">Категория</td>
                <td class="td-caption-h">Количество</td>
                <td class="td-caption-h">Стоимость</td>
                <td class="td-caption-h">Новинка</td>
                <td class="td-caption-h">Архив</td>
                <td class="td-caption-h">Акционный</td>
                <td class="td-caption-h">Акц. цена</td>  
                <td class="td-caption-h">Операции</td>
    </tr>
              <?php if (!empty($offers['offerslist'])): ?>
             <?php foreach($offers['offerslist'] as $prds):?>
             
              <tr>
     
    <form id="id_<?=$prds['id']?>" name="name_<?=$prds['id']?>"  action="<?=base_url()?>manage_bills/add_offer_item_to_cart_done" method="POST" enctype="multipart/form-data"  >
     
               <input name="form_id" type="hidden"  value="<?=$prds['id']?>"  />
                <td class="column" align="left"><b><?=$prds['articul']?></b></td>
                    <td class="column" align="left"><?=$prds['menu_name']?>
                    <input name="id" type="hidden" value="<?=$prds['id']?>"  />
                  </td>
                  
                <td class="column" align="left">
                 <?php if ( isset($prds['parent_category']) && !empty($categories)){ foreach($categories as $category){?> 
				 <?php if ($prds['parent_category'] == $category['id']){?>
                  <?=$category['menu_name']?> 
                  <?php } ?>
                  <?php  }
				  //}?>
                  <?php } else {echo" - ";}?>
                  </td>
          		 <td class="column" align="center">
				 <input name="quantity" type="text" value="<?=$prds['quantity']?>" size="5" readonly="readonly" />
				 <?php //$prds['count'];?>
                 
                 </td>
                   <td class="column"> 
                   <input name="price" type="text"  value="<?php
				  if(isset($discont) && $prds['promotional'] != '1'){
					 $count_percent = 1- ($discont/100); 
					  $prds['price'] = $prds['price']*$count_percent;} 
				    echo $prds['price']; ?>" size="5"  readonly="readonly"  />
                    </td>
                <td class="column">
                  <?php if ($prds['new_good'] == '1'){?>
                  <img src="<?php echo base_url();?>media/images/stock_help-add-bookmark.png" align="center" height="20" />
                  <?php } ?>  
				</td>
                <td class="column">
                <?php if ($prds['hit'] == '1'){?>
                  <img src="<?php echo base_url();?>media/images/14_star.png" align="center" height="20" />
                <?php } ?>
                 
                </td>
                <td class="column" align="center">
                <?php if ($prds['promotional'] == '1'){?>
                  <img src="<?php echo base_url();?>media/images/label_saleyellow.png" align="center" height="20" />
                 <?php } ?>  
				</td>
                <td class="column">
				<input type="text" name="promotional_price" readonly="readonly" size="5"   />
				</td>
              <!--
                <td class="column" align="center">
                <select name="buy_quantity" id="buy_quantity">
				  <option value="0" disabled="disabled">кол-во</option> 
				  <?php for($i=1; $i<=6; $i++){ ?>
				  <option value="<?=$i?>"><?=$i?></option>
				  <?php } ?>
	 </select>  
             
				</td> -->
                <td align="center" class="column edit-panell">   <!--<div class="button_ait_div">
              id="button_ait_<?=$prds['id']?>"    <input class="button_ait"  type="submit" class="button"  value="Добавить">   OnClick="order_add_to_cart_form(this.form);"
                </div> -->
                 <!-- <?php echo base_url();?>manage_bills/add_offer_to_cart/<?=$order_id?>/<?php echo $prds['id']; ?> -->
                  <a href="#" OnClick="order_add_to_cart('<?=$order_id?>','<?php echo $prds['id']; ?>');">
                    <img src="<?php echo base_url();?>media/images/cart.png" align="center" height="20" style="border: 0pt none ;" title='Добавить в корзину' />
                   </a> 
                </td>
               </form>   
              </tr>
            
               <?php endforeach ?>
              <?php endif ?> 
  </table>
 
 <br> <br>
<!-- ------------------------Продукция конец------------------------- -->      
</div>