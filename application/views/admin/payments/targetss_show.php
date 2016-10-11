 
<div class="td-caption-top">Уровни оплат</div>
 
 <?php if (!empty($user_statuss['list'])): ?>
  <div align="left" style="padding-left:10px;">
  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td class="td-caption" width="10"></td>
      <td class="td-caption" width="65%">Название</td>  
      <td class="td-caption" width="10%"> Пользователи</td>
      <td class="td-caption" width="35"> Видимость</td>
      <td class="td-caption" colspan="2" width="100" align="right"> Операции</td>
    </tr>
  </table>
  </div>

<ul id="sortable">

 <?php foreach($user_statuss['list'] as $user_status):?>
 
  <li id="<?=$user_status['id']?>" class="ui-state-default" <?php if($user_status['id']==0) { echo 'style=" color: #c40000; background-color: #fff8dc; "'; } ?>>
         <!-- LIST Begin -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35" valign="middle"><img src="<?php echo base_url();?>media/images/arrow-list-move.png" alt="move" width="20" height="20" class="handle" align="left" /></td>
             <td align="left" width="50%">  
           		 <?php echo $user_status['menu_name'];?>
                 
         </td>
          
              
               <td align="left" width="20%" >
               <?php if(!empty($user_status['preview'])) { ?> 
               <img src="<?php echo base_url().$user_status['preview'];?>" height="30" align="left" border="0" />
             
           		 <?php  } // echo $user_status['menu_name'];?> 
               </td>
                
                <td align="left" width="50"> 
                <div id="count_of_products_bb_<?php echo $user_status['id']; ?>"><?php echo $user_status['count_of_users'];?></div>
                </td>   
            <td width="35">
                <?php	  if($user_status['visible'] == '1'){  ?>
<a href="<?php echo base_url();?>manage_customers/edit_user_status_visible/<?php echo $user_status['id']; ?>/<?php echo $user_status['visible']; ?>/" onclick="return confirmChangeVisibleOff();">
                         <img src="<?php  echo base_url();?>media/images/globe_32.png" width="20"  alt="Видимая. Сделать невидимой" title="Видимая. Сделать невидимой"  border="0"/></a><?php } 
                            if($user_status['visible'] == '0') {?>
  <a href="<?php echo base_url();?>manage_customers/edit_user_status_visible/<?php echo $user_status['id']; ?>/<?php echo $user_status['visible']; ?>/" onclick="return confirmChangeVisibleOn();">
                          <img src="<?php  echo base_url();?>media/images/minus-white.png" width="20"  alt="Невидимая. Сделать видимой" title="Невидимая. Сделать видимой"  border="0"/></a>
                         <?php } ?>
            </td>
            <td width="50">
           <a href="<?php echo base_url();?>manage_customers/edit_user_status/<?php  echo $user_status['id'];?>">  
             <img src="<?php echo base_url();?>media/images/action-edit.png"  width="20" border="0" title='Редактировать' />
              </a>
            </td>
            <td width="50"> 
               <img src="<?php echo base_url();?>media/images/action-delete.png"   width="20" border="0" title='Удалить'  onclick="return confirmDelete(<?php echo $user_status['id']; ?>);" />   
            </td>
          </tr>
        </table>
        <!-- LIST End -->
  </li>
  <?php endforeach ?>

</ul>
  <?php endif ?> 
<div class="clear"></div> 