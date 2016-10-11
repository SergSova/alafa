<div><div align="center" class="td-caption-top" style="padding-top:10px;"> Форма редактирования адресов блокировки доступа в магазин</div>


</div>
<?php $ban_list = explode(",", $ban_list_shop);
//print_r($ban_list);
?>
<fieldset>
      	<legend>
        <div class="td-caption">Убедитесь в правильном оформлении списка</div>
        </legend>
      <form  method="post" action="<?php echo base_url();?>manage_ban/edit_shop_ban/" enctype="multipart/form-data"    name="myform" id="myform">
<div>

  <div>
  <textarea name="ips" cols="70" rows="<?php echo count($ban_list); ?>"><?php 
  if (!empty($ban_list)): 
		
		for($i=0; $i<count($ban_list); $i++){
		echo $ban_list[$i].",\n";
		}
  endif ?></textarea>
  </div>
  <div style="float:right; width:450px; vertical-align:top;">Вводить  ip по очереди через запятую. Если данные будут введены неверно, то могут возникнуть проблемы в работе системы. </div>
    <div style="clear: both;"></div>
</div>
<input name="btn"  type="submit" class="button"  value="Сохранить изменения" /> 
      </form>
      </fieldset>
<hr>



 