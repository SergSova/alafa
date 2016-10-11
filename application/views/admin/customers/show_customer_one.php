<script type="text/javascript" src="<?php echo base_url();?>js/admin_customer_class.js"></script>

<script type="text/javascript"> 
////////////////////////
 
</script>
<div class="edit_customer">  
<div class="td-caption-top"> Информация о клиенте</div>
   
  <div id="general"> 

  <?php if (!empty($customer)): ?>
  <?php foreach($customer as $ui):?> 
   
    <form id="edit_customer_form" name="edit_customer_form" method="post" onsubmit="customer_edit(this); return false">
      <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
         <tr>
          <td class="td-caption" width="250">Email  <a href="<?php echo base_url();?>manage_customers/edit_customer/<?php echo $ui['id']; ?>">
                <img src="<?php echo base_url();?>media/images/action-edit.png" align="right" height="20" style="border: 0pt none ;" title='Редактировать' />
               </a>  </td>
          <td class="column"><div align="left">
            <?php  print ($ui['email']);?>      
            </div></td>
        </tr>
        <tr>
            <td class="td-caption" id="cust_phone_td">Телефон мобильный</td>
            <td class="column"><div align="left">
              <div id="#cust_phone_<?=$ui['id']?>">
                <?=$ui['phone']?>
              </div>
              
          </div></td>
          </tr>
        <tr>
            <td class="td-caption">ФИО</td>
            <td class="column"><div align="left">
              <?php  print ($ui['surname']);?> <?php  print ($ui['name']);?>  <?php  print ($ui['byfather']);?>   
            </div></td>
          </tr>  
          <tr>
        <td class="td-caption">День рождения</td>
        <td class="column"><div align="left">
        <?php if(!empty($ui['birthday'])){
			echo $ui['birthday']; }?>
       
          </div></td>
        </tr>
          <tr>
            <td class="td-caption">Пол</td>
            <td class="column"><div align="left"> 
             <?php if($ui['gender']=='male'){echo 'Мужской ';}
			 else if($ui['gender']=='female'){echo 'Женский ';}
			 else {echo 'Не указан ';}
			 ?> 
            </div></td>
          </tr>
          
       
      <!--  ========================================================= -->  
     <!-- <tr>
          <td class="td-caption">Контактные данные</td>
          <td class="column"><div align="left"> 
              <?php /* if (!empty($ui['contacts'])): 
              $contacts = unserialize($ui['contacts']); 
              foreach($contacts as $cont): ?> 
              <div>
              <b><?=$cont['type']?></b> - <?=$cont['datas']?><br>
              </div>
              <?php endforeach ?>
               <?php endif */ ?>  
              </div> 
        </td>
        </tr> -->

      <tr>
          <td class="td-caption">Адрес</td>
          <td class="column"> 
    <div class="text_b" align="left">
  		<?php if(isset($ui['u_region']['name'])) {?> <span> Область:</span> <?=$ui['u_region']['name']?><br> <?php }?>
       <?php  if(isset($ui['town'])) {?> <span>Город:</span>  <?=$ui['town']?><br> <?php }?>
       <?php  if(isset($ui['u_adres'])) {?><span> Адрес:</span> <?=$ui['u_adres']?><br> <?php }?>
       <?php  if(isset($ui['postindex'])) {?><span> Почтовый индекс:</span> <?=$ui['postindex']?><br> <?php }?> 
     </div></td>
        </tr>
        <tr>
          <td class="td-caption" width="250">Дата регистрации</td>
          <td class="column"><div align="left">
            <?php  print ($ui['date_reg']);?>      
            </div></td>
        </tr>
        
        <tr>
          <td class="td-caption" width="250">Контакты</td>
          <td class="column"><div align="left">
            <?php  print ($ui['contacts']);?>      
            </div></td>
        </tr> 
      
      </table>
      
      </form>
 <?php endforeach ?>
 <?php endif ?> 
</div> 