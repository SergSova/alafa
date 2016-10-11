<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_blocks extends CI_Controller {
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
    $this->session->set_userdata('open_menu','pages');             
    }
  //************************************************************************************
    function show_blocks () {
           // echo "11111";  exit();
             $data=array();
             $data['blocks'] = $this->model_pages->loadBlocks(); 
 
             $data['template'] = 'blocks/show_blocks'; 
            $this->load->view('admin/main', $data);         
    }    
     
   //************************************************************************************
        function edit_block($id) 
    {
        $data=array();
             $data['block'] = $this->model_pages->loadBlockforedit($id);
             $data['template'] = 'blocks/edit_block'; 
          $this->load->view('admin/main', $data);
    }
  //************************************************************************************
    function edit_block_done() 
    {
        $data = $_POST;
     
        $data = $this->model_pages->edit_block($data);
        
          header('Location: '.base_url().'manage_blocks/show_blocks');   
           
    }
  //************************************************************************************ 
 //************************************************************************************
    function show_message_boxs () {
           // echo "11111";  exit();
             $data=array();
             $data['message_boxs'] = $this->model_pages->loadmessage_boxs(); 
 
             $data['template'] = 'blocks/show_message_boxs'; 
            $this->load->view('admin/main', $data);         
    }    
     
   //************************************************************************************
        function edit_message_box($id) 
    {
        $data=array();
             $data['message_box'] = $this->model_pages->loadmessage_boxforedit($id);
             $data['template'] = 'blocks/edit_message_box'; 
          $this->load->view('admin/main', $data);
    }
  //************************************************************************************
    function edit_message_box_done() 
    {
        $data = $_POST;
     
        $data = $this->model_pages->edit_message_box($data);
        
          header('Location: '.base_url().'manage_blocks/show_message_boxs');   
           
    }
  //************************************************************************************ 
    //************************************************************************************        
    //*********************************************************************************         
  //*******************************************************************************    
  
}
?>