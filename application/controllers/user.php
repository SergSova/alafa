<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * class_local Controller class
 * @author Ageev Alexey
 */

class user extends CI_Controller {

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

        }         
 /*    
$this->load->model('user/auth/model_auth_user_rus', 'model_auth');
$this->load->model('user/model_user_rus', 'model_user');
$this->load->model('user/model_user_shop', 'model_user_shop');
 */
 
 $this->load->model('user/model_user', 'model_user'); 
 $this->load->model('user/auth/model_auth_user', 'model_auth');
 $this->load->model('admin/model_payments','model_payments'); 

 $user = $this->session->userdata;
  //  echo "<pre>";  print_r($user); 
     if (!isset($user['email']) || !isset($user['user_id'])) {
      header('Location: '.base_url());  exit(); 
       /*  if(isset($_SERVER['HTTP_REFERER'])) {
           $redirect = $_SERVER['HTTP_REFERER'];
           $this->session->set_userdata('lost_session_redirect', $redirect) ;  
           header('Location: '.base_url().'login/session_missed');
           }
         else {
               header('Location: '.base_url());  
           } */
           
     }
     
      $this->session->set_userdata('enable_account_menu','on'); 
      $this->session->set_userdata('user','yes'); 
     
      }

//************************************************************************************
          function index () {
              $data['pages'] = $this->model_user->loadPages(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();   
              $data['main_levels_me'] = array();    
              $user_id = $this->session->userdata('user_id');   
              //$data['my_referals_all'] = $this->model_user->load_Next_Referals($user_id, 0, ''); 
              
              // load_My_Referals_Payed(); // load_My_Referals
              // echo "<pre>";  print_r($data['my_referals_all']);  echo "</pre>";  // exit;
              $data['count_my_referals'] = $this->model_user->count_My_Referals_all(); 
              $data['count_my_referals_all_active'] = $this->model_user->count_My_Referals_all_active(); 
              $data['count_my_referals_all_active_usd'] = $this->model_user->count_My_Referals_all_active_usd(); 
              $data['count_my_referals_all_active_uah'] = $this->model_user->count_My_Referals_all_active_uah(); 
              
              //echo "count_my_referals_all_active_usd <pre>"; print_r($data['count_my_referals_all_active_usd']);   
              //echo "count_my_referals_all_active_uah <pre>"; print_r($data['count_my_referals_all_active_uah']);  exit;
              
              $data['page']['title'] = lang('main_kabinet'); // Кабинет
              $data['user_info'] = $this->model_user->load_User_Cabinet();  //exit;
              //$data['my_parents'] = $this->model_user->load_Next_Parents($user_id,$data['user_info']['referal'], 1, ''); 
              //$data['user_pay_levels'] = $this->model_user->load_User_Cabinet();  
               if(empty($user_info['first_pay'])) { 
                   $data['target_info']['menu_name'] = "оплата за регистрацию участника";
                   $data['target_info']['price'] = 100;
                   $data['target_info']['text'] = "Подтвердить намерение оплатить участие и стать полноценным участником";// " Подтвердить намерения оплатить участие.<br> Сума <b>".$data['target_info']['price']."</b> грн и стать полноценным участником ";    
                   $data['target_info']['level_to'] = 0;
               }
                //  echo "<pre>"; print_r($data['user_info']);  exit;
                // echo "<pre>"; print_r($data['my_parents']); exit;
              $data['main_levels'] = array();
              $data['main_levels_me_usd'] = array();
              $data['main_levels_me_uah'] = array();
              
                  foreach($data['user_info']['my_actual_levels_usd'] as $level_usd){
                    $data['main_levels_me_usd'][] = $level_usd['target'];  
                  }
                  foreach($data['user_info']['my_actual_levels_uah'] as $level_uah){
                    $data['main_levels_me_uah'][] = $level_uah['target'];  
                  }
              
              // $data['levels'] = $this->model_user->load_Levels(); 
              // $data['levels_and_count'] = $this->model_user->load_Levels_and_count("", ""); 
               $data['levels_and_count_usd'] = $this->model_user->load_Levels_and_count("", "USD"); 
               $data['levels_and_count_uah'] = $this->model_user->load_Levels_and_count("", "UAH"); 
             // $data['levels_and_count'] = $this->model_user->load_Levels_and_count_multi($user_id, 1, '');
              // load_Levels_and_count(); 
             // $data['my_referals_all']  
              //  echo "<pre>";  print_r($data['main_levels_me_usd']); exit();
              //$data['visit_v_zaprose'] = $this->model_user->load_Levels_and_count(); 
                  
              $data['template'] = 'user/account_info_index'; 
           $this->load->view('user/index', $data);   
        }

//******************************************************************************
//************************************************************************************
          function currency_uah () {
              $data['pages'] = $this->model_user->loadPages(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();   
              $data['page_currency'] = "UAH";    
              $data['main_levels_me'] = array();    
              $user_id = $this->session->userdata('user_id');   
              $data['my_referals_all'] = $this->model_user->load_Next_Referals($user_id, 0, '', "UAH"); 
              
              // load_My_Referals_Payed(); // load_My_Referals
              // echo "<pre>";  print_r($data['my_referals_all']);  echo "</pre>";  // exit;
              $data['count_my_referals'] = $this->model_user->count_My_Referals_all(); 
              $data['count_my_referals_all_active'] = $this->model_user->count_My_Referals_all_active_uah(); 
              //$data['count_my_referals_all_active_fp'] = $this->model_user->count_my_referals_all_active_fp($user_id);  
             // $data['count_my_referals_all_active_usd'] = $this->model_user->count_My_Referals_all_active_usd(); 
             // $data['count_my_referals_all_active_uah'] = $this->model_user->count_My_Referals_all_active_uah(); 
              
              $data['page']['title'] = lang('main_kabinet')." UAH"; // Кабинет
              $data['user_info'] = $this->model_user->load_User_Cabinet();  
              //$data['my_parents'] = $this->model_user->load_Next_Parents($user_id,$data['user_info']['referal'], 1, ''); 
              //$data['user_pay_levels'] = $this->model_user->load_User_Cabinet();  
               if(empty($user_info['first_pay'])) { 
                   $data['target_info']['menu_name'] = "оплата за регистрацию участника";
                   $data['target_info']['price'] = 100;
                   $data['target_info']['text'] = " Подтвердить намерения оплатить участие.<br> Сума <b>".$data['target_info']['price']."</b> UAH и стать полноценным участником ";    
                   $data['target_info']['level_to'] = 0;
               }
                // echo "<pre>"; print_r($data['user_info']);  exit;
                // echo "<pre>"; print_r($data['my_parents']); exit;
              $data['main_levels'] = array();
              foreach($data['user_info']['my_actual_levels_uah'] as $level_usd){
                    $data['main_levels_me'][] = $level_usd['target'];  
                  }
                 /* foreach($data['user_info']['my_actual_levels_usd'] as $level_usd){
                    $data['main_levels_me_usd'][] = $level_usd['target'];  
                  }
                  foreach($data['user_info']['my_actual_levels_uah'] as $level_uah){
                    $data['main_levels_me_uah'][] = $level_uah['target'];  
                  }*/
              
              // $data['levels'] = $this->model_user->load_Levels(); 
               $data['levels_and_count'] = $this->model_user->load_Levels_and_count("", "UAH"); 
              // $data['levels_and_count_usd'] = $this->model_user->load_Levels_and_count("", "USD"); 
              // $data['levels_and_count_uah'] = $this->model_user->load_Levels_and_count("", "UAH"); 
              // $data['levels_and_count'] = $this->model_user->load_Levels_and_count_multi($user_id, 1, '');
              // load_Levels_and_count(); 
             // $data['my_referals_all']  
              //  echo "<pre>";  print_r($data['main_levels_me']); exit();
              //  echo "<pre>";  print_r($data['levels_and_count']); exit();
              //$data['visit_v_zaprose'] = $this->model_user->load_Levels_and_count(); 
                  
              $data['template'] = 'user/account_info_currency'; 
           $this->load->view('user/index', $data);   
        }

//************************************************************************************
      function currency_usd () {
              $data['pages'] = $this->model_user->loadPages(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();   
              $data['page_currency'] = "USD";    
              $data['main_levels_me'] = array();    
              $user_id = $this->session->userdata('user_id');   
              $data['my_referals_all'] = $this->model_user->load_Next_Referals($user_id, 0, '', "USD"); 
              
              // load_My_Referals_Payed(); // load_My_Referals
              // echo "<pre>";  print_r($data['my_referals_all']);  echo "</pre>";  // exit;
              $data['count_my_referals'] = $this->model_user->count_My_Referals_all(); 
              $data['count_my_referals_all_active'] = $this->model_user->count_My_Referals_all_active_usd(); 
             // $data['count_my_referals_all_active_usd'] = $this->model_user->count_My_Referals_all_active_usd(); 
             // $data['count_my_referals_all_active_uah'] = $this->model_user->count_My_Referals_all_active_uah(); 
              
              $data['page']['title'] = lang('main_kabinet')." USD"; // Кабинет
              $data['user_info'] = $this->model_user->load_User_Cabinet();  
              //$data['my_parents'] = $this->model_user->load_Next_Parents($user_id,$data['user_info']['referal'], 1, ''); 
              //$data['user_pay_levels'] = $this->model_user->load_User_Cabinet();  
               if(empty($user_info['first_pay'])) { 
                   $data['target_info']['menu_name'] = "оплата за регистрацию участника";
                   $data['target_info']['price'] = 100;
                   $data['target_info']['text'] = " Подтвердить намерения оплатить участие.<br> Сума <b>".$data['target_info']['price']."</b> USD и стать полноценным участником ";    
                   $data['target_info']['level_to'] = 0;
               }
                // echo "<pre>"; print_r($data['user_info']);  exit;
                // echo "<pre>"; print_r($data['my_parents']); exit;
              $data['main_levels'] = array();
              foreach($data['user_info']['my_actual_levels_usd'] as $level_usd){
                    $data['main_levels_me'][] = $level_usd['target'];  
                  }
                 /* foreach($data['user_info']['my_actual_levels_usd'] as $level_usd){
                    $data['main_levels_me_usd'][] = $level_usd['target'];  
                  }
                  foreach($data['user_info']['my_actual_levels_uah'] as $level_uah){
                    $data['main_levels_me_uah'][] = $level_uah['target'];  
                  }*/
              
              // $data['levels'] = $this->model_user->load_Levels(); 
               $data['levels_and_count'] = $this->model_user->load_Levels_and_count("", "USD"); 
              // $data['levels_and_count_usd'] = $this->model_user->load_Levels_and_count("", "USD"); 
              // $data['levels_and_count_uah'] = $this->model_user->load_Levels_and_count("", "UAH"); 
              // $data['levels_and_count'] = $this->model_user->load_Levels_and_count_multi($user_id, 1, '');
              // load_Levels_and_count(); 
             // $data['my_referals_all']  
              //  echo "<pre>";  print_r($data['main_levels_me']); exit();
              //  echo "<pre>";  print_r($data['levels_and_count']); exit();
              //$data['visit_v_zaprose'] = $this->model_user->load_Levels_and_count(); 
                  
              $data['template'] = 'user/account_info_currency'; 
           $this->load->view('user/index', $data);   
        }

//******************************************************************************
  function load_stat () {
           $table = $_POST['table'];
           $data['user_id'] = $this->session->userdata('user_id');   
           if($table=='history_pay'){
               $data['my_orders'] = $this->model_payments->u_load_my_payin_by_user();                
               $this->load->view('user/user/my_orders_pay', $data);   
           }
           if($table=='history_comission'){
               $data['my_orders'] = $this->model_payments->u_load_payout_by_user();                
               $this->load->view('user/user/my_orders_comission', $data);   
           }
        }     
//******************************************************************************
          function my_payin () {
              $data['pages'] = $this->model_user->loadPages(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();    
              $data['page']['title'] = "Итория оплат"; // lang('main_kabinet'); // Кабинет
              $data['user_info'] = $this->model_user->load_User_Cabinet();   
              $data['my_orders'] = $this->model_payments->u_load_my_payin_by_user();   
              // echo "<pre>";  print_r($data['my_orders']); exit();
              
              $data['template'] = 'user/my_orders_pay'; 
           $this->load->view('user/index', $data);   
        }

//******************************************************************************
           function my_payout () {
              $data['pages'] = $this->model_user->loadPages(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();    
              $data['page']['title'] = "Итория оплат"; // lang('main_kabinet'); // Кабинет
              $data['user_info'] = $this->model_user->load_User_Cabinet();   
              $data['my_orders'] = $this->model_payments->u_load_payout_by_user();   
              // echo "<pre>";  print_r($data['my_orders']); exit();
              
              $data['template'] = 'user/my_orders_pay'; 
           $this->load->view('user/index', $data);   
        }     
//******************************************************************************
 
//*******************************************************************************
function go_to_etap() {
    
   // $this->confirm_go_to_pay_reg(); exit;
       $datasend = $_POST;
       
       //=================
       switch($datasend['main_lang']){

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

        } 
 //=====================
 $user_id = $this->session->userdata('user_id');
 $first_pay =  $this ->model_user -> load_my_first_pay($user_id); 
 $user_info = $this->model_user->load_User_Anketa();  
 $empty_some_anketas=0;
 foreach($user_info as $a_it=>$a_val){
                // echo "<br>".$a_it." | ".$a_val;
                if(trim($a_val)=='') {$empty_some_anketas++;}
            }
/* $data = array();
 $data['status'] = 0;
 $data['message'] = "Данная функция находится на обслуживании";
     echo json_encode($data); 
 exit;*/
 
 if(empty($first_pay) || $first_pay=='0'){
        $data = array();
            $data['status'] = 0;
            $data['message'] = "Вы не можете перейти на какой-либо уровень, пока не подтвердите регистрацию и вступление в организацию, а так же не заполните все даныне анкеты.";   
            echo json_encode($data);   
    } else if($empty_some_anketas > 0) {
        $data['message'] = "Вы не можете перейти к оплате, пока не заполните все поля анкеты."; 
         $data['status'] = 0;
         echo json_encode($data);   
              //  echo ""; exit;
    } else {
    
     $data['main_currency'] = $datasend['main_currency'];
     //$data['curr'] = $datasend['curr']; 
     // сверка выбранной валюты и установка тарифа
     /*if($datasend['curr']=='uah') { $amount = 100; $curr_abbr = "UAH"; }
     if($datasend['curr']=='usd') { $amount = 5; $curr_abbr = "USD"; }*/
     
     
     $data['target_info'] = $this->model_user->load_target_info_by_id($datasend['level_to'], $datasend['main_currency']);     
     $data['text'] = " Подтвердить переход на <b>".$datasend['level_to']."</b> уровень.<br> Сума <b>".$data['target_info']['price']."</b> ".$datasend['main_currency']." ";    
     
     $data['level_to'] = $datasend['level_to'];
     $data['price'] = $data['target_info']['price'];
     $data['curr'] = $datasend['main_currency'];
 // = = = == =             
     $data['message'] = $this->load->view('user/orders/generate_pay_info', $data, true); 
     $data['status'] = 0;
     echo json_encode($data);   
    }     
    
} 
//*******************************************************************************
//*******************************************************************************
function confirm_go_to_etap() {
    
/* $data = array();
 $data['status'] = 0;
 $data['message'] = "Данная функция находится на обслуживании";
     echo json_encode($data); 
 exit;*/
/*     $ip_arr =array("37.57.178.246","178.255.176.82","93.188.39.123","109.86.137.253","127.0.0.1" );
    if(!in_array($_SERVER['REMOTE_ADDR'], $ip_arr)){
    echo "Данная функция находится на обслуживании"; 
    exit;
    } else {  */
       $datasend = $_POST; 
       //=================
       switch($datasend['main_lang']){

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

        } 
        //=====================
           //  echo "<pre>"; print_r($datasend); exit();  
           $order_id = $this->model_user->create_order($datasend);                                   
           $data['order'] = $this->model_user->load_Order_for_Pay($order_id);
           $data['main_currency'] = $curr = $datasend['main_currency'];
           $user_info = $this->model_user->load_User_Anketa();  
           $empty_some_anketas = 0;
            // echo "<pre>"; print_r($user_info); exit();  
            foreach($user_info as $a_it=>$a_val){
                // echo "<br>".$a_it." | ".$a_val;
                if(trim($a_val)=='') {$empty_some_anketas++;}
            }
            if($empty_some_anketas > 0) {
                echo "Вы не можете перейти к оплате, пока не заполните все поля анкеты."; exit;
            }
           
           if($curr=="UAH") { $ac_form_currency = "UAH"; }
           if($curr=="USD") { $ac_form_currency = "USD"; }
           
             $user_id = $data['order']['user_id'];  
             $order = $data['order']; 
             $amount = $order['price']; // $order['target_name']['price'];
             $order_id = "".$order['id'];
      
                  
           // $amount = "3.00";         
            $time = time(); 
            $to_hash_uah  = $this->config->config['advcash']['ac_form_email']; //"alafadobro@gmail.com";
            $to_hash_uah .= ":".$this->config->config['advcash']['ac_form'];
            $to_hash_uah .= ":".$amount;
            $to_hash_uah .= ":".$ac_form_currency; //$this->config->config['advcash']['ac_form_currency'];
            $to_hash_uah .= ":".$this->config->config['advcash']['ac_form_secret'];
            $to_hash_uah .= ":".$order_id;

            $ac_sign_uah = hash('sha256', $to_hash_uah);
                $form =  
                '<br><form method="post" action="https://wallet.advcash.com/sci/">
                     <input type="hidden" name="ac_account_email" value="'.$this->config->config['advcash']['ac_form_email'].'" />
                     <input type="hidden" name="ac_sci_name" value="'.$this->config->config['advcash']['ac_form'].'" />
                     <input type="hidden" name="ac_amount" value="'.$amount.'" />
                     <input type="hidden" name="ac_currency" value="'.$ac_form_currency.'" />
                     <input type="hidden" name="ac_order_id" value="'.$order_id.'" />
                     <input type="hidden" name="ac_sign" value="'.$ac_sign_uah.'" />
                     <!-- Optional Fields -->
                     <input type="hidden" name="ac_success_url" value="http://alafa.com.ua/'.lang("main_lang").'/payment/ac_u_answer/success" />
                     <input type="hidden" name="ac_success_url_method" value="POST" />
                     <input type="hidden" name="ac_fail_url" value="http://alafa.com.ua/'.lang("main_lang").'/payment/ac_u_answer/failure" />
                     <input type="hidden" name="ac_fail_url_method" value="POST" />
                     <input type="hidden" name="ac_status_url" value="http://alafa.com.ua/'.lang("main_lang").'/payment/ac_u_answer/status" />
                     <input type="hidden" name="ac_status_url_method" value="POST" />
                     <input type="hidden" name="ac_comments" value="Оплата уровня '.$data['order']['target'] .' | '.$amount.' '.$ac_form_currency.' " />
                     <input type="submit" class="gopaybtn" value="Перейти к оплате уровня '.$data['order']['target'] .' | '.$amount.' '.$ac_form_currency.' " />
            </form>';   
        
         $data['form'] = $form;   
         $data['order_id'] = $order_id;      
         $data['text'] = "Перейти к оплате. <br> Сума ".$amount." ".$ac_form_currency."  ";;     
         // = = = == =             
         $this->load->view('user/orders/orders_user_confirm_pay', $data); 
   // }
  
} 
//*******************************************************************************
 function tmk_ch() {
  // echo "<pre>"; print_r($_POST);
 $data_main_lang = $_POST['main_lang'];
 $curr = $_POST['curr'];
 $data_t = $_POST['t'];
 $data_kq = $_POST['kq'];
 
 $user_id = $this->session->userdata('user_id');
 // echo "<pre>"; print_r($data['my_referals_all']);
    
     $my_referals_all = $this->model_user->load_Next_Referals($user_id, 0, ''); 
     $levels_and_count = $this->model_user->load_Levels_and_count($data_t); 
     //echo "<pre>"; print_r($my_referals_all);
     $data_form['user_info'] = $user_info = $this->model_user->load_User_Cabinet();  
     /*foreach($user_info['my_actual_levels'] as $level){
                    $main_levels_me[] = $level['target'];  
                  }*/
                  if($curr=="UAH") {
                      foreach($data_form['user_info']['my_actual_levels_uah'] as $level_usd){
                        $main_levels_me[] = $level_usd['target'];  
                      }          
                  } 
                  if($curr=="USD") {
                      foreach($data_form['user_info']['my_actual_levels_usd'] as $level_usd){
                        $main_levels_me[] = $level_usd['target'];  
                      }          
                  }        
     //echo "<pre>"; print_r($user_info);
     
     
     //============= калькуляция возможной комиссии ========= начало ================== ============== ==================
$level_balls_arr = array(
    "1"=>  "1" ,
    "2"=>  "2" ,
    "3"=>  "3" ,
    "4"=>  "4" ,
    "5"=>  "5" ,
    "6"=>  "6" ,
    "7"=>  "7" ,
    "8"=>  "8" ,
    "9"=>  "9" ,
    "10"=>   "R"
    );  
$level_komiss_prc = array(
    1=> array(1=> "25" , 2=> "6" ,3=> "5" ),     
    2=> array(1=> "25" , 2=> "6" ,3=> "5" ),     
    3=> array(1=> "25" , 2=> "6" ,3=> "5" ),     
    4=> array(1=> "30" , 2=> "6" ,3=> "5" ),     
    5=> array(1=> "30" , 2=> "6" ,3=> "5" ),     
    6=> array(1=> "30" , 2=> "6" ,3=> "5" ),     
    7=> array(1=> "30" , 2=> "6" ,3=> "5" ),         
    8=> array(1=> "30" , 2=> "6" ,3=> "5" ),     
    9=> array(1=> "30" , 2=> "6" ,3=> "5" ),     
    10=> array()
    );  
            
 $level_count_refs = array(
    "1"=> 0 ,     "2"=> 0 ,     "3"=> 0 ,
    "4"=> 0 ,     "5"=> 0 ,     "6"=> 0 ,
    "7"=> 0 ,     "8"=> 0 ,     "9"=> 0 ,
    "10"=> 0
    );    
$count_1refs_levels = array(
    "1"=> 0 ,     "2"=> 0 ,     "3"=> 0 ,
    "4"=> 0 ,     "5"=> 0 ,     "6"=> 0 ,
    "7"=> 0 ,     "8"=> 0 ,     "9"=> 0 ,
    "10"=> 0
    ); 
$count_2refs_levels = array(
    "1"=> 0 ,     "2"=> 0 ,     "3"=> 0 ,
    "4"=> 0 ,     "5"=> 0 ,     "6"=> 0 ,
    "7"=> 0 ,     "8"=> 0 ,     "9"=> 0 ,
    "10"=> 0
    ); 
$count_3refs_levels = array(
    "1"=> 0 ,     "2"=> 0 ,     "3"=> 0 ,
    "4"=> 0 ,     "5"=> 0 ,     "6"=> 0 ,
    "7"=> 0 ,     "8"=> 0 ,     "9"=> 0 ,
    "10"=> 0
    );         
 $level_word_arr = array(
    "1"=>   lang('main_level1') ,
    "2"=>   lang('main_level2') ,
    "3"=>   lang('main_level3') ,
    "4"=>   lang('main_level4') ,
    "5"=>   lang('main_level5') ,
    "6"=>   lang('main_level6') ,
    "7"=>   lang('main_level7') ,
    "8"=>   lang('main_level8') ,
    "9"=>   lang('main_level9') ,
    "10"=>  lang('main_level10') ,
    );             
//-------------------------------    
$levels_ids_list = '';
$main_levels = array(); 
 if(isset($referal['actual_levels']) && !empty($referal['actual_levels'])) { 
  foreach($referal['actual_levels'] as $level){  $main_levels[] = $level['target'];    } 
  $main_levels = array_unique($main_levels); $levels_ids_list = implode(", ", $main_levels);    
 }
//-------------------------------     


/*  ===============  перепроверка с счетчиком ====== начало ======================  */
  if(isset($my_referals_all['list'])) { 
   if(!empty($my_referals_all['list'])) {  
 foreach ($my_referals_all['list'] as $referal){
     
     $levels_ids_list = '';
                        $main_levels = array(); 
                         if(isset($referal['actual_levels']) && !empty($referal['actual_levels'])) { 
                          foreach($referal['actual_levels'] as $level){
                            $main_levels[] = $level['target'];  
                          } 
                          $main_levels = array_unique($main_levels); $levels_ids_list = implode(", ", $main_levels);  // echo $levels_ids_list;  
                         }
                         
                         
   foreach($level_balls_arr as $lba_key=>$lba_val) {                           
     if(in_array($lba_key, $main_levels)) { $level_count_refs[$lba_key] = $level_count_refs[$lba_key]+1; $count_1refs_levels[$lba_key] = $count_1refs_levels[$lba_key]+1; }      
   } 
       
 /*?>=========== уровень два - начало =============<?php */ 
 
  if(isset($referal["next_referals"]["list"]) && !empty($referal["next_referals"]["list"])) {   // next_referals second  
                                     foreach ($referal["next_referals"]["list"] as $referal2){  
                                             $main_levels2 = array(); 
                                             $levels_ids_list2 = '';
                                             if(isset($referal2['actual_levels']) && !empty($referal2['actual_levels'])) { 
                                              foreach($referal2['actual_levels'] as $level2){
                                                $main_levels2[] = $level2['target'];  
                                              } 
                                              $main_levels2 = array_unique($main_levels2); $levels_ids_list2 = implode(", ", $main_levels2); //echo $levels_ids_list2;  
                                             }
                                        
 foreach($level_balls_arr as $lba_key=>$lba_val) { 
  if(in_array($lba_key, $main_levels2)) {   $level_count_refs[$lba_key] = $level_count_refs[$lba_key]+1;  $count_2refs_levels[$lba_key] = $count_2refs_levels[$lba_key]+1; }      } 
  
  /*?>=========третий уровень - начало======<?php */
  
   if(isset($referal2["next_referals"]["list"]) && !empty($referal2["next_referals"]["list"])) {   // next_referals third  
 foreach ($referal2["next_referals"]["list"] as $referal3){  
     
                                            $main_levels3 = array(); 
                                            $levels_ids_list3  = '';
                                        //    echo "<pre>"; print_r($referal3['actual_levels']); echo "</pre>";
                                             if(isset($referal3['actual_levels']) && !empty($referal3['actual_levels'])) {
                                                 //echo "===";
                                                 
                                              foreach($referal3['actual_levels'] as $level3){
                                                $main_levels3[] = $level3['target'];  
                                              } 
                                              $main_levels3 = array_unique($main_levels3); $levels_ids_list3 = implode(", ", $main_levels3);  // echo $levels_ids_list3;  
                                             }
                                            
 foreach($level_balls_arr as $lba_key=>$lba_val) {
 if(in_array($lba_key, $main_levels3)) {  $level_count_refs[$lba_key] = $level_count_refs[$lba_key]+1;  $count_3refs_levels[$lba_key] = $count_3refs_levels[$lba_key]+1; }      } 
 
   } } // next_referals
   
  /*?>=========третий уровень - конец======<?php */   }
  } // next_referals  
   /*?>=========== уровень два - конец =============<?php */
   
     }  
    
 }  else {   echo "за вами уже выехали";  }  // есил пусто или не пусто в списке рефералов
  }      //  if(isset($my_referals_all['list'])) 
/*  ===============  перепроверка с счетчиком ====== конец ======================  */


                    
$is_k_s = ''; $summ1_out=''; $summ2_out=''; $summ3_out=''; $summ_all_out = '';
foreach($level_word_arr as $key_w=>$val_w) { 
   
      if($key_w == $data_t){
          if($count_1refs_levels[$key_w]> 0 && $count_1refs_levels[$key_w]>=5 && $data_kq=='1') {  // $count_1refs_levels[$key_w] % 5 == 0) 
              $is_can_count1 = floor($count_1refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
              $is_k_s .= "<br>есть комиссия уровня  1";  
              
              $summ1_out = $levels_and_count[$key_w-1]['price']*5/100*$level_komiss_prc[$key_w][1];   
//              echo "<br>есть комиссия уровня  1 | ".$summ1_out;   
          }
          if($count_2refs_levels[$key_w]> 0 && $count_2refs_levels[$key_w] >=5 && $data_kq=='2') {  //  % 5 == 0 
              $is_can_count2 = floor($count_2refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ; 
              $is_k_s .= "<br>есть комиссия уровня  2";  
              
              $summ2_out = $levels_and_count[$key_w-1]['price']*5/100*$level_komiss_prc[$key_w][2];  
//              echo "<br>есть комиссия уровня  2 | ".$summ2_out;  
          }
          if($count_3refs_levels[$key_w]> 0 && $count_3refs_levels[$key_w] >=5 && $data_kq=='3') { //  % 5 == 0 
              $is_can_count3 = floor($count_3refs_levels[$key_w]/5) - $levels_and_count[$key_w-1]['count_visit_v_zaprose_payet'] ;  
              $is_k_s .= "<br>есть комиссия уровня  3";  
              
              $summ3_out = $levels_and_count[$key_w-1]['price']*5/100*$level_komiss_prc[$key_w][3];   
//              echo "<br>есть комиссия уровня  3 | ".$summ3_out;  
          } 
      }
}
 // in_array($data_t, array() &&
$summa_get = 0;
if( $data_kq=='1' && $summ1_out>0) { $summa_get = $summ1_out ;}
if( $data_kq=='2' && $summ2_out>0) { $summa_get = $summ2_out ;}
if( $data_kq=='3' && $summ3_out>0) { $summa_get = $summ3_out ;}

//echo "<br>==========".$summa_get."==========<br>";

if($is_k_s!='' && in_array($key_w , $main_levels_me) ) { 
             $data['message'] = 'Идет создание запроса. Сейчас система генерирует форму подтверждения.'; 
             //$data['url'] = 'take_my_komission';
             $data['status'] = 1;
             $data_form['level_to'] = $data['d_t'] = $data_t;
             $data_form['d_kq'] = $data['d_kq'] = $data_kq;
             $data_form['summa_get_show'] = $summa_get;
             $data_form['summa_get_hash'] = base64_encode($summa_get);
             //$data_form['summa_get'] = base64_encode($summa_get);
             $data_s = $summa_get;
              
             $data_form['user_id'] = $signature = $user_id;
             $link_encoded = base64_encode($signature); 
             $lqsignature = base64_encode(sha1($signature.$link_encoded.$signature,1)); 
             $data_form['lqsignature'] = $data['lqsignature'] = base64_encode($lqsignature."-".$data_t."-".$data_kq."-".$data_s); 
             
             
             
             //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
             $user_info = $this->model_user->load_User_Anketa();  
                $empty_some_anketas = 0; 
                        foreach($user_info as $a_it=>$a_val){ 
                            if(trim($a_val)=='') {$empty_some_anketas++;}
                        }
                        if($empty_some_anketas > 0) {
                            $data['message'] = "Вы не можете перейти к оплате, пока не заполните все поля анкеты."; // exit;
                            $data['status'] = 0;
                        }
             //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
             
             
             
             $data['form_callb'] = $this->load->view('user/orders/vivod_komissii', $data_form, true);;
             //echo $count_cantake_1.$count_cantake_2.$count_cantake_3; 
 } else if($is_k_s!='' && !in_array($key_w , $main_levels_me) ) {   
             //echo '<span class="tmk_nop">Откройте '.$data_t.' этап для получения коммиссии с его '.$data_kq .' уровня </span>';
             $data['message'] = '<span class="tmk_nop">Откройте '.$data_t.' этап для получения коммиссии с его '.$data_kq .' уровня </span>'; 
             $data['url'] = '';
             $data['status'] = 0;
 } else {
             $data['message'] = 'таки шото не то? срочно сообщите в техподдержку!'; 
             $data['url'] = '';
             $data['status'] = 0;
 }
 echo json_encode($data);
    /* $data['message'] = 'Идет создание запроса. Сейчас система перенправит Вас на страницу подтверждения.';  
     $data['url'] = '/'.$data_main_lang.'/';
     $data['status'] = 0;
     echo json_encode($data); */  
             
/*echo " <br> -> комиссии 1 = ".$summ1_out;
echo " <br> -> комиссии 2 = ".$summ2_out;
echo " <br> -> комиссии 3 = ".$summ3_out;
echo " <br> -> комиссии вообще  = ".$is_k_s;*/
     //============= калькуляция возможной комиссии ========= конец  ================== ============== ==================
     //=============
     
     //$data['level_to'] = $id_level;
 
     //$data['template'] = 'orders/vivod_komissii'; 
     //$this->load->view('user/index', $data);   
     
} 
//*******************************************************************************<br>
//***********************************************************************************
 function get_komission () {
        
    $user_id = $this->session->userdata('user_id');
    $data = $_POST;
    $lang =  $data['lang'];  
    
    $data['summa'] = $data_summa = base64_decode($_POST['sip2']);
    //echo $data_summa; exit;
    $data['target'] = $data_t = $_POST['level_to'];
    $data['from_level'] = $data_kq = $_POST['d_kq'];
    $lqsignature_post = $_POST['lqsignature'];
     
    $data['user_info'] = $user_info = $this->model_user->load_User_Anketa();  // $data['user_info'] = 
    $email = trim($user_info['email']);
    //$name = trim($user_info['fio']); 
    $adv_uid = trim($user_info['adv_uid']); 
    
    /*
     $signature = $user_id;
     $link_encoded = base64_encode($signature); 
     $lqsignature = base64_encode(sha1($signature.$link_encoded.$signature,1)); 
     $data_form['lqsignature'] = $data['lqsignature'] = base64_encode($lqsignature."-".$data_t."-".$data_kq); 
             */
    
    $signature = $user_id; 
    $link_encoded = base64_encode($signature); 
    //$data_summa = base64_encode($data_summa); 
    $lqsignature = base64_encode(sha1($signature.$link_encoded.$signature,1)); 
    $lqsignature_now = base64_encode($lqsignature."-".$data_t."-".$data_kq."-".$data_summa); 
    
    
     
    if($lqsignature_now == $lqsignature_post) {
            
    $this->model_user->add_zapros_vivoda($data);
    //  header('Location: '.base_url().''.$lang.'/page/answer_cont/'); 
    //  echo base_url().$lang.'/page/answer_cont'; 
    //  echo 1; 
   $data = array();
            $data['status'] = 1; 
            $data['message'] = '  Запрос отправлен успешно. Статус запроса вы можете видеть в личном кабинете проекта.';  
            echo json_encode($data);  
    } else {
            $data['status'] = 0; 
            $data['message'] = 'Обнаружено несовпадение данных. Обратитесь на горячую линию проекта.';  
            echo json_encode($data);  
    }
        }     
//************************************************************************************ 
function take_my_komission( ) {
    
     $data['pages'] = $this->model_user->loadPages();
     $data['blocks'] = $this->model_user->loadBlocksIndex();      
     $data['page']['title'] = 'Запрос получения комиссии';
     $data['page']['descr'] = 'Запрос получения комиссии';
     $data['page']['h1'] = 'Запрос получения комиссии';
     $data['page']['menu_name'] = 'Запрос получения комиссии';
              
     $my_referals_all = $this->model_user->load_Next_Referals($user_id, 0, ''); 
     $levels_and_count = $this->model_user->load_Levels_and_count(); 
 
     $data['template'] = 'orders/vivod_komissii'; 
     $this->load->view('user/index', $data);   
     
} 
//*******************************************************************************
function take_my_komission_oldddd( ) {
    
     $data['pages'] = $this->model_user->loadPages();
     $data['blocks'] = $this->model_user->loadBlocksIndex();      
     $data['page']['title'] = 'Запрос получения комиссии';
     $data['page']['descr'] = 'Запрос получения комиссии';
     $data['page']['h1'] = 'Запрос получения комиссии';
     $data['page']['menu_name'] = 'Запрос получения комиссии';
              
     $data['user_info'] = $this->model_user->load_User_Cabinet();  
 // echo "<pre>"; print_r($data['my_referals_all']);
    
     $data['levels_and_count'] = $this->model_user->load_Levels_and_count(); 
 
     $data['level_to'] = $id_level;
 
     $data['template'] = 'orders/vivod_komissii'; 
     $this->load->view('user/index', $data);   
     
} 
//*******************************************************************************
function take_my_komission_new( ) {
    
     $data['pages'] = $this->model_user->loadPages();
     $data['blocks'] = $this->model_user->loadBlocksIndex();      
     $data['page']['title'] = 'Запрос вывода комиссии';
     $data['page']['descr'] = 'Запрос вывода комиссии';
     $data['page']['h1'] = 'Запрос вывода комиссии';
     $data['page']['menu_name'] = 'Запрос вывода комиссии';
              
     $data['user_info'] = $this->model_user->load_User_Cabinet();  
              // echo "<pre>"; print_r($data['my_referals_all']);
     $data['main_levels'] = array();
              
          foreach($data['user_info']['my_actual_levels'] as $level){
            $data['main_levels'][] = $level['target'];  
          }
              
 // $data['levels'] = $this->model_user->load_Levels(); 
     $data['levels_and_count'] = $this->model_user->load_Levels_and_count(); 
 //=====================
    // $data['target_info'] = $this->model_user->load_target_info_by_id($id_level);     
     //$data['text'] = " Подтвердить переход на <b>".$datasend['level_to']."</b> уровень.<br> Сума <b>".$data['target_info']['price']."</b> грн ";    
     //$data['level_to'] = $id_level;
     //$data['price'] = $data['target_info']['price'];
 // = = = == =             
     
     $data['template'] = 'orders/vivod_komissii_new'; 
     $this->load->view('user/index', $data);   
} 
//*******************************************************************************
function order_try_to_pay_0000000() {
    
       // $lang = $this->uri->segment(1); 
       // $lang = lang('main_lang'); 
          
       $datasend = $_POST;
          
       $order_id = $this->session->userdata('order_id');
        if(isset($order_id) && $order_id!='') {
       $order_id = $this->session->userdata('order_id'); 
        } 
        else{
         $order_id = $this->session->userdata('order_id_check');
        }  
    
           $data['order_id'] = $order_id;                                        
           $data['order'] = $this->model_user_shop->load_Order_for_Pay($order_id);
           $user_id = $data['order']['id_user']; 
           //payment_status
           if($data['order']['payment_status']=='1'){
           $this->model_bills->update_order_status($user_id, $order_id, '2'); 
           } 
          /*  ---- generate form ----  */ 
           $order = $data['order'];
           
    $merchant_id='i30240804689';
    $signature="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant    
    $url="https://liqpay.com/?do=clickNbuy";
    //        https://liqpay.com/?do=clickNbuy
    //$url="https://www.liqpay.com/?do=clickNbuy"; 
     
    $method='card';
    //$phone='+20123145121';
    $phone = $order['phone'];
    $phone = str_replace(array('_', '-', '—','(',')', ' '), '', trim($phone));
    $amount = $order['total_sum_to_pay'];
    $order_id = "ORDER_".$order['id'];
    
    $site_url = base_url();
    $server_url = $site_url.'payment/answer';
    $result_url = $site_url.'shop/payment_done';
    
    $description = lang('main_payment_oplata_zakaza_v_magazine');
   // $description = mb_convert_encoding($description, "windows-1251", "UTF-8"); 
    
    $xml="<request>      
        <version>1.2</version>
        <result_url>$result_url</result_url>
        <server_url>$server_url</server_url>
        <merchant_id>$merchant_id</merchant_id>
        <order_id>$order_id</order_id>
        <amount>$amount</amount>
        <currency>UAH</currency>
        <description>$description $order_id</description>
        <default_phone>$phone</default_phone>
        <pay_way>$method</pay_way> 
        </request>
        ";              
    // $sign=base64_encode(sha1($merc_sign.$xml.$merc_sign,1));   
   // echo $xml; exit();
  // print_r( $string);
  //  exit(); 
   // ---------------------------------------------------     
     $button_value = 'Продолжить'; // lang('main_user_order_i_confirm');
    
    $xml_encoded = base64_encode($xml); 
    $lqsignature = base64_encode(sha1($signature.$xml.$signature,1)); //поле signature, данная подпись имеет вид: подпись(пароль) мерчанта + неупакованный XML - операции + подпись(пароль) мерчанта     
    
    $form =  
    "<form action='$url' method='POST'>
      <input type='hidden' name='operation_xml' value='$xml_encoded' />
      <input type='hidden' name='signature' value='$lqsignature' />
    <input type='submit'  class='styled_button_wide' value='$button_value' />
    </form>"
     ;
    
     $data['form'] = $form;     
          // = = = == =             
           $this->load->view('user/orders/orders_user_confirm_pay', $data); 
           
           
      //   echo base_url().'shop/order_list/'.$order_id ;
      //    }
       //   }  
} 
//************************************************************************************ 
        function edit () {

            $data['pages'] = $this->model_user->loadPages();    
        
              $data['blocks'] = $this->model_user->loadBlocksIndex();  
              $data['page']['title'] = 'Кабинет';
              $data['user_info'] = $this->model_user->load_User_Cabinet();  
               
             $data['template'] = 'user/settings_profile'; 
           $this->load->view('user/index', $data);
              
        }           
//************************************************************************************ 
        function settings_000000 () {

              $data=array();
            
             $data['user_info'] = $this->model_user->load_User_Cabinet(); // load_User_Cabinet   load_User_Settings
            // echo "<pre>";   print_r($data['user_info']);   
             $data['template'] = 'user/settings_account'; 
          $this->load->view('user/main', $data);
         
        }     
//************************************************************************************
  function edit_general_settings() {

        $dataedit = $_POST;
        //  echo "<pre>";   print_r($dataedit); exit();
        
        $mobil_operators = array(  "38039", "38050", "38063", "38066", "38067", "38068", "38091", "38091", "38092", "38093", "38094", "38095", "38096", "38097", "38098", "38099");     
        
        
        if(trim($dataedit['ed_name']) ==''){
            echo "Введите имя";
        }
        else if(trim($dataedit['ed_surname']) ==''){
            echo "Введите фамилию ";
        }
         
        else if(trim($dataedit['ed_phone']) ==''){
            echo "Введите номер мобильного телефона";
        }
        else if (strlen($dataedit['ed_phone'])<10) {        
            echo "неверный формат номера телефона";   
        }
       /* else if (  !in_array(substr($dataedit['ed_phone'], 0, 5), $mobil_operators)) {   
            echo "неверный код оператора мобильной связи"; 
        } */
        else {
        $this->session->set_userdata('name',$dataedit['ed_name']);
        $this->model_user->edit_general_settings($dataedit);
    
      //echo " Изменения сохранены успешно ";
      echo lang('main_user_changes_saved_successfully');
          }
          }               
//************************************************************************************
  function edit_access_pass_settings() {

          $dataedit = $_POST;
          
          if($dataedit['newpass']=='') {
         // echo " Вы не ввели новый пароль для замены ";
         echo lang('main_user_changes_a_new_password');      
          } 
          else  if(strlen($dataedit['newpass']) < 6) {
        //  echo " Пароль должен быть не менее 6 символов";
           echo lang('main_user_changes_pass_must_be_greater_than'); 
          }
          else if($dataedit['newpass']!=$dataedit['confirm_newpass']) {
         // echo " Вы не верно ввели пароль во второе поле ";
           echo lang('main_user_changes_not_enter_the_password_correctly_in_the_second');   
          }
          else{
              $this->model_user->edit_access_pass_settings($dataedit);
         // echo " Пароль заменён успешно ";
          echo lang('main_user_changes_password_changed_successfully'); 
          }
          }  
//***********************************************************************************
 function edit_subscr_settings() {

          $dataedit = $_POST;
           //     echo "<pre>";
          // print_r($dataedit); exit(); 
           if (isset($dataedit['subscr'])){
               
               $status = 1;
               
             
         // echo " Новый адрес почты сохранен успешно ";
          
           }
           else  {
                $status = 0;        
           }
            $this->model_user->edit_subscr_settings($status);   
            echo lang('main_user_changes_subscr_saved_successfully');           
          } 
//***********************************************************************************
//************************************************************************************
  function profile_data_edit_contact() {

          $dataedit = $_POST;
        //  echo "ответ сервера :<br>";
        //  echo "<pre>";
        //  print_r($dataedit); exit();
          $this->model_user->edit_contact_settings($dataedit);
          $this->session->set_userdata('profile_settings_tab', '1'); 
         //  echo " Контактные данные изменены успешно "; 
           echo base_url().'user/edit' ;  
          }  
//************************************************************************************
   
//************************************************************************************
 function profile_data_edit_adres() {

          $dataedit = $_POST;
        //  echo "ответ сервера :<br>";
        //  echo "<pre>";
        //  print_r($dataedit); exit();
          $this->model_user->edit_adres_settings($dataedit);
        //  $this->session->set_userdata('profile_settings_tab', '2'); 
         // echo " Адрес изменен успешно "; 
        //   echo base_url().'user/edit' ;
         $this->session->set_userdata('profile_settings_tab', '1'); 
         //  echo " Контактные данные изменены успешно "; 
           echo base_url().'user/edit' ;    
          }  
//************************************************************************************
         function add_education_touser () {
              $data = $_POST;
           //   if (isset($data['dateforadd'])){
           //    $data['dateforadd'] = $data['dateforadd']; 
           //   }
           //   $data['customers'] = $this->model_calendar_manager->loadCustomersforCalendar();
           //   $data['manager'] = $this->model_pages->loadUsers();
           // $data['template'] = 'user/settings_account';
         $this->load->view('user/user/add_education_touser'); 
     }
 //************************************************************************************
                 
//************************************************************************************
  function edit_access_email_settings() {

          $dataedit = $_POST;
          
          if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $dataedit['ed_email'])){ 
      
           // echo "Неверно введен email";
             echo lang('main_login_wrong_email');     
    }
          else{
              $this->model_user->edit_access_email_settings($dataedit);
         // echo " Новый адрес почты сохранен успешно ";
          echo lang('main_user_changes_email_saved_successfully'); 
          }
          }               
//************************************************************************************        
function my_certificate() {
    $mode_test = 'watermark_text_center_strings';
  //  $user_id = time();
  //  echo "<br> МОД = ".$mode_test. " | ID = ".$user_id."<br>";
    
$user_id = $this->session->userdata('user_id');  //echo $user_id; exit; 
if(!isset($user_id) || empty($user_id)){    
                  $this->error_404();  
             } else {
    $data['user_info'] = $this->model_user->load_User_Cabinet();
    // watermark_text2
    // watermark_text2_ttf
    // watermark_text
    // watermark_text_center_strings
   
            $oldimage_name =  $_SERVER['DOCUMENT_ROOT']."/media/images/cert/q1_fin1.jpg"; // __DIR__ cert1
//             $font = base_url()."media/css/user/fonts/PragmaticaCondCTT.ttf";
//            $font = $_SERVER['DOCUMENT_ROOT']."/system/fonts/texb.ttf";
//            $font =$_SERVER['DOCUMENT_ROOT']."/system/fonts/texb.ttf";
            $font =$_SERVER['DOCUMENT_ROOT']."/media/css/user/fonts/alafa_logo.ttf";
//            $font =$_SERVER['DOCUMENT_ROOT']."/media/css/user/fonts/PragmaticaCondCTT.ttf";
            $new_image_name = $_SERVER['DOCUMENT_ROOT']."/upload/cert/".$user_id."-".time().".jpg";
            
    $water_mark_text = array(
    'name' => $data['user_info']['name']." ".$data['user_info']['surname'],
    'ref_num' =>  numberFormat($data['user_info']['id'], 6) 
    );  
            
/*$font = 'Vera.ttf';
$test = imagettfbbox(10, 10, $font, 'test');
echo "\n<br>What PHP version? ".phpversion();
$read = file_exists($font)?'Yes':'No';
echo "\n<br>Does font '$font' exist? ".$read;
$read = is_readable($font)?'Yes':'No';
echo "\n<br>Is font '$font' readable? ".$read;
  */           
                      
         
            
    $mode_test($oldimage_name, $new_image_name, $water_mark_text);
             }
}
//***********************************************************************************
      
//************************************************************************************   
//***********************************************************************************
 function watermark_text($user_id = 0) {
$config['source_image']    = $_SERVER['DOCUMENT_ROOT'].'/media/images/cert/cert1.jpg';
$img_show = $_SERVER['DOCUMENT_ROOT'].'/media/images/cert/cert1.jpg';
//$img_show = '../../media/images/cert/cert1.jpg';
//$img_show = base_url().'/media/images/cert/cert1.jpg';
$config['wm_text'] = 'Copyright 2006 - John Doe';
$config['wm_type'] = 'text';
$config['wm_font_path'] = $_SERVER['DOCUMENT_ROOT'].'/system/fonts/texb.ttf';
//$config['wm_font_path'] = './system/fonts/texb.ttf';
$config['wm_font_size']    = '36';
$config['wm_font_color'] = 'ffffff';
$config['wm_vrt_alignment'] = 'middle';
$config['wm_hor_alignment'] = 'center';
$config['wm_padding'] = '20';

$this->image_lib->initialize($config); 

$this->image_lib->watermark();

Header("Content-type: image/jpeg"); //указываем на тип передаваемых данных
imagejpeg($img_show);
echo "готово";
        }
 //***********************************************************************************
 function watermark_text2($user_id = 0) {
            $oldimage_name =  "/media/images/cert/cert1.jpg"; // __DIR__
            $font = base_url()."media/css/user/fonts/PragmaticaCondCTT.ttf";
            $new_image_name = "/upload/cert/".$user_id."-".time().".jpg";
            $water_mark_text = "Петров Василий";
    watermark_text($oldimage_name, $new_image_name, $water_mark_text);
     
        }
//***********************************************************************************
 function add_feed () {
            $data = $_POST;
     $lang =  $data['lang'];
     if(trim($data['fio'])=='' && trim($data['email'])=='' && trim($data['text'])=='' ) {
        header('Location: '.base_url().''.$lang.'/page/contacts');
     }    
     $this->model_user->add_feed($data);
     header('Location: '.base_url().'/page/answer_cont/'); 
        }
//************************************************************************************  
  
//************************************************************************************         
 //************************************************************************************
function profile_data_load_towns () {
               $data = $_POST;
             //  print_r($data);
             $data['towns'] = $this->model_user->load_Towns($data['id']);
      foreach ( $data['towns'] as $town) {
     echo '<option value="' . $town['id'] . '">' . $town['name'] . '</option>' . "\r\n";
             }
             
        
        
        }
//************************************************************************************
  //*******************************************************************************

 function order_print ($order_id) {
     
     
     // - if not logged in  ---------------
     $user = $this->session->userdata;   
     if (!isset($user['email']) || !isset($user['user_id'])) {
         
           header('Location: '.base_url());  
      
     }
     // - if not logged in    ----------
     
     $check_ismy_order = $this->model_user->check_ismy_order($order_id);
     if(!isset($check_ismy_order['id']) || $check_ismy_order['id']!=$order_id) {
      // header('Location: '.$_SERVER['HTTP_REFERER']); 
      header('Location: '.base_url());
     }
     else {
     $data=array();
             $data['order_list'] = $this->model_user->load_Order_List($order_id);  
             $data['order_template'] = $this->model_user->loadOrder_Template();
             
             
      //  $data['template'] = 'shop/order_print_user';       
  
  if (isset($check_ismy_order['id']) && $check_ismy_order['id'] == $data['order_list']['id']){
      $text_order = $this->generate_order_items_template($order_id);  
         
      $data['text_order'] = $text_order;   
        $this->load->view('user/orders/order_print_user', $data);
 } 
     }
 }  
 //************************************************************************************    
 //*******************************************************************************

 function generate_order_items_template ($order_id) {
   //  echo "generate_order_items_template";
     $text_order = '';
    // - if not logged in  ---------------
     $user = $this->session->userdata;   
 
     // - if not logged in    ----------
   
     // - check my order ----
       $check_ismy_order = $this->model_user->check_ismy_order($order_id); 
                            
       // - check my order ---- 
                         
       $data=array();
         
             $data['order_id'] = $order_id ;
             
 $data['order_list'] = $this->model_user->load_Order_List($order_id); 
 //  $data['delivery_services'] = $this->model_user_shop->load_Delivery_services();
 //echo "<pre>"; print_r( $data['order_list']); exit();  
 $data['order_template'] = $this->model_user->loadOrder_Template(); 
   
 
  $order_ident_sess =  $this->session->userdata('order_id'); // echo $order_ident_sess."<br>/// - ";
  $user_id_sess =  $this->session->userdata('user_id');      // echo $user_id_sess; exit();
     
  if (isset($data['order_list']['id']) 
      && $check_ismy_order['id'] == $data['order_list']['id'] 
      || $check_ismy_order['id_user'] == $data['order_list']['id_user'] ){
  
  
   //////////////////////////////    
 $target_info = $this->model_user->load_target_info_by_id($data['order_list']['target']);  
 $date_order = date("Y-m-d H:i", $data['order_list']['datetime_create']);      
       
 $id_order = $data['order_list']['id'];
 $id_user = $data['order_list']['user_id'];
 $date_order = $date_order;
 $name = $data['order_list']['user_info']['name'];
 $surname = $data['order_list']['user_info']['surname'];
 $byfather = $data['order_list']['user_info']['byfather'];
 $town = $data['order_list']['user_info']['town'];
 $adres = $data['order_list']['user_info']['adres'];
 $postindex = $data['order_list']['user_info']['postindex'];
 $email = $data['order_list']['user_info']['email'];
 $phone = $data['order_list']['user_info']['phone'];
 
 $total_sum = $data['order_list']['price']; 
 
 //$order_list['order_items'];
//echo " "; 
//echo $products; 
//echo " "; 

$search = array (
 '#id_order#',
 '#id_user#',
 '#date_order#',
 '#name#',
 '#surname#',
 '#byfather#',  
 '#town#',
 '#adres#',     
 '#email#',
 '#phone#', 
 '#total_sum#' ,
 '#total_sum_to_pay#',
 '#level_name#'
);
 
$replace = array (
$id_order,
 $id_user,
 $date_order,
 $name,
 $surname,
 $byfather,   
 $town,
 $adres,       
 $email,
 $phone, 
 $total_sum ,
 $total_sum,
 $target_info['menu_name']
); 
 
$document = $data['order_template']['text'];
$text_order = str_replace($search, $replace, $document);

                 
  //-=-=-=-=-=-=-=-=-=-=-=-=-=-     
 
     } // if not logged   
     return $text_order;      
    }     


//*******************************************************************************   
 //************************************************************************************       
//************************************************************************************ 
//************************************************************************************
  
//************************************************************************************  
function town_name() {

    $data = $_POST;
    $keyword = $data['term'];  
    // $datawords = $this->model_shipping->loadOrgForAdd($keyword);
    $datawords = $this->model_user->loadTownNameForSearch($keyword);      

    $keywords = array();
        foreach ($datawords as $datawords){                                                         
 //   $datalist = $datawords['menu_name'] ;
      $datalist = html_entity_decode($datawords['name']) ;
      
          array_push($keywords, $datalist);
        } 
   
     echo json_encode($keywords);  
    } 
//************************************************************************************  

//*******************************************************************************
function pay_register() {
     
       //=================
       switch($datasend['main_lang']){

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

        } 
 //=====================
     $data['target_info']['menu_name'] = "оплата за регистрацию участника";
     $data['target_info']['price'] = 100;
     $data['text'] = " Подтвердить намерение оплатить участие и стать полноценным участником ";    // Подтвердить намерения оплатить участие.<br> Сума <b>".$data['target_info']['price']."</b> грн  
     $data['level_to'] = 0;
     $data['price'] = $data['target_info']['price'];
 // = = = == =             
           $this->load->view('user/orders/generate_pay_info', $data); 
            
      //   echo base_url().'shop/order_list/'.$order_id ;
      //    }
      //   }  
} 

//*******************************************************************************
   function paydone ($contents='') {
              $data['pages'] = $this->model_user->loadPages(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();   
              $rrrr = $this->session->userdata('gotouser_contents');
              if( !empty($rrrr)){
                  $data['page'] = $rrrr;
              }
               
              $data['template_top'] = 'infopage'; 
           $this->load->view('user/index', $data);   
        }

//*******************************************************************************
function confirm_go_to_pay_reg() {
    //echo $_SERVER['REMOTE_ADDR']."<br>";
/*    $ip_arr =array("37.57.178.246","178.255.176.82","93.188.39.123","109.86.137.253","127.0.0.1" );
    if(!in_array($_SERVER['REMOTE_ADDR'], $ip_arr)){
    echo "Данная функция находится на обслуживании"; 
    exit;
    } else {*/
    
/* 
ac_account_email:ac_sci_name:ac_amount:ac_currency:secret:ac_order_id
Delimeter is ":".
ac_sign will be SHA-256 hash of the string, that was generated above.
*/
$datasend = $_POST;
//print_r($datasend);
$user_info = $this->model_user->load_User_Anketa();  
$data['main_currency'] = $curr = $datasend['curr'];
$empty_some_anketas = 0;
        // echo "<pre>"; print_r($user_info); exit();  
        foreach($user_info as $a_it=>$a_val){
            // echo "<br>".$a_it." | ".$a_val;
            if(trim($a_val)=='') {$empty_some_anketas++;}
        }
        if($empty_some_anketas > 0) {
            echo "Вы не можете перейти к оплате, пока не заполните все поля анкеты."; exit;
        }
 $curr = strtoupper($curr);
 if($curr=="UAH") { $ac_form_currency = "UAH"; $amount = "100.00"; }
 if($curr=="USD") { $ac_form_currency = "USD"; $amount = "5.00"; }
$order_id = $this->model_user->create_order_pay_reg($curr);   
//$data['order'] = $this->model_user->load_Order_for_Pay($order_id);  
//$amount = "3.00";         
         
$time = time(); 
$to_hash_uah  = $this->config->config['advcash']['ac_form_email']; //"alafadobro@gmail.com";
$to_hash_uah .= ":".$this->config->config['advcash']['ac_form'];
$to_hash_uah .= ":".$amount;
$to_hash_uah .= ":".$ac_form_currency;
$to_hash_uah .= ":".$this->config->config['advcash']['ac_form_secret'];
$to_hash_uah .= ":".$order_id;

$ac_sign_uah = hash('sha256', $to_hash_uah);
    $form =  
    '<br><form method="post" action="https://wallet.advcash.com/sci/">
         <input type="hidden" name="ac_account_email" value="'.$this->config->config['advcash']['ac_form_email'].'" />
         <input type="hidden" name="ac_sci_name" value="'.$this->config->config['advcash']['ac_form'].'" />
         <input type="hidden" name="ac_amount" value="'.$amount.'" />
         <input type="hidden" name="ac_currency" value="'.$ac_form_currency.'" />
         <input type="hidden" name="ac_order_id" value="'.$order_id.'" />
         <input type="hidden" name="ac_sign" value="'.$ac_sign_uah.'" />
         <!-- Optional Fields -->
         <input type="hidden" name="ac_success_url" value="http://alafa.com.ua/'.lang("main_lang").'/payment/ac_u_answer/success" />
         <input type="hidden" name="ac_success_url_method" value="POST" />
         <input type="hidden" name="ac_fail_url" value="http://alafa.com.ua/'.lang("main_lang").'/payment/ac_u_answer/failure" />
         <input type="hidden" name="ac_fail_url_method" value="POST" />
         <input type="hidden" name="ac_status_url" value="http://alafa.com.ua/'.lang("main_lang").'/payment/ac_u_answer/status" />
         <input type="hidden" name="ac_status_url_method" value="POST" />
         <input type="hidden" name="ac_comments" value="Оплата регистрации | '.$amount.' '.$ac_form_currency.' " />
         <input type="submit" class="gopaybtn" value="Перейти к оплате регистрации | '.$amount.' '.$ac_form_currency.' " />
</form>';   

 
    $data['form'] = $form;  
    $data['order_id'] = 1;    
    $data['text'] = "Для прехода на страницу оплаты регистрации нажмите кнопку перехода. "; 
    $this->load->view('user/orders/reg_orders_user_confirm_pay', $data);
   // }    
    
     // = = = == =             
    // $this->load->view('user/orders/reg_orders_user_confirm_pay', $data); 
}
//*******************************************************************************
function zzz_confirm_go_to_pay_reg_old_perfect() {
     
    /*

This is a sample script, that demonstrates sending 
PerfectMoney e-Voucher purchase request and parsing 
output data to array.

*/

// trying to open URL to process PerfectMoney e-Voucher creation
$f=fopen('https://perfectmoney.is/acct/ev_create.asp?AccountID=myaccount&PassPhrase=mypassword&Payer_Account=U12563633&Amount=0.01', 'rb');

if($f===false){
   echo 'error openning url';
}

// getting data
$out=array(); $out="";
while(!feof($f)) $out.=fgets($f);

fclose($f);

// searching for hidden fields
if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
   echo 'Ivalid output';
   exit;
}

$ar="";
foreach($result as $item){
   $key=$item[1];
   $ar[$key]=$item[2];
}

echo '<pre>';
print_r($ar);
echo '</pre>';
//echo "Данная функция находится на обслуживании"; 
 exit;
    
       $datasend = $_POST;
       
       //=================
       switch($datasend['main_lang']){

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

        } 
        //=====================
        //$user_id = $this->session->userdata('user_id'); 
        $user_info = $this->model_user->load_User_Anketa();  
        $empty_some_anketas = 0;
        // echo "<pre>"; print_r($user_info); exit();  
        foreach($user_info as $a_it=>$a_val){
            // echo "<br>".$a_it." | ".$a_val;
            if(trim($a_val)=='') {$empty_some_anketas++;}
        }
        if($empty_some_anketas > 0) {
            echo "Вы не можете перейти к оплате, пока не заполните все поля анкеты."; exit;
        }
           //  echo "<pre>"; print_r($datasend); exit();  
           $order_id = $this->model_user->create_order_pay_reg($datasend, 1);      
           // echo "<pre>"; print_r($datasend); exit;                             
           $data['order'] = $this->model_user->load_Order_for_Pay($order_id);
           $user_id = $data['order']['user_id']; 
          
          /*  ---- generate form ----  */ 
    $order = $data['order'];
           
    $merchant_id='i8702676398';
    $signature="hGMvqd6aks0BEhcbsgIXbRBef0OzyEGBVQmjs2kx";  // code of merchant    
    $url="https://liqpay.com/?do=clickNbuy";
    // https://liqpay.com/?do=clickNbuy
    // $url="https://www.liqpay.com/?do=clickNbuy"; 
     
    $method='card';
    //$phone='+20123145121';
    $phone = $order['user_info']['phone'];
    $phone = str_replace(array('_', '-', '—','(',')', ' '), '', trim($phone));
    $amount = $order['target_name']['price'];
    $order_id = "ORDER_".$order['id'];
    
    $site_url =  'http://alafa.com.ua/'; //base_url();
    $server_url = $site_url.'payment/answer';
    $server_url_privat24 = $site_url.'payment/answer_privat24';
    $result_url = $site_url.lang('main_lang').'/payment_done';
    
    $server_url_privat24 = $site_url.'payment/answer_privat24';
    
    $description = "Oplata registracii uchastnika"; // lang('main_payment_oplata_zakaza_v_magazine');
   // $description = mb_convert_encoding($description, "windows-1251", "UTF-8"); 
    
    $xml="<request>      
        <version>3</version>
        <result_url>$result_url</result_url>
        <server_url>$server_url</server_url>
        <merchant_id>$merchant_id</merchant_id>
        <order_id>$order_id</order_id>
        <amount>$amount</amount>
        <currency>UAH</currency>
        <type>donate</type>
        <description>$description $order_id</description>
        <default_phone>$phone</default_phone>
        <pay_way>$method</pay_way> 
        </request>
        ";              
    // $sign=base64_encode(sha1($merc_sign.$xml.$merc_sign,1));   
    //echo "<pre>".$xml."</pre>"; 
   
  // print_r( $string);
  //  exit(); 
   // ---------------------------------------------------     
    $button_value = lang('main_user_go_pay_to_liqpay'); // lang('main_user_order_i_confirm');
    
    $xml_encoded = base64_encode($xml); 
    $lqsignature = base64_encode(sha1($signature.$xml.$signature,1)); //поле signature, данная подпись имеет вид: подпись(пароль) мерчанта + неупакованный XML - операции + подпись(пароль) мерчанта     
    //$print_link = "/".lang('main_go_to_print_page')."/order_print/".$order_id; 
    $adgh= "<a class='like_button' target='_blank' href='/".lang('main_lang')."/order_print/".$order['id']."'>".lang('main_go_to_print_page')."</a> "; 
    //$link_code = "window.location('$print_link')";
    $form =  
    "<form action='$url' method='POST'>
      <input type='hidden' name='operation_xml' value='$xml_encoded' />
      <input type='hidden' name='signature' value='$lqsignature' />
    <input type='submit'  class='styled_button_red' value='$button_value' />
    <div>$adgh</div>
    </form>"
     ;
     
     $privat24_merchant_id='105390';
     $privat24_signature="9s2Exf9mt0Inke9W6aHfaI100tPwYSI3";
 
   
     //-----------------------------------------  
    // $payment = "amt=".$amount."&ccy=UAH&details=".$description."&ext_details=".$order_id."&pay_way=privat24&order=".$order_id."&merchant=".$privat24_merchant_id."";
    
    //$description_mb = mb_convert_encoding ( $description, "windows-1251", "UTF-8"  );
    //echo "<br>description = ".$description;
     $description_mb = iconv ("UTF-8", "windows-1251", $description);
    //echo "<br>description_mb = ".$description_mb;
     $payment = "amt=".$amount.".00&ccy=UAH&details=".$description."&ext_details=".$order_id."&pay_way=privat24&order=".$order_id."&merchant=".$privat24_merchant_id;
    //echo "<br>=========payment = ".$payment; 
     //$payment_mb_str =  mb_convert_encoding ( $payment, "windows-1251", "UTF-8"  );
     //$payment_mb_str =  iconv ("UTF-8", "windows-1251", $payment);
     
     //$privat24_signature_form_done_mb_str = sha1(md5($payment_mb_str.$privat24_signature));
     $privat24_signature_form_done = sha1(md5($payment.$privat24_signature));
    
    // echo "<br>payment =========== ".$payment;
    // echo "<br>payment_mb_str ==== ".$payment_mb_str;
   //  echo "<br>privat24_signature_form_done =========== ".$privat24_signature_form_done;
     //echo "<br>privat24_signature_form_done_mb_str ==== ".$privat24_signature_form_done_mb_str;
   /*  */
     
     
    // $url_privat24_api = 'http://2shans/payment/likep24_ishop/';
      $url_privat24_api = 'https://api.privatbank.ua/p24api/ishop';
     
     $form_privat24 = '
     <form action="'.$url_privat24_api.'" method="POST" accept-charset="UTF-8">
      <input type="hidden" name="amt" value="'.$amount.'.00"/>
      <input type="hidden" name="ccy" value="UAH" />
      <input type="hidden" name="merchant" value="'.$privat24_merchant_id.'" />
      <input type="hidden" name="order" value="'.$order_id.'" />
      <input type="hidden" name="details" value="'.$description.'" />
      <input type="hidden" name="ext_details" value="'.$order_id.'" />
      <input type="hidden" name="pay_way" value="privat24" />
      <input type="hidden" name="return_url" value="'.$result_url.'" />
      <input type="hidden" name="server_url" value="'.$server_url_privat24.'" />
      <input type="hidden" name="signature" value="'.$privat24_signature_form_done.'" />
      <input type="submit" class="styled_button_red" value="Оплатить через Приват24" />
    </form>
     ';
    //----------------------------------------- 
 //  echo $form_privat24;  
   //  $form_privat24_html = html_entity_decode($form_privat24);
   //  echo "<div align='left'><xmp>".$form_privat24_html."</xmp></div>";  // exit();
    
     $data['form'] = $form;  
     $data['form_privat24'] = $form_privat24;   
     $data['order_id'] = $order_id;     
     
     $data['text'] = "Перейти к оплате. <br> Сума ".$amount." грн  ";;     
     // = = = == =             
     $this->load->view('user/orders/reg_orders_user_confirm_pay', $data); 
           
           
      //   echo base_url().'shop/order_list/'.$order_id ;
      //    }
       //   }  
} 
//************************************************************************************  
  
//************************************************************************************         
 function error_404() { 
 
    set_status_header(404);
    //$this->output->set_status_header('404');
    $data=array();
              $data['pages'] = $this->model_user->loadPages();  
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['page'] = $this->model_user->loadErrorPage();  
              $data['template'] = 'page';  
    $this->load->view('user/index', $data); 
   
}     
 //************************************************************************************
//************************************************************************************  
//************************************************************************************  
//************************************************************************************  


}
?>