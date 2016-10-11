<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * class_local Controller class
 * @author Ageev Alexey
 */

class auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
       //   $lang = $this->uri->segment(1);
 
$this->load->model('user/auth/model_auth_user_rus', 'model_auth');
$this->load->model('user/model_user_rus', 'model_user');
$this->load->model('user/model_user_shop', 'model_user_shop');

     $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
   //  if (isset($user['email']) || isset($user['user_id'])) {
   //     header('Location: '.base_url().'user'); 
   //  }
  
      }
//************************************************************************************

//************************************************************************************
          function index () {
              $data=array();
             // $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
              $data['pages'] = $this->model_user->loadPages();
              
           $data['template'] = 'auth/login';
           
         //  $this->load->view('user/auth/index', $data); 
         $this->load->view('user/main', $data);  
        }
// *********************************************************************************************    
function loginSubmit() { 

    $enter =  $_POST;
    $login = trim($enter['username']);
    $pword = trim($enter['pword']);    
    if(empty($login)){
        $status = "error";
        echo "Введите email";
    }
    else if(empty($pword)){
        $status = "error";
        echo "Введите пароль";
    }
   // else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $login)){ 
   else if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i" , $login)){
        // "/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i"
       //validate email address - check if is a valid email address
            $status = "error";
            echo "Неверно введен email!";
    }

    else {
            $data['user_info'] = $this->model_auth->load_User_info($enter);
             if(!empty($data['user_info'])){ //если вставка прошла успешно
           //    echo  "Вы авторизированы!";
           
          // $data['user_info']['status']['discount'] = '0';
          // $data['user_info']['status']['total_summa'] = '0';
          
         //  if($data['user_info']['status']['id'] == '1'){ 
               
         //  }
           
          if($data['user_info']['status']['id'] == '2'){
             //  $all_hisory_sum = $this->model_user_shop->Get_All_History_Sum($data['user_info']['id'] );
           //  $cdp_discont_percent = $this->model_user_shop->Get_CDP_Discont($price_notpromo_cdp);
         
       //   echo "CDP Data - "; print_r($datacdp); exit();  
       
       /*****
          // old discount
          // $datacdp = $this->model_user_shop->Get_All_History_Sum($data['user_info']['id'] );  
          $data['user_info']['status']['discount'] = $datacdp['cdp_percent'];
          $data['user_info']['status']['total_summa'] = $datacdp['total_summa']; 
       *****/    
          
          //  $cdp_discont = $this->model_auth->load_Cdp_Datas(); 
          //  echo "<pre>"; print_r($cdp_discont);
          //  exit();   
           }
           
           
            $newdata = array(  
                   'email'               => $data['user_info']['email'],
                   'name'                => $data['user_info']['name'],
                   'surname'             => $data['user_info']['surname'],  
                   'user_status_id'      => $data['user_info']['status'],
                   'user_status_discount'=> $data['user_info']['total_sum_discount'],      //discount
                   'user_status_cdp_sum' => $data['user_info']['total_sum_amount'],      //total sum 
                   'user_id'             => $data['user_info']['id']
                    ); 
                    
                    /*
                    'user_status_name'    => $data['user_info']['status']['name'], 
                    'user_status_id'      => $data['user_info']['status']['id'],   
                    'user_status_discount'=> $data['user_info']['status']['discount'],      //discount
                   'user_status_cdp_sum' => $data['user_info']['status']['total_summa'],      //total sum  
                    */
                  //  echo "<pre>"; print_r($newdata); exit();
                    
            $sess =  $this->session->set_userdata($newdata);
            
            $update_user_active['ip'] = $_SERVER['REMOTE_ADDR'];
           // $update_user_active['user_id'] = $data['user_info']['id'];
           // $update_user_active['ip'] = $_SERVER['REMOTE_ADDR'];
            
            $this->model_auth->update_User_activity_info($update_user_active);  
           /* 
            * 
            */
            
            $this->session->sess_write_user_id($data['user_info']['id'] ) ;
                //  echo  "Вы авторизированы!";  
                 // $this->session->set_userdata('lost_session_redirect', $SERVER['HTTP_REFERER']) ; 
              //  $redirect =  $this->session->set_userdata('lost_session_redirect') ;    
              //    if($redirect!=''){
             //    echo $redirect;
                // $this->session->set_userdata('lost_session_redirect', $SERVER['HTTP_REFERER']) ;
              //   $this->session->unset_userdata('lost_session_redirect');
               //   } else {
                  // echo base_url().'user'; 
                  echo base_url();
               //   }
            }
            else { //если вставка прошла неудачно
                $status = "error";
                echo  "Неверные логин или пароль.";    
            }
        }
}
//************************************************************************************
 
//***********************************************************************************
function captha_img($fiction_param) {
    $this->load->library('alcaptcha');
        echo $this->alcaptcha->image();
    }
//***********************************************************************************
       function addregister () {
         //  echo "регистрация";
            $this->load->library('alcaptcha');
            $data = $_POST;
    $login = trim($data['email']);
    $pword = trim($data['pword']);
    $re_pword = trim($data['re_pword']);
	$email_is = $this->model_auth->check_email($login);    
    if(empty($login)){
        $status = "error";
        echo "Введите email<br>";
    }
	
	else if($email_is == '1'){
        $status = "error";
        echo "Данный адрес уже зарегистрирован<br>";
    }
	
    else if(empty($pword)){
        $status = "error";
        echo "Введите пароль<br>";
    }
    else if(strlen($pword) < 6){
        $status = "error";
        echo "Пароль должен быть не менее 6 символов<br>";
    }
    else if(empty($re_pword)){
        $status = "error";
        echo "Повторите пароль<br>";
    }
    else if(  (!empty($pword) && !empty($re_pword)) && ($pword != $re_pword)){
      //   if($pword != $re_pword){} 
        $status = "error";
        echo "Пароли не совпадают<br>";
    }
   // else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $login)){ 
   else if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i" , $login)){
       //validate email address - check if is a valid email address
            $status = "error";
            echo "Неверно введен email<br>";
    }
          else if ($this->alcaptcha->check($data['captchacode'])!==true) {
              //  $addreg = $this->model_user->adduser($data);      
              //  echo base_url().'wait_for_activation';
               echo "Вы неправильно ввели символы с картинки";
            }
          else {
               $this->model_auth->adduser($data);      
                echo base_url().'auth/wait_for_activation';
               //    echo "Вы неправильно ввели символы с картинки<br>"; 
            }
        }     
//************************************************************************************ 
//************************************************************************************
          function forgot_pass () {
              $data=array();
              $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
              $data['pages'] = $this->model_user->loadPages();
              $data['newsblock'] = $this->model_user->loadNewsForBlock(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex(); 
           $data['template'] = 'auth/forgot_pass'; 
         //  $this->load->view('user/auth/index', $data); 
         $this->load->view('user/main', $data);  
        }
// ********************************************************************************************* 
//***********************************************************************************
 function remind_password () {
         //  echo "напоминание пароля";
            $this->load->library('alcaptcha');
            $data = $_POST;
    $email = trim($data['email']);
      
    if(empty($email)){
        $status = "error";
        echo "Введите email<br>";
    }
      
    else if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)){ 
            $status = "error";
            echo "Неверно введен email<br>";
    }
   else if ($this->alcaptcha->check($data['captchacode'])!==true) {
              //  $addreg = $this->model_user->adduser($data);      
              //  echo base_url().'wait_for_activation';
               echo "Вы неправильно ввели символы с картинки";
            }
            
   else {
             
              $data['user_info'] = $this->model_auth->load_User_remind_pass($email);
             if(!empty($data['user_info'])){
           //  echo "мыло есть такое".$data['user_info']['id'];    exit();
              $this->model_auth->remind_user_pass($data['user_info']['id']);
             echo base_url().'auth/wait_remind_pass';  
             }
             else{echo "Пользователя с этим адресом электронной почты не существует";}
            
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
                  $data['msg'] = " Вы успешно активировали свой аккаунт";
            // $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
             $data['pages'] = $this->model_user->loadPages();  
          //   $data['template'] = 'auth/activation';  
         //$this->load->view('user/main', $data);
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
             $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
             $data['msg'] = " Вы успешно активировали свой аккаунт";
             $data['pages'] = $this->model_user->loadPages();  
             $data['template'] = 'auth/activation';  
         $this->load->view('user/auth/index', $data);
     }
 // *********************************************************************************************    
 
//************************************************************************************
   function page ($id) {

              $data=array();
              //$data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
              $data['pages'] = $this->model_user->loadPages();   
              $data['page'] = $this->model_user->loadPage($id);
              $data['template'] = 'unreg/page'; 
          $this->load->view('user/unreg/main', $data);
        }     
//************************************************************************************
  function wait_for_activation () {

              $data=array();
              $data['pages'] = $this->model_user->loadPages();
              $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
              $data['newsblock'] = $this->model_user->loadNewsForBlock(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['template'] = 'auth/wait_for_activation'; 
          $this->load->view('user/main', $data);
        }    
//************************************************************************************
  function wait_remind_pass () {

              $data=array();                                             
              $data['pages'] = $this->model_user->loadPages();
              $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
              $data['newsblock'] = $this->model_user->loadNewsForBlock(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();      
              $data['template'] = 'auth/wait_remind_pass'; 
          $this->load->view('user/main', $data);
        }  
//************************************************************************************
  function session_missed () {

              $data=array();                                             
               $data['pages'] = $this->model_user->loadPages();
               $data['shop_categories'] = $this->model_user_shop->loadCategoriesIndex();
             $data['newsblock'] = $this->model_user->loadNewsForBlock(); 
             $data['blocks'] = $this->model_user->loadBlocksIndex();      
              $data['template'] = 'auth/session_missed'; 
          $this->load->view('user/main', $data);
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
    }
//*********************************************************************************
//************************************************************************************   
//***********************************************************************************
 function add_feed () {
            $data = $_POST;
     $lang =  $data['lang'];
     if(trim($data['fio'])=='' && trim($data['email'])=='' && trim($data['text'])=='' ) {
        header('Location: '.base_url().''.$lang.'/page/contacts');
     }    
     $this->model_user->add_feed($data);
     header('Location: '.base_url().''.$lang.'/page/answer_cont/'); 
        }
//************************************************************************************  
  function add_message () {
            $data = $_POST;
            $lang =  $data['lang'];
     if(trim($data['fio'])=='' && trim($data['polis-seria'])=='' && trim($data['strah_company'])==''  && trim($data['vashi-simptomy'])==''  && trim($data['birthday'])==''  && trim($data['polic-nomer'])==''  && trim($data['since_date'])=='' ) {
        header('Location: '.base_url().''.$lang.'/page/insured_event');
     }
      else{      
     $this->model_user->add_client($data);    
     header('Location: '.base_url().''.$lang.'/page/answer/'); 
      }
        }
//************************************************************************************         
        function answer () {
        $data=array();
        $data['blocks'] = $this->model_user->loadBlocksIndex();
        $data['template'] = 'thanks';
          $this->load->view('user/main', $data);      
    }       
 //************************************************************************************
       function answer_cont () {
        $data=array();
        $data['blocks'] = $this->model_user->loadBlocksIndex();
        $data['template'] = 'thanks_contacts';
          $this->load->view('user/main', $data);      
    }     
//************************************************************************************
}
?>