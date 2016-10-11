<?php
/**
 * Controller Admin
 */
class admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
       
       if($this->session->userdata('user_id') =='') { 
        header('Location: '.base_url().'managment'); 
        } 
 }
//************************************************************************************
	function index() {
    
		header('Location: '.base_url().'managment/loginForm/');
	}
 //************************************************************************************               
    function main() {
         $data['template'] = 'welcome'; 
       $this->load->view('admin/main', $data);  
    }    
//************************************************************************************
}//class Front
?>
