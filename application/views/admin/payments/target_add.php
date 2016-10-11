<script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script> 
<div class="td-caption-top">Добавить статус</div>

<form id="user_status_add_tolist" name="user_status_add_form"  method="post" action="<?=base_url()?>manage_customers/add_user_status_tolist" enctype="multipart/form-data" onsubmit = "return checkformnew(this)"> 
 
<div align="left" class="td-caption-top"> <span> Изображение </span>
 <input type="file" name="img" id="LOGO"  /> 
</div>
 
<!-- ----------------------------------------------------- -->
 
	<div >
    <!-- RUS begin ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
	 <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      <tr>
        <td width="161" class="td-caption">Название</td>
        <td width="629" class="column"><div align="left">
          <input name="menu_name" type="text"  value="" size="100" required />      
          </div></td>
        </tr>
           
      </table>
    <!-- RUS end ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	</div>
 
<!-- ----------------------------------------------------- -->
  
<div align="center">
          <input name="btn" type="submit" class="button" value="Добавить статус" />
 </div>

</form>
