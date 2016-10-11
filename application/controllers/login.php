<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * class_local Controller class
 * @author Ageev Alexey
 */

class login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
       //   $lang = $this->uri->segment(1);
            
      $langs=array('ru','en','ua');
 
        $lang = $this->uri->segment(1);
        //if(!in_array($lang, $langs)) {echo "неверный адрес"; exit();}
        
        switch($lang){

        case 'en':
        $this->lang->load('main', 'english'); 
        break;

        case 'ru':
        $this->lang->load('main', 'russian'); 
        break;
        
        case 'ua':
        $this->lang->load('main', 'ukrainian'); 
        break; 

        default:
        $this->lang->load('main', 'russian'); 
        
        break;

        } 
        $this->load->model('user/model_user', 'model_user'); 
        $this->load->model('admin/model_routing', 'model_routing');
        $this->load->model('user/auth/model_auth_user', 'model_auth'); 
 
  
     $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
   //  if (isset($user['email']) || isset($user['user_id'])) {
   //     header('Location: '.base_url().'user'); 
   //  }
  
      }
//************************************************************************************
       function index () {
                                         
         $this->load->view('user/auth/login');  
        }
//************************************************************************************
          function index_old () {
              $data=array();
              //$data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
              $data['pages'] = $this->model_user->loadPages();
              $data['template_top_l'] = 'blocks/block_top_left';
              $data['template_top_r'] = 'blocks/block_top_right';
             // $data['read_page'] = '1';   
              $data['product_page'] = 1;
              $data['template_top'] = 'auth/login';          
         //  $data['template'] = 'auth/login';
           
         //  $this->load->view('user/auth/index', $data); 
         $this->load->view('user/index', $data);  
        }
// *********************************************************************************************    
function loginSubmit() { 

    $enter =  $_POST;
    $login = trim($enter['username']);
    $pword = trim($enter['pword']);    
    if(empty($login)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_login_enter_email')."<br>"; 
            echo json_encode($data); 
      //  echo lang('main_login_enter_email')."<br>"; 
        //echo "Введите email";
    }
    else if(empty($pword)){
       // echo lang('main_enter_pass_title')."<br>"; 
       $data['status'] = 0;
            $data['message'] = lang('main_enter_pass_title')."<br>"; 
            echo json_encode($data); 
       // echo "Введите пароль";
    } 
   else if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i" , $login)){ 
           // echo lang('main_login_wrong_email')."<br>";  
           $data['status'] = 0;
            $data['message'] = lang('main_login_wrong_email')."<br>"; 
            echo json_encode($data); 
           // echo "Неверно введен email!";
    }

    else {
            $data['user_info'] = $this->model_auth->load_User_info($enter);
             if(!empty($data['user_info'])){ //если вставка прошла успешно
           //    echo  "Вы авторизированы!"; 
          
            $newdata = array(  
                   'email'               => $data['user_info']['email'],
                   'name'                => $data['user_info']['name'], 
                   'surname'             => $data['user_info']['surname'],   
                   'phone'               => $data['user_info']['phone'],   
                   'user_id'             => $data['user_info']['id'],
                   'urik_yn'             => $data['user_info']['urik_yn']     
                    ); 
                    // 'user_status_cdp_sum' => $data['user_info']['total_summa'],      //total sum 
            $sess =  $this->session->set_userdata($newdata);
            
            $update_user_active['ip'] = $_SERVER['REMOTE_ADDR'];
            $update_user_active['user_id'] = $data['user_info']['id'];
            // $update_user_active['ip'] = $_SERVER['REMOTE_ADDR'];
            
            $this->model_auth->update_User_activity_info($update_user_active);  
            
            
            $this->session->sess_write_user_id($data['user_info']['id'] ) ;
                 // echo $_SERVER['HTTP_REFERER'] ;    
                 // echo base_url().'user';
            $data['status'] = 1;
            $data['go_to'] = base_url().lang('main_lang').'/user';
            $data['message'] = lang('main_login_success')."<br>"; 
            echo json_encode($data); 
               //   }
            }
            else { //если вставка прошла неудачно
              //  echo lang('main_login_wrong_email_or_pass')."<br>";      
              $data['status'] = 0;
            $data['message'] = lang('main_login_wrong_email_or_pass')."<br>"; 
            echo json_encode($data); 
               // echo  "Неверные логин или пароль.";    
            }
        }
}

//************************************************************************************
     function DC_buy_product_back_to_cart ($items) {       // back_to_cart 
     
     foreach ($items as $product) {
 
      $product_id = $product['model_id'];
     // echo $product_id;
     ///////////////
     if($this->session->userdata('customer_cart')!= ''){
         $cart_array=array(); $cart_array = $this->session->userdata('customer_cart');
         foreach($cart_array as $key=>$value){
             if($value['model_id'] == $product_id) {
                 $in_cart = true;  
             }
         }
    }
    /////////////// 
    // - dobavlenie dannih v korzinu - nachalo  
  if (!isset($in_cart) ) {         
     $sp = $this->model_user_shop->Add_Product_Item_To_Cart($product_id);
     
     $this->model_user_shop->add_product_popularity($product_id); 
 
 if($this->session->userdata('customer_cart')!= ''){
    $cart_array = array();
    $cart_array = $this->session->userdata('customer_cart');
 }
 if($this->session->userdata('customer_cart')== ''){
    $cart_array = array();
 }
 
 if($sp['promotional']==''){$sp['promotional'] = 0 ; }  
       
      $model_add = array(
                   'model_id'        => $sp['model_id'],
                   'model_name'      => $sp['model_name'],
                   'model_url'       => $sp['model_url'],
                   'model_picture'   => $sp['model_picture']['thumb'],
                   'model_price'     => $sp['model_price'],    
                   'model_quantity'  => $sp['model_quantity'], 
                   'model_articul'   => $sp['model_articul'],
                   'model_promo'     => $sp['promotional'],
                   'model_promo_price'     => $sp['promotional_price']
                    );
         array_push($cart_array, $model_add);

           $this->session->set_userdata('customer_cart', '');
           $pamada['customer_cart'] = $cart_array;
           $this->session->set_userdata($pamada);
   // - dobavlenie dannih v korzinu - konets  
   }
       //echo "Добавлен товар!"; 
       $this->model_user_shop->update_cart_data();       
     //    $this->cart();                                             
        // header('Location: '.$_SERVER['HTTP_REFERER']);               
     }                                                                    
    }
 //***********************************************************************************
//************************************************************************************
  function register_ooooollldddd () {
         $data=array();
         $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
         $data['pages'] = $this->model_user->loadPages();
         $data['newsblock'] = $this->model_user->loadNewsForBlock(); 
         $data['blocks'] = $this->model_user->loadBlocksIndex();      
         $data['template'] = 'auth/registration';     
         $this->load->view('user/main_pages', $data);
    }
//***********************************************************************************
function captha_img($fiction_param) {
    $this->load->library('alcaptcha');
        echo $this->alcaptcha->image();
    }
//***********************************************************************************
function captha_img_reg($fiction_param) {
    $this->load->library('alcaptcha');
        echo $this->alcaptcha->image_reg();
    }    
//***********************************************************************************
function captha_img_remind_pass($fiction_param) {
    $this->load->library('alcaptcha');
        echo $this->alcaptcha->image_remind_pass();
    }    
//***********************************************************************************
 function addregister () {
         //  echo "регистрация";
        //    $this->load->library('alcaptcha');
    $data = $_POST;
    
    $mobil_operators = array(  "38039", "38050", "38063", "38066", "38067", "38068", "38091", "38091", "38092", "38093", "38094", "38095", "38096", "38097", "38098", "38099");     
   // $data['phone'] = ltrim("+", $data['phone']);    
    
    $login = trim($data['email']);
    
    $name = trim($data['name']);
   // $surname = trim($data['surname']);
    //$data['phone'] = ltrim("+", $data['phone']);
    
   // $data['phone'] = str_replace("+", "", $data['phone']);
   // $data['phone'] = str_replace("-", "", $data['phone']);
    
    $pword = trim($data['pword']);
    $re_pword = trim($data['re_pword']);
    
	$email_is = $this->model_auth->check_email($login);    
    if(empty($login)){ 
        $data = array();
            $data['status'] = 0;
            $data['message'] = " Введите Email<br>"; 
            echo json_encode($data); 
    }
    
 // policy
 else if(!isset($data['policy'])){
        //$status = "error";
        $data = array();
            $data['status'] = 0;
            $data['message'] =  "Подтвердите согласие с правилами проекта<br>"; 
            echo json_encode($data);
        //echo lang('main_enter_name')."<br>";  
        //echo "Введите Имя<br>";
    }   
     else if(empty($name) || $name == lang('main_enter_name')){
        //$status = "error";
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_enter_name')."<br>"; 
            echo json_encode($data);
        //echo lang('main_enter_name')."<br>";  
        //echo "Введите Имя<br>";
    }
    /* else if(empty($surname) || $surname == lang('main_enter_surname')){
        //$status = "error";
         $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_enter_surname')."<br>"; 
            echo json_encode($data);
       //  echo lang('main_enter_surname')."<br>"; 
        //echo "Введите фамилию<br>";
    }
	*/
	else if($email_is == '1'){
        //$status = "error";
        //echo "Данный адрес уже зарегистрирован<br>";
        $data = array();
            $data['status'] = 0;
            $data['message'] = "Данный Email уже зарегистрирован. <br>Если забыли пароль, то воспользуйтесь  напоминанием пароля'<br>"; 
            echo json_encode($data);
       // echo lang('main_regist_email_is_registered')."<br>";  
    }
	
    else if(empty($pword)){
        
        // echo "Введите пароль<br>";
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_enter_pass_title')."<br>"; 
            echo json_encode($data);
       // echo lang('main_enter_pass_title')."<br>"; 
    }
    else if(strlen($pword) < 6){
         
        //echo "Пароль должен быть не менее 6 символов<br>";
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_regist_pass_less_then')."<br>"; 
            echo json_encode($data);
       // echo lang('main_regist_pass_less_then')."<br>";    
    }
    else if(empty($re_pword)){
       
        //echo "Повторите пароль<br>";
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_enter_re_pass_title')."<br>"; 
            echo json_encode($data);
      //  echo lang('main_enter_re_pass_title')."<br>";
    }
    else if(  (!empty($pword) && !empty($re_pword)) && ($pword != $re_pword)){
      //   if($pword != $re_pword){} 
         
        //echo "Пароли не совпадают<br>";
          $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_regist_pass_ne_sovpali')."<br>"; 
            echo json_encode($data);
        //echo lang('main_regist_pass_ne_sovpali')."<br>";
    }
   // else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $login)){ 
   else if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i" , $login)){
      
            //echo "Неверно введен email<br>";
            $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_login_wrong_email')."<br>"; 
            echo json_encode($data);  
            //echo lang('main_login_wrong_email')."<br>";       
    }
    /*
    else if(trim($data['phone']) ==''){
          //  echo "Введите номер мобильного телефона";
            $data = array();
            $data['status'] = 0;
            $data['message'] = "Введите номер мобильного телефона";
            echo json_encode($data);  
        }
    else if (strlen($data['phone'])<10) {        
           // echo "неверный формат номера телефона"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "неверный формат номера телефона"; 
            echo json_encode($data);    
        }
        */
        
      /*  else if (  !in_array(substr($data['phone'], 0, 5), $mobil_operators)) {   
           // echo "неверный код оператора мобильной связи"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "неверный код оператора мобильной связи"; 
            echo json_encode($data);  
        } */
 
 
 
        else if ( $data['urik']==1 && trim($data['edrpou']) ==''){
           // echo "Укажите ОКПО организации"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "Укажите ОКПО организации "; 
            echo json_encode($data);    
        }
        else if ( $data['urik']==1 && trim($data['org_name']) ==''){
           // echo "неверный формат номера телефона"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "укажите название организации"; 
            echo json_encode($data);    
        }
        else if ( $data['urik']==1 && trim($data['ur_adres']) ==''){     
           // echo "неверный формат номера телефона"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "укажите юридический адрес организации"; 
            echo json_encode($data);    
        }
        else if ( $data['urik']==1 && trim($data['vid_sobs']) ==''){
           // echo "неверный формат номера телефона"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "укажите форму собственности организации"; 
            echo json_encode($data);    
        }
        else if ( $data['urik']==1 && trim($data['nalog_sys']) ==''){
           // echo "неверный формат номера телефона"; 
            $data = array();
            $data['status'] = 0;
            $data['message'] = "укажите систему налогооблажения организации"; 
            echo json_encode($data);    
        }
 
    else {
             $addz = $this->model_auth->adduser($data);  
              if(!isset($surname)) {$surname = '';} 
             $newdata = array(  
                   'email'               => $login,
                   'name'                => $name,
                   'surname'             => $surname,    
                   'user_status_discount'=> 0,      //discount
                   'user_status_cdp_sum' => 0,      //total sum 
                   'user_id'             => $addz
                    ); 
            $sess =  $this->session->set_userdata($newdata);
            
            $update_user_active['ip'] = $_SERVER['REMOTE_ADDR'];
            $update_user_active['user_id'] = $addz;  
            $this->model_auth->update_User_activity_info($update_user_active);  
           //=======================================================================  
            $data = array();
            $data['status'] = 1;
            $data['go_to'] = base_url().lang('main_lang').'/user';
            $data['message'] = ' <div align="left"> Регистрация прошла успешно. Идет переход в личный кабинет...    '; 
 /*  $data['message'] = '
   <div align="left">         
<b>Сообщаем: </b></br>
- регистрация прошла успешно; </br>
- письмо с введенными данными было отправлено Вам на указанный адрес электронной почты. </br></br>
<b>Спешим сказать Вам Спасибо за доверие, оказанное нам.</b> </br> 
 </div>           ';  */
            echo json_encode($data); 
            
           
         
          //$this->load->view('user/auth/wait_for_activation');
               //  echo "вы зарегистрированы<br>"; 
               //    echo "Вы неправильно ввели символы с картинки<br>"; 
            }
        }     
//************************************************************************************ 
        function login () {      
         $this->load->view('user/auth/login');  
        }
//************************************************************************************
function register_00000 () { 
 
            $data=array();
              $data['pages'] = $this->model_user->loadPages();      
              $data['shop_types'] = $this->model_user_shop->Load_Types_For_Index();
              $data['newsblock'] = $this->model_user->loadNewsForBlock_index(); 
              $data['hits_goods'] = $this->model_user_shop->load_Shop_Hits_Index(); //  $data['hits_goods_2'] =   
              $data['promo_goods'] = $this->model_user_shop->load_Shop_Promo_Index();
                   
              $data['new_goods'] = $this->model_user_shop->load_Shop_New_goods_Index();
             
              $data['brands'] = $this->model_user_shop->Load_Brands_For_Index();
             
              $data['blocks'] = $this->model_user->loadBlocksIndex();   
              $data['read_page'] = 1;                                 
              $data['columns'] = 2; 
              
              $data['most_viewed_goods'] = $this->model_user_shop->load_Shop_most_viewed_goods(); 
              $data['last_byed'] = $this->model_user_shop->load_Shop_Last_byed(); 
              $data['template_sidebar_left'] = 'blocks/sidebar_index_right';  
               
              $data['page']['title'] = 'Регистрация на сайте';
              $data['page']['text'] = '';
              $data['page']['h1'] = ''; 
              $data['product_page'] = 1;
              $data['template_top'] = 'auth/register_form';     
             // $data['template'] = 'auth/register_form';
          //      echo "<pre>";   print_r($data['shop_types']); exit();                      
          $this->load->view('user/index', $data);
}
 //************************************************************************************            
          function forgot_pass () {      
         $this->load->view('user/auth/forgot_pass');  
        }
 //************************************************************************************
        
// ********************************************************************************************* 
//***********************************************************************************
 function remind_password () {
         //  echo "напоминание пароля";
            $this->load->library('alcaptcha');
            $data = $_POST;
    $email = trim($data['email']);
      
    if(empty($email)){              
        $data = array();
            $data['status'] = 0;
            $data['message'] = " Введите Email<br>"; 
            echo json_encode($data);
    }
      
    else if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)){ 
            $data = array();
            $data['status'] = 0;
            $data['message'] = " Введен некорретный Email<br>"; 
            echo json_encode($data);
           // echo "Введен некорретный Email!<br>";
    }
   
            
   else {
             
              $data['user_info'] = $this->model_auth->load_User_remind_pass($email);
             if(!empty($data['user_info'])){
           //  echo "мыло есть такое".$data['user_info']['id'];    exit();
              $this->model_auth->remind_user_pass($data['user_info']['id']);
            // echo base_url().'login/wait_remind_pass'; 
            $data = array();
            $data['status'] = 1;
            $data['go_to'] = base_url().lang('main_lang');
            $data['message'] = "Вам отправлено письмо с новым паролем<br><br> Сейчас Вы будете перенаправлены на главную страницу сайта"; 
            echo json_encode($data); 
             }
             else{
               //  echo "Такого пользователя не существует";
               $data = array();
            $data['status'] = 0;
            $data['message'] = "Такого пользователя не существует<br>"; 
            echo json_encode($data);
             }
            
              //  echo base_url().'auth/wait_remind_pass';
               //    echo "Вы неправильно ввели символы с картинки<br>"; 
            }
        }     
//************************************************************************************ 
  
//************************************************************************************
       function activation ($data) {
           $act = explode("-uid-", $data);
           $user_id = db_quote($act[0]);
           $user_act_code = db_quote($act[1]); 

             $ans['answer'] = $this->model_auth->ActivateAccount($user_id, $user_act_code);
           $data=array(); 
                  $data['msg'] = "Your account is activated";
            // $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
             $data['pages'] = $this->model_user->loadPages();  
             $data['shop_brands'] = $this->model_user_shop->load_Brands_All_Index(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['pages'] = $this->model_user->loadPages();                
              $data['template_top_l'] = 'blocks/block_brands';
              
             $data['template'] = 'auth/activation';  
         $this->load->view('user/index', $data);
     }
  //************************************************************************************
         function change_pass ($data) {
           $act = explode("-code-", $data);
           $user = explode("-uid-", $act[0]);
           $user_id = db_quote($user[0]);
           //$user_id = db_quote($act[0]);   
           $user_remind_code = db_quote($act[1]); 

             $ans['answer'] = $this->model_auth->change_pass($user_id, $user_remind_code);
             $data=array(); 
            // $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
             $data['msg'] = " Вы успешно активировали свой аккаунт";
             $data['pages'] = $this->model_user->loadPages(); 
             
             $data['template_top_l'] = 'blocks/block_top_left';
              $data['template_top_r'] = 'blocks/block_top_right';
               
             $data['template'] = 'auth/activation';   // main_pages
        // $this->load->view('user/auth/index', $data);
         $this->load->view('user/main_pages', $data); 
     }
 // *********************************************************************************************    
 
//************************************************************************************
     
//************************************************************************************
  function wait_for_activation () {

              $data=array();
              $data['pages'] = $this->model_user->loadPages();
              
              $data['template_top_l'] = 'blocks/block_top_left';
              $data['template_top_r'] = 'blocks/block_top_right';
              $data['read_page'] = '1'; 
              
              $data['template'] = 'auth/wait_for_activation'; 
          $this->load->view('user/main_pages', $data);
        }    
//************************************************************************************
  function wait_remind_pass () {

              $data=array();                                             
             // $data['pages'] = $this->model_user->loadPages();
             // $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
             // $data['newsblock'] = $this->model_user->loadNewsForBlock(); 
             // $data['blocks'] = $this->model_user->loadBlocksIndex(); 
             // $data['template_top_l'] = 'blocks/block_top_left';
             // $data['template_top_r'] = 'blocks/block_top_right';
            //  $data['read_page'] = '1'; 
            
            //  $data['template'] = 'auth/wait_remind_pass'; 
        //  $this->load->view('user/auth/wait_remind_pass', $data);
        }  
//************************************************************************************
  function session_missed () {
                                                                           
              $data=array();
              $data['pages'] = $this->model_user->loadPages();      
              
              $data['blocks'] = $this->model_user->loadBlocksIndex(); 
             // $data['page'] = $this->model_user->loadIndexPage(); 
              
              $data['page']['last_crumb'] = "Ваша сессия завершена"; 
              $data['page']['title'] = "Сессия завершена";    
              $data['template'] = 'auth/session_missed'; 
          $this->load->view('user/index', $data);
        }                      
//************************************************************************************
    /**
     * Destroy session
     */
    function logout() {
     
       // $this->model_user->UnsetPower();
        $data = array(
                   'username'  => '',
                   'user_id'   => ''
                    ); 
      //  $this->session->set_userdata($data);
      $this->session->sess_destroy();
        header('Location: '.base_url());
      //  header('Location: '.$_SERVER['HTTP_REFERER']);    
    }
//*********************************************************************************
 function login_page () {   
            
              $data=array();
               
              $data['pages'] = $this->model_user->loadPages();  // loadPages_full_tree  
              //$data['shop_types'] = $this->model_user_shop->Load_Types_For_Index();
              
              $data['brands'] = $this->model_user_shop->Load_Brands_For_Index(); 
              $data['shop_types'] = $this->model_user_shop->Load_Types_For_Index();      
              
              $data['newsblock'] = $this->model_user->loadNewsForBlock_index(); 
              $data['hits_goods'] = $this->model_user_shop->load_Shop_Hits_Index(); //  $data['hits_goods_2'] =   
              $data['promo_goods'] = $this->model_user_shop->load_Shop_Promo_Index();
              $data['new_goods'] = $this->model_user_shop->load_Shop_New_goods_Index();
             
              $data['blocks'] = $this->model_user->loadBlocksIndex();   
              
              $data['columns'] = 2; 
            
            //  echo "<pre>"; print_r($data['page']);exit();
                
               $data['crumbs'] = '1';
               $data['page']['title'] = 'Вход и регистрация';
               $data['page']['h1'] = 'Вход и регистрация'; 
               $data['page']['last_crumb'] = 'Вход и регистрация';
               $data['page']['text'] = '';
               
               $data['most_viewed_goods'] = $this->model_user_shop->load_Shop_most_viewed_goods(); 
               $data['last_byed'] = $this->model_user_shop->load_Shop_Last_byed(); 
               $data['template_sidebar_left'] = 'blocks/sidebar_index_right';
               $data['product_page'] = 1;
               $data['template_top'] = 'auth/login';                               
             //  $data['template'] = 'auth/login_for_all';
             //  $data['template_sidebar_left'] = 'blocks/sidebar_index_right';  
                
                
               $data['page_only'] = 1;
               
           //   $data['template_top'] = 'blocks/block_services';  
          $this->load->view('user/index', $data);
       
        }
//***********************************************************************************
//************************************************************************************
}
?>