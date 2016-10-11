<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>
 <?php 
   include_once("resources/fckeditor/fckeditor.php") ; ?>
<div class="edit_customer">  
<div class="td-caption-top">Редактировать комментарий на клиента</div>
  <div id="general">
  

  <?php if (!empty($customer_comment)): ?>
  <?php foreach($customer_comment as $ui):?> 
  
  
    <form id="edit_customer_comment_form" name="edit_customer_comment_form"  method="post" action="<?php echo base_url();?>manage_customers/edit_customer_comment_done/" >
      <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
       <tr>
          <td class="td-caption">Важный коммент</td>
          <td class="column"><div align="left">
            <label> <input name="important" type="checkbox"  <?php if($ui['important']=='1') {echo " checked";} ?> />важный комент</label>    
            </div></td>
        </tr>   
     <!-- <tr>
          <td class="td-caption">Текст</td>
          <td class="column"><div align="left">
      <textarea name="comment" cols="60" rows="7"><?php // if(isset($ui['comment'])) echo $ui['comment'];
	 // echo str_replace("<br>", "\n", $ui['comment']);
	 // echo "<pre>".$ui['comment']."</pre>";
	// echo $ui['comment'] ;
	  ?></textarea>
           </div> 
           </td>
        </tr>    -->
     
          <tr>
          <td colspan="2" align="center">
            
            <?php  
			$oFCKeditor = new FCKeditor('comment') ;
			$oFCKeditor->BasePath = "/resources/fckeditor/" ;
			$oFCKeditor->Value =  $ui['comment'];
			$oFCKeditor->Width =  700;
			$oFCKeditor->Height =  400;
			$oFCKeditor->Create() ; 
			?> 
          </td>
        </tr> 
       <tr>
          <td> </td>
          <td><div align="left">
          <input name="id_customer" type="hidden" value="<?php  print ($ui['id_customer']);?>" />
          <input name="id_ed" type="hidden" value="<?php  print ($ui['id']);?>" />
            <input id="button" class="button" type="submit" value="Сохранить изменения">    
          </div></td>
        </tr>  
    
      </table>
      
      </form>
 <?php endforeach ?>
 <?php endif ?> 
</div>
