<?php
/**
 * Authorization Subsystem controller
 *   
 */

/**
 * Controller Authorization
 */
class managment extends CI_Controller {
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
// *********************************************************************************************    
//************************************************************************************
    /**
     * Display Authorization Form
     */
    function index() {        
     
          $this->load->view('admin/login'); 
    
    }
// *********************************************************************************************    
function loginSubmit() { 

    $enter =  $_POST;
    $login = trim($enter['username']);    
    if(empty($login)){
        $status = "error";
        echo 'Where is login?!
       <a href="'.base_url().'managment/loginForm">Back to authorization</a>  
        ';
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
              header('Location: '.base_url().'admin/main'); 
               //   echo base_url().'karpaty/main'; 
            }
            else { //если вставка прошла неудачно
                $status = "error";
                echo  'ERROR of Authorization!
                <a href="'.base_url().'managment/loginForm">Back to authorization</a>  
                ';    
            }
        }
}
 //************************************************************************************               
    function main() {
         $data['template'] = 'welcome'; 
       $this->load->view('admin/main', $data);  
    }    
//************************************************************************************
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
        header('Location: '.base_url().'managment');
	}
//************************************************************************************
}
?>
