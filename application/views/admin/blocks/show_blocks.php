
<div class="td-caption-top">
 Блоки
</div>
<?php  if (empty($blocks)) { ?>
           <div class="list-alert"> В списке нет блоков.</div>
 <?php	} ?>

  <div align="left" style="padding-left:10px;">
  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td  class="td-caption" width="10"></td>
      <td  class="td-caption" width="55%">Заголовок</td>
      <td  class="td-caption" width="180">Положение</td> 
      <td  class="td-caption" width="70" align="right"> Операции</td>
    </tr>
  </table>
  </div>

<ul id="sortable">
 <?php if (!empty($blocks)): ?>
 <?php foreach($blocks as $cats):?>

  <li class="ui-state-default">
         <!-- LIST Begin -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>           
               <td align="left" width="300">
           		<?php echo $cats['menu_name-rus'];?>
               </td>
               <td align="left" width="140">
           		<?php echo $cats['note'];?>
               </td>
               
            
            <td width="35">
           <a href="<?php echo base_url();?>manage_blocks/edit_block/<?php  echo $cats['id'];?>">  
             <img src="<?php echo base_url();?>media/images/action-edit.png"  width="20" border="0" title='Редактировать' />
              </a>
            </td>
           
          </tr>
        </table>
        <!-- LIST End -->
  </li>
  <?php endforeach ?>
  <?php endif ?> 
</ul>
<div class="clear"></div>