<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_letter_templ extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
     $this->load->model('admin/model_pages','model_pages'); 
     
      $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
     if (!isset($user['user_id']) || empty($user['user_id'])) {
         header('Location: '.base_url().'admin'); 
    }
    $this->session->set_userdata('open_menu','blocks');             
    }
  //************************************************************************************
    function show_letter_templ () {
           // echo "11111";  exit();
             $data=array();
             $data['blocks'] = $this->model_pages->loadletter_templs(); 
 
             $data['template'] = 'letters_templ/show_letter_templs'; 
            $this->load->view('admin/main', $data);         
    }    
     
   //************************************************************************************
        function edit_letter_templ($id) 
    {
        $data=array();
             $data['block'] = $this->model_pages->loadletter_templforedit($id);
             $data['template'] = 'letters_templ/edit_letter_templ'; 
          $this->load->view('admin/main', $data);
    }
  //************************************************************************************
    function edit_letter_templ_done() 
    {
        $data = $_POST;
     
        $data = $this->model_pages->edit_letter_templ($data);
        
          header('Location: '.base_url().'manage_letter_templ/show_letter_templ');   
           
    }
  //************************************************************************************        
  //*******************************************************************************    
  
}
?>