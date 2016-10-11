<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Controller class
 * @author Ageev Alexey
 */

class page extends CI_Controller {

    function __construct()
    {
        parent::__construct();
      
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
        $this->load->model('admin/model_bills','model_bills');
        $this->load->model('admin/model_routing', 'model_routing');
        
        $this->load->model('user/model_user', 'model_user');
  
        $this->session->set_userdata('its_user_page','off');

      }
//************************************************************************************

//************************************************************************************
          function index () {
   // echo "только для администратора";   exit();
              $data=array();
              
              $data['pages'] = $this->model_user->loadPages();   
              $data['blocks'] = $this->model_user->loadBlocksIndex(); 
                
              $data['page'] = $this->model_user->loadIndexPage();
              $data['index'] = 1;
              $data['template_top'] = 'page'; 
          $this->load->view('user/index', $data);
        }
//************************************************************************************

//************************************************************************************
          function rl ($id_referal) {
           // echo "только для администратора";   exit();
              $data=array();
              
              
              $cookie2 = array(
                           'name'   => 'referal_id',
                           'value'  => $id_referal,
                           'expire' => '2592000',
                           'domain' => $_SERVER['HTTP_HOST'],
                           'path'   => '/',
                           'prefix' => '2shans_',
              ); 
              set_cookie($cookie2); // get_cookie('referal_id');
              
              $data['pages'] = $this->model_user->loadPages();   
              $data['blocks'] = $this->model_user->loadBlocksIndex(); 
              $data['referal_registration'] = 1;  
              $data['referal_code'] = $id_referal; 
              $data['page'] = $this->model_user->loadIndexPage();
              $data['index'] = 1;
              $data['template_top'] = 'page'; 
          $this->load->view('user/index', $data);
        }
//************************************************************************************
             
//***********************************************************************************
function captha_img($fiction_param) {
    $this->load->library('alcaptcha');
        echo $this->alcaptcha->image();
    }
//***********************************************************************************                                                    
//***********************************************************************************
 function news ($start_limit = 0) {

        $data=array();
        $start_limit = intval($start_limit);               
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
                     
           if($start_limit==0) {                                 
             $data['page'] = $this->model_user->loadPage_by_module('news');
             $data['template_top'] = 'page';
             }
          // $data['page'] = $this->model_user->loadPage_by_module('blog');
        
        $data['news'] = $this->model_user->loadNews($start_limit);     
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().lang('main_lang').'/news';
            if(!isset($data['news']['total'])){$data['news']['total'] = 0;}
        $data['pagination_config']['total_rows'] = $data['news']['total'];
        
        $data['pagination_config']['uri_segment'] = 3;
        $data['pagination_config']['num_links'] = 4; 
        $data['pagination_config']['per_page'] = 10;
        $data['pagination_config']['cur_tag_open'] = '<span class="current_page">';
        $data['pagination_config']['cur_tag_close'] = '</span>';
        $data['pagination_config']['full_tag_open'] = '<div class="paginationstyle" align="center">';
        $data['pagination_config']['full_tag_close'] = '</div>';
        $data['pagination_config']['last_link'] = '>>';
        $data['pagination_config']['last_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['last_tag_close'] = '</span>';
        $data['pagination_config']['first_link'] = '<<';
        $data['pagination_config']['first_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['first_tag_close'] = '</span>';
        $data['pagination_config']['next_link'] = '  >  ';
        $data['pagination_config']['next_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['next_tag_close'] = '</span>';
        $data['pagination_config']['prev_link'] = '  <  ';
        $data['pagination_config']['prev_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['prev_tag_close'] = '</span>';
       
        // Инициализируем страницы
        $this->pagination->initialize($data['pagination_config']);
        $data['pages_code'] = $this->pagination->create_links();  
                                                                                
              $data['pages'] = $this->model_user->loadPages();  
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              
              $data['crumbs'] = '1';
              $data['page']['last_crumb'] = lang('main_news'); 
              
              $data['template'] = 'news/news'; 
              
          $this->load->view('user/index', $data);
        }   
//*********************************************************************************** 
                           
//***********************************************************************************
 function reviews ($start_limit = 0) {

        $data=array();
        $start_limit = intval($start_limit);               
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
                     
           if($start_limit==0) {                                 
             $data['page'] = $this->model_user->loadPage_by_module('reviews');
             $data['template_top'] = 'page';
             }
          // $data['page'] = $this->model_user->loadPage_by_module('blog');
        
        $data['news'] = $this->model_user->loadreviews($start_limit);     
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().lang('main_lang').'/news';
            if(!isset($data['news']['total'])){$data['news']['total'] = 0;}
        $data['pagination_config']['total_rows'] = $data['news']['total'];
        
        $data['pagination_config']['uri_segment'] = 3;
        $data['pagination_config']['num_links'] = 4; 
        $data['pagination_config']['per_page'] = 10;
        $data['pagination_config']['cur_tag_open'] = '<span class="current_page">';
        $data['pagination_config']['cur_tag_close'] = '</span>';
        $data['pagination_config']['full_tag_open'] = '<div class="paginationstyle" align="center">';
        $data['pagination_config']['full_tag_close'] = '</div>';
        $data['pagination_config']['last_link'] = '>>';
        $data['pagination_config']['last_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['last_tag_close'] = '</span>';
        $data['pagination_config']['first_link'] = '<<';
        $data['pagination_config']['first_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['first_tag_close'] = '</span>';
        $data['pagination_config']['next_link'] = '  >  ';
        $data['pagination_config']['next_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['next_tag_close'] = '</span>';
        $data['pagination_config']['prev_link'] = '  <  ';
        $data['pagination_config']['prev_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['prev_tag_close'] = '</span>';
       
        // Инициализируем страницы
        $this->pagination->initialize($data['pagination_config']);
        $data['pages_code'] = $this->pagination->create_links();  
                                                                                
              $data['pages'] = $this->model_user->loadPages();  
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              
              $data['crumbs'] = '1';
              $data['page']['last_crumb'] = lang('main_reviews'); 
              
              $data['template'] = 'news/reviews'; 
              
          $this->load->view('user/index', $data);
        }   
//*********************************************************************************** 
//*******************************************************************************     
function payment_done () {
       //echo "srgh";
       $user = $this->session->userdata;
 
     if (!isset($user['email']) || !isset($user['user_id'])) {
        // echo "w467w46y";
         header('Location: '.base_url().'login/session_missed'); 
      }
      else {
      //$this->session->set_userdata('enable_account_menu','on');  
      $data=array();
     
      $data['page']['title'] = 'Завершение оплаты';
      $data['page']['text'] = 'Была осуществлена оплата за переход на новый уровень. Вы можете видеть статус оплаты в личном кабинете. Спасибо, что Вы с нами! ';
      $data['page']['h1'] = 'Завершение оплаты';
     //$data['page']['last_crumb'] = 'Была осуществлена оплата'; 
  
            $data['pages'] = $this->model_user->loadPages();      
       
            $data['blocks'] = $this->model_user->loadBlocksIndex();   
     
            $data['template'] = 'page'; 
            $data['sidebar_left'] = 'user/account_menu';
            $this->load->view('user/index', $data); 
      }
     }  
//*******************************************************************************
//*********************************************************************************** 
//************************************************************************************
   
//***********************************************************************************
 function add_feed () {
     
     $data = $_POST;
     $lang =  $data['lang'];
     
     
    if ($this->alcaptcha->check($data['captchacode'])!==true) {
              //  $addreg = $this->model_user->adduser($data);      
              //  echo base_url().'wait_for_activation';
              // echo "Вы неправильно ввели символы с картинки";
               echo lang('main_enter_verification_code')."<br>";
            }else {
               $this->model_user->adduser($data);      
               
            } 
     
     
     if(trim($data['fio'])=='' && trim($data['email'])=='' && trim($data['text'])=='' ) {
        header('Location: '.base_url().''.$lang.'/page/contacts');
     }    
     $this->model_user->add_feed($data);
     header('Location: '.base_url().''.$lang.'/page/answer_cont/'); 
        }
//***********************************************************************************
 function feed () {
        
            $this->load->library('alcaptcha');
            $data = $_POST;
            $lang =  $data['lang'];    
          //  $lang =  $data['lang']; 
    $email = trim($data['email']);
    $name = trim($data['fio']);
    $text = trim($data['text']);
    //  $re_pword = trim($data['re_pword']);    
    
    if(empty($name)){
        //$status = "error";
        echo lang('main_enter_name')."<br>";
    }
    else if(empty($email)){
        //$status = "error";
        echo lang('main_feed_form_enter_email')."<br>";
    } 
    else if(empty($text)){
        //$status = "error";  main_feed_form_enter_email
        echo lang('main_feed_form_enter_send_message')."<br>";
    }
    else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)){ 
       //validate email address - check if is a valid email address
            //$status = "error";
           // echo "Неверно введен email<br>";
            echo lang('main_login_wrong_email')."<br>";  
    }
           else if ($this->alcaptcha->check($data['captchacode'])!==true) {
              //  $addreg = $this->model_user->adduser($data);      
              //  echo base_url().'wait_for_activation';
              // echo "Вы неправильно ввели символы с картинки";
                echo lang('main_enter_verification_code')."<br>";
            }else {
            
      $this->model_user->add_feed($data);
    //  header('Location: '.base_url().''.$lang.'/page/answer_cont/'); 
    //  echo base_url().$lang.'/page/answer_cont'; 
    echo 1; 
               //    echo "Вы неправильно ввели символы с картинки<br>"; 
            }
        }     
//************************************************************************************ 
//***********************************************************************************
 function partners_feed () {
        
            $this->load->library('alcaptcha');
            $data = $_POST;
            $lang =  $data['lang'];    
    $email = trim($data['email']);
    $name = trim($data['fio']);
    $text = trim($data['text']);    
    
    if(empty($name)){ 
        echo lang('main_enter_name')."<br>";
    }
    else if(empty($email)){ 
        echo lang('main_feed_form_enter_email')."<br>";
    } 
    else if(empty($text)){ 
        echo lang('main_feed_form_enter_send_message')."<br>";
    }
    else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)){ 
       
            echo lang('main_login_wrong_email')."<br>";  
    }
           else if ($this->alcaptcha->check($data['captchacode'])!==true) {
               
                echo lang('main_enter_verification_code')."<br>";
            }else {
            
      $this->model_user->add_partners_feed($data); 
    echo 1; 
               //    echo "Вы неправильно ввели символы с картинки<br>"; 
            }
        }     
//************************************************************************************ 
      function callback () {
        
        
    $data = $_POST;
    $lang =  $data['lang'];              
    $phone = trim($data['phone']);
    $name = trim($data['name']);                  
    
   /* if(empty($name)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_enter_name')."<br>"; 
            echo json_encode($data);              
    } */
      if(empty($phone)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_user_ukazhite_phone');  //"Введите номер телефона<br>"; 
            echo json_encode($data);   
    }
      else {
            
      $this->model_user->ask_callback($data);
      $data = array();
            $data['status'] = 1;
            $data['message'] = lang('main_user_ukazhite_phone');  //"Запрос звонка отправлен<br>";
            echo json_encode($data);                                           
            }
        }   
//***********************************************************************************
       function feed_fp () {
        
        
    $data = $_POST;
    $lang =  $data['lang'];    
          //  $lang =  $data['lang']; 
    $email = trim($data['email']);
    $name = trim($data['name']);
    $subject = trim($data['subject']);  
    $text = trim($data['text']);
    //  $re_pword = trim($data['re_pword']);    
    
    if(empty($name)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_enter_name')."<br>"; 
            echo json_encode($data);
        //echo lang('main_enter_name')."<br>";
    }
    else if(empty($subject)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_user_ukazhite_temu_voprosa'); // "Введите тему вопроса<br>"; 
            echo json_encode($data);
        //echo "Введите тему вопроса<br>";  
    }
    else if(empty($email)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_feed_form_enter_email')."<br>";
            echo json_encode($data);
        //echo lang('main_feed_form_enter_email')."<br>";
    } 
    else if(empty($text)){
        $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_feed_form_enter_send_message')."<br>";
            echo json_encode($data);
        //echo lang('main_feed_form_enter_send_message')."<br>";
    }
    else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)){ 
       $data = array();
            $data['status'] = 0;
            $data['message'] = lang('main_login_wrong_email')."<br>";
            echo json_encode($data);
           // echo lang('main_login_wrong_email')."<br>";  
    }
         /*  else if ($this->alcaptcha->check($data['captchacode'])!==true) {  
              // echo "Вы неправильно ввели символы с картинки";
                echo lang('main_enter_verification_code')."<br>";
            }  */
            else {
            
      $this->model_user->add_feed($data);
      $data = array();
            $data['status'] = 1;
            $data['message'] =  lang('main_user_soobshenie_otpravleno'); // "Сообщение отправлено<br>";
            echo json_encode($data); 
            }
        }     
//************************************************************************************    
//************************************************************************************         
 function error_404() {
    // echo "404";
   // echo "<br>REQUEST_URI = ".$_SERVER['REQUEST_URI']; 
   if(stripos($_SERVER['REQUEST_URI'], '?gclid=')!==false || stripos($_SERVER['REQUEST_URI'], 'utm_source=')!==false) {$this->index(); } else {
    // ?gclid=
    
    set_status_header(404);
    //$this->output->set_status_header('404');
    $data=array();
              $data['pages'] = $this->model_user->loadPages();  
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['page'] = $this->model_user->loadErrorPage();  
              $data['template'] = 'page';  
    $this->load->view('user/index', $data); 
   }
    //return "404 - not found";
}     
 //************************************************************************************
       function answer_cont () {
           
       $data=array();
            
            $data['pages'] = $this->model_user->loadPages();  
              $data['offers'] = $this->model_user_shop->load_Offers(); 
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['page'] = $this->model_user->loadErrorPage();  
              
          $data['template'] = 'thanks_contacts';
        $this->load->view('user/index', $data); 
    }     
//************************************************************************************ 
 
   function count_now_users () {
 
       $count_users = $this->model_user->count_now_users(); 
       $count_users = $count_users + 451 ; //+ 8
       echo numberFormat($count_users, 6) ;
        }
//*******************************************************************************
}
?>