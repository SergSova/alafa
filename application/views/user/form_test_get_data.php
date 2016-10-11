 <?php
 
$time = time();
$to_hash_usd = "alafadobro@gmail.com:Alafa:0.1:USD:35y6gvq45y:".$time;
$ac_sign_usd = hash('sha256', $to_hash_usd);
$to_hash_uah = "alafadobro@gmail.com:Alafa:3.00:UAH:35y6gvq45y:".$time;
$ac_sign_uah = hash('sha256', $to_hash_uah);
    $form =  
    '';   
    $form .=  
    '';   
 ?>
 
 <br><form method="get" action="/payment/u_success/">
         <input type="hidden" name="ac_account_email" value="alafadobro@gmail.com" />
         <input type="hidden" name="ac_sci_name" value="Alafa" />
         <input type="hidden" name="ac_amount" value="3.00" />
         <input type="hidden" name="ac_currency" value="UAH" />
         <input type="hidden" name="ac_order_id" value="<?=$time?>" />
         <input type="hidden" name="ac_sign" value="<?=$ac_sign_uah?>" />
         <!-- Optional Fields -->
         <input type="hidden" name="ac_success_url" value="http://alafa.com.ua/payment/u_success" />
         <input type="hidden" name="ac_success_url_method" value="GET" />
         <input type="hidden" name="ac_fail_url" value="http://alafa.com.ua/payment/u_failure" />
         <input type="hidden" name="ac_fail_url_method" value="GET" />
         <input type="hidden" name="ac_status_url" value="http://alafa.com.ua/payment/u_answer_pm" />
         <input type="hidden" name="ac_status_url_method" value="GET" />
         <input type="hidden" name="ac_comments" value="Оплатить через ADV Cash 2" />
         <input type="submit" value="Оплатить через ADV Cash 3 UAH" />
</form>