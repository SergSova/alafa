<?php
/**
 * Authorization Subsystem controller
 *   
 */

/**
 * Controller Authorization
 */
class authorization extends CI_Controller {
	/**
	 * Authorization Constructor
	 */
   function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Model_auth', 'auth');
        
    $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
     if (isset($user['user_id']) && $user['user_id']!='') {
         header('Location: '.base_url().'admin/main'); 
    }    
        
 }
//************************************************************************************
	/**
	 * Display Authorization Form
	 */
	function loginForm() {        
     
          $this->load->view('admin/login'); 
    
    }
 //***********************************************************************************
function captha_img($fiction_param) {
    $this->load->library('alcaptcha');
        echo $this->alcaptcha->image();
    }
//***********************************************************************************   
// *********************************************************************************************    
function loginSubmit() { 
    $this->load->library('alcaptcha');   
    $enter =  $_POST;
    $login = trim($enter['username']);
    $pass = trim($enter['pword']);
        
    if(empty($login)){         
        echo "А где логин?!";
    }
        
    else if(empty($pass)){    
        echo "А где пароль?!";
    }
        else if ($this->alcaptcha->check($enter['captchacode'])!==true) { 
                                                                           
            echo "Введите символы с картинки ПРАВИЛЬНО!";  
               // echo lang('main_regist_wrong_captcha')."<br>";
            }

    else {
            $data['user_info'] = $this->auth->load_User_info($enter);
             if(!empty($data['user_info'])){ //если вставка прошла успешно
             //  echo  "Вы авторизированы!";
              $newdata = array(
                   'username'    => $data['user_info']['fio'],
                   'status'      => $data['user_info']['status'],
                   'power'       => $data['user_info']['power'],
                   'user_id'     => $data['user_info']['id']
                    ); 
                $sess =  $this->session->set_userdata($newdata);
                // echo  "Вы авторизированы!";   

                  echo base_url().'admin/main'; 
            }
            else { //если вставка прошла неудачно
                $status = "error";
                echo  "Неверные данные!";    
            }
        }
}

//************************************************************************************
	/**
	 * Destroy session
	 */
	function logout() {
	 
		$this->auth->UnsetPower();
        $data = array(
                   'username'  => '',
                   'user_id'   => ''
                    ); 
        $this->session->set_userdata($data);
        $this->session->sess_destroy();
        header('Location: '.base_url().'managment/loginForm');
	}
//************************************************************************************
}
?>
