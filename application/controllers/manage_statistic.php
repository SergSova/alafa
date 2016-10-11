<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_statistic extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
     $this->load->model('admin/model_pages','model_pages');  // 
     $this->load->model('admin/model_statistic','model_statistic');  // model_statistic  
      $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
     if (!isset($user['user_id']) || empty($user['user_id'])) {
         header('Location: '.base_url().'admin'); 
    }
    $this->session->set_userdata('open_menu','stats');              
    }
  //************************************************************************************
   
    //************************************************************************************
      function index () {
            // echo "1111111111111"; exit();
             $data=array();
             $data['users'] = $this->model_statistic->load_Active_Users(); 
             
            // $data['emails'] = $this->model_pages->loadEmails();
           
            // echo "<pre>"; print_r($data); exit();
             $data['template'] = 'statistic/show_users_statistic'; 
             $this->load->view('admin/main', $data); 
     }
  
  //************************************************************************************
  //************************************************************************************
     
     //******************************************************************************* 
  
  function once ($sess_id) { 
             $data=array();
             $data['users_info'] = $this->model_statistic->load_Active_User_Cart($sess_id); 
             if (!empty($data['users_info'])){
                    $info = unserialize($data['users_info']['user_data']);
                     
                     if(isset($info['customer_cart']) && !empty($info['customer_cart']) ){
                        $data['customer_cart'] = $info['customer_cart']; 
                     //   print_r($data); exit(); 
                     }   
             }      
            //  echo "TEST 4 <br>";
           //  echo $sess_id;
           //  $data['pages'] = $this->model_pages->loadPages();
           //  $data['template'] = 'pages/show_pages'; 
              $this->load->view('admin/statistic/sess_cart_show', $data); 
     }
 //************************************************************************************
   function trafic_add ($data='') {
            // echo "1111111111111"; exit();
            // $data=array();
            if (!empty($data)) {
             $this->model_statistic->Trafic_Add($data); 
            }
            // $data['emails'] = $this->model_pages->loadEmails();
           
            // echo "<pre>"; print_r($data); exit();
             
     }
 //*******************************************************************************
      function trafic () {
            // echo "1111111111111"; exit();
             $data=array();
             $data['day_trafic'] = $this->model_statistic->load_Trafic_Day(); 
             
            // $data['emails'] = $this->model_pages->loadEmails();
           
            // echo "<pre>"; print_r($data); exit();
             $data['template'] = 'statistic/show_trafic'; 
             $this->load->view('admin/main', $data); 
     } 
 //************************************************************************************ 
 function trafic_filter () {
   
        if(  isset($_POST['date_input1']) || isset($_POST['date_input2']) ){
        $data = $_POST;  
      //  print_r($data); exit();    
       
      
        if(  trim($data['date_input1'])!='' || trim($data['date_input2'])!=''  )
         {
           $data['day_trafic'] = $this->model_statistic->getFilteredTrafic($data);
     
           $data['template'] = 'statistic/show_trafic';
           $this->load->view('admin/main', $data);     
         }
          } 
      else
         {
  
          header('Location: '.base_url().'manage_statistic/trafic');
         }  
     }       
 //************************************************************************************        
  
 //************************************************************************************
    
 //********************************************************************** 
 
 //************************************************************************************      
 //************************************************************************************      
 //************************************************************************************           
           
 //*******************************************************************************    
  
}
?>