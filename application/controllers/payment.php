<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * class_local Controller class
 * @author Ageev Alexey
 */

class payment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $lang = $this->uri->segment(1);
         
        switch($lang){

        case 'ua':
        $this->lang->load('main', 'ukrainian'); 
        break;

        case 'ru':
        $this->lang->load('main', 'russian');
        
        break;
        
        case 'en':
        $this->lang->load('main', 'english');
        break;

        default:
        $this->lang->load('main', 'russian');
        break;
           // $this->load->model('user/model_user', 'model_user'); 
        } 
        $this->load->model('user/model_user', 'model_user'); 
        $this->load->model('admin/model_payments','model_payments'); 
        //$this->load->model('admin/model_bills','model_bills');
      }
//************************************************************************************
        function check_ready_receipts () {    
        
        $this->model_payments->check_ready_receipts();   
          
        }
//************************************************************************************
          function index () {
  
                          
            $data_to_write = $_POST;
            $data_to_write = file_get_contents("php://input"); 

            if(empty($data_to_write)){  

            $data_to_write = "test"; 
            }   
            if(!empty($data_to_write)){
             
                $global_export_dir = 'upload/receipt/';        
                //$export_folder =  date("Y-m-d_H-i-c");  
                $export_folder =  time();
                 
                  
            if (!is_dir($global_export_dir.$export_folder)) {   
                    if (!mkdir($global_export_dir.$export_folder)) {
                        echo "невозможно создать директорию. Сообщите о проблеме администратору и разработчику"; 
                        exit();
                    }                 
                } 
                  /*  ================ create content begin =====================  */
                 
             $export_categories_content = $data_to_write;
             
             $file_name_catalog= "receipt_".$export_folder;
             
             $export_file_catalog = $global_export_dir.$export_folder."/".$file_name_catalog.".txt";
             
             $file_add_catalog = fopen( $export_file_catalog, "w");
             
             fwrite($file_add_catalog, $export_categories_content);
             fclose ($file_add_catalog);
            }
                //   
                
        }
//************************************************************************************
  function gotopay_00000000 ($order_id) {   
  
    $merchant_id='i4521079267';
    $signature="X75eHVcnqjRvTiQzid3lGwcPHUXTSP90fxiobP";
    $url="https://www.liqpay.com/?do=clickNbuy";
    $method='card';
    $phone='+20123145121';

    $xml="<request>      
        <version>1.2</version>
        <result_url>http://mysite.com/lqanswer.php</result_url>
        <server_url>http://mysite.com/lqanswer.php</server_url>
        <merchant_id>$merchant_id</merchant_id>
        <order_id>ORDER_1234</order_id>
        <amount>10</amount>
        <currency>USD</currency>
        <description>Description</description>
        <default_phone>$phone</default_phone>
        <pay_way>$method</pay_way> 
        </request>
        ";
    
    
    $xml_encoded = base64_encode($xml); 
    $lqsignature = base64_encode(sha1($signature.$xml.$signature,1));
    
    $form =  
    "<form action='$url' method='POST'>
      <input type='hidden' name='operation_xml' value='$xml_encoded' />
      <input type='hidden' name='signature' value='$lqsignature' />
    <input type='submit' value='Pay'/>
    </form>"
     ;
        /*
        echo("<form action='$url' method='POST'>
              <input type='hidden' name='operation_xml' value='$xml_encoded' />
              <input type='hidden' name='signature' value='$lqsignature' />
            <input type='submit' value='Pay'/>
            </form>");
        */  
  }    
//************************************************************************************     
     function answer () {
                   
 // echo "Server says:<br><br>";       
     /* $in = "
      <response>      
      <version>1.2</version>
      <merchant_id>35673456735683</merchant_id>
      <order_id>ORDER_123456</order_id>
      <amount>1666.01</amount>
      <currency>UAH</currency>
      <description>Comment</description>
      <status>success</status>
      <code></code>
      <transaction_id>31</transaction_id>
      <pay_way>card</pay_way>
      <sender_phone>+3801234567890</sender_phone>
      <goods_id>1234</goods_id>
      <pays_count>5</pays_count>
</response>
      "; 
   $string = simplexml_load_string($in);    // ================== raspakovka xml ================  
   echo $string->order_id."<br>";
   echo $string->merchant_id."<br>"; 
   echo $string->amount."<br>"; 
   echo $string->currency."<br>"; 
   echo $string->status."<br>"; 
   echo $string->code."<br>"; 
   echo $string->transaction_id."<br>"; 
   echo $string->pay_way."<br>";
   echo $string->sender_phone."<br>";             
   exit();   
   
  $xml="
<request>
<version>1.2</version>
<order_id>ORDER_156</order_id>
<amount>568.35</amount>
<currency>UAH</currency>
<description>Оплата заказа в интернет-магазине  </description>
<sender_phone>+380683640048</sender_phone>
<pay_way>card</pay_way>
<code></code>
<transaction_id>31</transaction_id>
<pay_way>card</pay_way>
<status>success</status>
</request>
"; */  

    //=======================  ======================
                      
            $data_to_write = $_POST;
            $operation_xml = $data_to_write['operation_xml'];
            $signature = $data_to_write['signature'];
            
   // ======================== ======================  
 
 $signature_of_merc="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant  
    
 if(!empty($operation_xml) && !empty($signature)){ 
            
            //echo  "data is<br><br>";   
            
 $xml_decoded = base64_decode($operation_xml);    // - orig
 
 
 $lqsignature_confirm = base64_encode(sha1($signature_of_merc.$xml_decoded.$signature_of_merc,1));
 
 if( $lqsignature_confirm == $signature ) {
     
// echo  "signature confirmed<br><br>";   
 
   $string = simplexml_load_string($xml_decoded);    
    
 
 //  $order_id = substr($string->order_id, 6)  ;
   $order_id = ltrim("ORDER_", $string->order_id)  ;
   // ORDER_
   //echo $order_id ; 
   $order = $this->model_user->load_Order_for_Pay($order_id); 
   
   if(!empty($order) && $order['price'] == $string->amount ){
     //  echo "summa sovpala";
   
   $payment['order_payment_status'] = 0;
   
   if($string->status == 'success') {
    $payment['order_payment_status'] = 1;
   }
     
     
   $payment['user_id'] = $order['user_id'];
   $payment['order_id'] = $order_id;   
   
   
   
   $data_to_write = implode (" == ", $data_to_write);
   
   
   
    if(!empty($data_to_write)){
             
                $global_export_dir = 'upload/receipt/';        
                //$export_folder =  date("Y-m-d_H-i-c");  
                $export_folder =  time();
                 
                  
            if (!is_dir($global_export_dir.$export_folder)) {   
                    if (!mkdir($global_export_dir.$export_folder)) {
                        echo "невозможно создать директорию. Сообщите о проблеме администратору и разработчику"; 
                        exit();
                    }                 
                } 
            /*  ================ create content begin =====================  */
                 
             $export_categories_content = $data_to_write;
             
             $file_name_catalog= "receipt_".$export_folder;
             
             $export_file_catalog = $global_export_dir.$export_folder."/".$file_name_catalog.".txt";
             
             $file_add_catalog = fopen( $export_file_catalog, "w");
             
             fwrite($file_add_catalog, $export_categories_content);
             fclose ($file_add_catalog);
            }
   
   
   
   
   
     
   // 
     $this->model_user->update_payment_status_automaticly($string, $payment);
   }
  // print_r( $string);        sender_phone
   
  
   // exit(); 
 /* 
 Примеры статусов
status="success" - покупка совершена
status="failure" - покупка отклонена
status="wait_secure" - платеж находится на проверке 
  */   
  
 } 
      
      }   
              
        }  
//************************************************************************************
 function form_test_get_data () {
     $this->load->view('user/form_test_get_data'); 
 }
//************************************************************************************
 
  function ac_u_answer_pm () {
   // echo "Ответ от сервера при переходе юзера";
 //$data_to_write = $_POST; 
// открываем файл, если файл не существует,
$time = time();
$filename_answ = "/upload/answers/answer_pm_".$time; //date("Y-m-d H:i:s");
//делается попытка создать его 
//$text = file_get_contents('php://input'); 
$data_to_write = $_POST; 
$fp = fopen($filename_answ, "a+"); 
// записываем в файл текст
$part_to_write = "\n\r Ответ от сервера с отчетом:";
fwrite($fp, $part_to_write.serialize($data_to_write)); 
// закрываем
fclose($fp);   

 }  
//************************************************************************************
 function ac_u_success () {
 echo "Заблокированная функция"; exit;
if(!empty($_POST)) { 
    $parsed=$_POST; // $_GET
    $this->model_user->write_payment_status_automaticly($parsed);
    $gotouser_contents['title'] = "Статус оплаты";
    $gotouser_contents['h1'] = "Статус оплаты";
    $gotouser_contents['text'] = "Ваш запрос на оплату был обработан платежной системой. О его статусе вы можете узнать в личном кабинете Alafa? а так же в личном кабинете платежной системы.";
    //$this->session->set_userdata('pay_status_now','payed_show_next');      
 }  else {
    //$this->session->set_userdata('pay_status_now','bad_news');    
    $gotouser_contents['title'] = "Статус оплаты";
    $gotouser_contents['h1'] = "Статус оплаты";
    $gotouser_contents['text'] = "Ваш запрос на оплату не был обработан платежной системой. О его статусе вы можете узнать в личном кабинете платежной системы.";
 }
 $this->session->set_userdata('gotouser_contents',$gotouser_contents); 
   //$this->paydone($gotouser_contents);
   
  //  header('Location: '.base_url().lang('main_lang').'/user/paydone');   
 
 }
//************************************************************************************
 function ac_u_answer ($get_status='') {
     // failure  success  status
 
if(!empty($_POST)) { 
    $parsed=$_POST; // $_GET
    $this->model_user->write_payment_status_automaticly($parsed, $get_status);
    $gotouser_contents['title'] = "Статус оплаты";
    $gotouser_contents['h1'] = "Статус оплаты";
    $gotouser_contents['text'] = "Ваш запрос на оплату был обработан платежной системой. О его статусе вы можете узнать в личном кабинете Alafa, а так же в личном кабинете платежной системы.";
    //$this->session->set_userdata('pay_status_now','payed_show_next');      
 }  else {
    //$this->session->set_userdata('pay_status_now','bad_news');    
    $gotouser_contents['title'] = "Статус оплаты";
    $gotouser_contents['h1'] = "Статус оплаты";
    $gotouser_contents['text'] = "Ваш запрос на оплату не был обработан платежной системой. О его статусе вы можете узнать в личном кабинете платежной системы.";
 }
 $this->session->set_userdata('gotouser_contents',$gotouser_contents); 
   //$this->paydone($gotouser_contents);
    header('Location: '.base_url().lang('main_lang').'/user/paydone');   
 
 }
//************************************************************************************
 function ac_u_failure () {
    echo "Ответ от сервера при переходе юзера";
 //$data_to_write = $_POST; 
// открываем файл, если файл не существует,
$time = time();
$filename_answ = "/upload/answers/answer_failure_".$time; //date("Y-m-d H:i:s");
//делается попытка создать его 
$text = file_get_contents('php://input'); 
$fp = fopen($filename_answ, "a+"); 
// записываем в файл текст
$part_to_write = "\n\r Ответ от сервера при НЕУДАЧНОЙ ОПЛАТЕ У ЮЗЕРА:";
fwrite($fp, $part_to_write.serialize($text)); 
// закрываем
fclose($fp);  
 }  
//************************************************************************************
//************************************************************************************     
     function answer_privat24 () {
    
    //=======================  ======================
                      
            $data_to_write = $_POST;
            $payment = $data_to_write['payment'];
            $signature = $data_to_write['signature'];
            
   // ======================== ======================  
 
 //$signature_of_merc="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant  
 $pass="34j6wi7aMsliGX79y1kSO0P9sh0ztbAM";   
 if(!empty($operation_xml) && !empty($signature)){ 

 $payment_decoded = base64_decode($payment);    // - orig
 
  /*
    amt=15.25&
    ccy=UAH&
    details=книга Будь здоров!&
    ext_details=1000BDN01&
    pay_way=privat24&
    order=000AB1502ZGH&
    merchant= 75482&
    state=ок&
    date=060814080113&
    ref=aBESQ2509023364513&
    payCountry=UA
   */
 $lqsignature_confirm = sha1(md5($payment.$pass));
 
 
 if( $lqsignature_confirm == $signature ) {
     
// echo  "signature confirmed<br><br>";   
 
   //$string = simplexml_load_string($xml_decoded);    
   $array_res = explode("&", $payment);
   $order_id = ltrim("ORDER_", $array_res['order'])  ;
   //echo $order_id ; 
   $order = $this->model_user->load_Order_for_Pay($order_id); 
   
   if(!empty($order) && $order['price'] == $array_res['amt'] ){
     //  echo "summa sovpala";
  
   $payment_w['order_payment_status'] = 0;
    
   $payment_w['user_id'] = $order['user_id'];
   $payment_w['order_id'] = $order_id;   
   
 
     if($this->model_user->update_payment_status_automaticly_privat24($array_res, $payment_w)!==false){
     
             echo "The request was fulfilled";
     
     }
   }
  // print_r( $string);        sender_phone
 
  
 } 
      
      }   
              
        }  
//************************************************************************************
//************************************************************************************     
     function likep24_ishop () {
    
    //=======================  ======================
                      
            $data_to_write = $_POST;
            //$payment = $data_to_write['payment'];
            $signature = $data_to_write['signature'];
            
   // ======================== ======================  
 
 //$signature_of_merc="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant  
 $pass="9s2Exf9mt0Inke9W6aHfaI100tPwYSI3";   
 
 echo "<pre>"; print_r($data_to_write); echo "</pre>";
 
 
 $ch_payment = "amt=".$data_to_write['amt']."&ccy=".$data_to_write['ccy']."&details=".$data_to_write['details']."&ext_details=".$data_to_write['ext_details']."&pay_way=privat24&order=".$data_to_write['order']."&merchant=".$data_to_write['merchant'];
 
$lqsignature_confirm = sha1(md5($ch_payment.$pass)); 

echo "<br> ch_payment = ".$ch_payment;
echo "<br><br> lqsignature_confirm = ".$lqsignature_confirm;
 
 exit(); 
 
 $lqsignature_confirm = sha1(md5($payment.$pass));
 
 
 if( $lqsignature_confirm == $signature ) {
      
   $array_res = explode("&", $payment);
   $order_id = ltrim("ORDER_", $array_res['order'])  ;
   //echo $order_id ; 
   //$order = $this->model_user->load_Order_for_Pay($order_id); 
   
   if(!empty($order) && $order['price'] == $array_res['amt'] ){
     //  echo "summa sovpala";
  
   $payment_w['order_payment_status'] = 0;
    
   $payment_w['user_id'] = $order['user_id'];
   $payment_w['order_id'] = $order_id;   
 
   }
  // print_r( $string);        sender_phone
 
  
 } 
      
    
              
        }  
//************************************************************************************

//************************************************************************************
    
//************************************************************************************
}
?>