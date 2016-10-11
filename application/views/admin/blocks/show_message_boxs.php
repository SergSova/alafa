
<div class="td-caption-top">
 Всплывающие подстказки
</div>
<?php  if (empty($message_boxs)) { ?>
           <div class="list-alert"> В списке нет данных.</div>
 <?php	} ?>

  <div align="left" style="padding-left:10px;">
  <table cellpadding="0" cellspacing="0" width="100%" class="listtable">
    <tr> 
      <th  class="td-caption" width="50%">Заголовок</th>
      <th  class="td-caption" >Назначение</td>  
      <th  class="td-caption" width="180">Таймаут (милисекунды)</th> 
      <th  class="td-caption" width="70" align="right"> Операции</th>
    </tr>
    
    <?php if (!empty($message_boxs)): ?>
 <?php foreach($message_boxs as $cats):?>
 <tr>           
               <td align="left" class="column" >
           		<?php echo $cats['menu_name-rus'];?>
               </td>
               <td align="left" class="column" >
           		<?php echo $cats['note'];?>
               </td>
               
               <td align="left" class="column" >
           		<?php echo $cats['timeout'];?>
               </td>
                
            <td  class="column" >
           <a href="<?php echo base_url();?>manage_blocks/edit_message_box/<?php  echo $cats['id'];?>">  
             <img src="<?php echo base_url();?>media/images/action-edit.png"  width="20" border="0" title='Редактировать' />
              </a>
            </td>
           
          </tr>
   <?php endforeach ?>
  <?php endif ?> 
    
  </table>
  </div>
 
<div class="clear"></div>