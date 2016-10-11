
<script type="text/javascript"> 
////////////////////////
 function send_sms_form(id_customer) {  
		var u_phone = $("#cust_phone_"+id_customer).attr('u_phone'); 
		//var data_id = $(this).attr('data'); 
				$.ajax({  
                    type: "POST",  
                    url:   "/manage_customers/open_sms_send_form_template/"+u_phone+"/"+id_customer, 
					cache: false,
					
			     	success: function(response){
						$('body').append('<div id="mask"></div>');
						$("#cust_phone_td").after('<div class="popup_box_u"><a href="#" class="close">&times;</a>'+response+'</div>');  
						var window_width = $(window).width();
										var popup_cart_ml = (window_width - 300)/2; 
										$('popup_box_u').css({  
											'left' : popup_cart_ml 
										}); 
						
						$('#mask').fadeIn(300); 
						$(".popup_box_u").css('width', '500px'); 
						$(".popup_box_u").fadeIn(300); 
						$(".popup_box_u").show(300);
						
						return false;  
							
						}	
					 
                });
 
 }
	///=========


</script>
 <?php 
   include_once("resources/fckeditor/fckeditor.php") ; ?>
<div class="add_customer">  
<div class="td-caption-top">Добавить комментарий на клиента</div>
  <div id="general" >
  <div id="add_customer_info" class="jGrowl middle-right"> </div> <!-- add_customer_comment_tolist  onsubmit="customer_add(this); return false" -->
    <form id="add_customer_form" name="form1" method="post" action="<?php echo base_url();?>manage_customers/add_customer_comment_tolist/" enctype="multipart/form-data">
      <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="listtable">
     <tr>
            <td class="td-caption" id="cust_phone_td">Телефон мобильный</td>
            <td class="column"><div align="left">
              <div id="#cust_phone_<?=$customer['id']?>">
                <?=$customer['phone_mob']?>
              </div>
              <?php if($customer['phone_mob']!=''){  ?> <img src="<?php echo base_url();?>media/css/admin/img/sms.png" width="20" alt="SMS" id="cust_phone_<?=$customer['id']?>" class="send_sms fl" onclick="send_sms_form(<?=$customer['id']?>);" title="Отправить SMS сообщение пользователю на его номер <?=$customer['phone_mob']?>" u_phone="<?=$customer['phone_mob']?>" /> <?php } ?>
               
          </div></td>
     </tr>
          <tr>
          <td class="td-caption">Важный коммент</td>
          <td class="column"><div align="left">
            <label> <input name="important" type="checkbox" />важный комент</label>    
            </div></td>
        </tr>    
        <tr>
          <td class="td-caption">Имя клиента</td>
          <td class="column"><div align="left">
            <?=$customer['name'].' '.$customer['surname']?>
          </div></td>
        </tr>
   
   
                 <tr>
        <td colspan="2" align="center">&nbsp;
   
          <?php 
$oFCKeditor = new FCKeditor('comment') ;
$oFCKeditor->BasePath = "/resources/fckeditor/" ;
$oFCKeditor->Value =  ' <strong>Заказывали для Себя/На подарок:</strong>&nbsp;<br>
<strong>Оценка - менеджера принимавшего заказ:</strong>&nbsp;<br>
<strong>Оценка - курьера - работа/вежливость/пунктуальность:</strong>&nbsp;<br>
<strong>Как часто Вы делаете заказы товаров нашей номенклатуры:</strong>&nbsp;<br>
<strong>Откуда Вы узнали о нас:</strong>&nbsp;<br>
<strong>Устроила ли Вас упаковка Заказа:</strong>&nbsp;<br>
<strong>Хотите ли покупать у нас регулярно по спец. цене:</strong>&nbsp;<br>
<strong>Можно ли перезвонить Вам через время (1,2,3 мес) и предложить снова сделать заказ:</strong>&nbsp;<br>
<strong>Общая оценка магазина:</strong>&nbsp;<br>';
$oFCKeditor->Width =  700;
$oFCKeditor->Height =  400;
$oFCKeditor->Create() ;
?> 
          </td>
        </tr>     
     <!-- <tr>
          <td class="td-caption">Текст</td>
          <td class="column"> 
        <div align="left"> <textarea name="comment" cols="60" rows="7" required="required"></textarea> </div>
          
          </td>
        </tr>    -->
        
       <tr>
          <td class="td-caption"> </td>
          <td><div align="left">
            <input type="hidden" name="customer_id" value="<?=$customer['id']?>">   
             <input id="button" class="button"  type="submit" value="Добавить комментарий">   
          </div></td>
        </tr>  
    
        
      </table>
      
      </form>
 
</div>
