<script type="text/javascript" src="<?php echo base_url();?>js/admin_goods_class.js"></script>
<?php  include_once("resources/fckeditor/fckeditor.php") ; ?> 
<div class="td-caption-top"> Редактирование статуса   </div>
  <div id="add_good_info" class="jGrowl middle-right"> </div>
  <?php   if (!empty($user_statuss)): ?>
   <?php foreach($user_statuss as $a):?> 

<form id="user_status_edit_tolist" name="user_status_edit_form"  method="post" action="<?php echo base_url();?>manage_customers/edit_user_status_done"  onsubmit = "return checkformnew(this)" enctype="multipart/form-data">
 
 <div align="left" class="td-caption-top"> <span> Фото </span>
   <?php if($a['preview']!='') { ?><img  src="<?php echo base_url().''.$a['preview'];?>" height="30"  > <?php } ?> 
        <input name="old_preview" type="hidden" value="<?php  echo $a['preview'];?>" /> 
       <a href="#" onclick="toggle_show('edit_photo')">Заменить изображение</a><br>
      <div id="edit_photo" style="display:none"> 
        <div align="left">
          <input type="file" name="ed_preview" id="Фото" />      
        </div>  
      </div> 
 </div> 

<!-- ----------------------------------------------------- -->
 
	<div>
    <!-- RUS begin ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
	 <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
      <tr>
        <td width="161" class="td-caption">Название </td>
        <td width="629" class="column"><div align="left">
          <input name="ed_menu_name" type="text"  value="<?php  print ($a['menu_name']);?>" size="100" required />      
          </div></td>
        </tr> 
      
      </table>
 
    <!-- RUS end ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  -->
	</div>
 
<!-- ----------------------------------------------------- -->
 

 <div align="center">
 
 <input name="id_ed" type="hidden" value="<?php  print ($a['id']);?>" />
          <input name="btn"  type="submit" class="button"  value="Сохранить изменения" />
 </div>

</form>
<?php endforeach ?>
 <?php endif ?> 