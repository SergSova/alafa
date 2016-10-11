<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_pages extends CI_Controller {
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
   
    //************************************************************************************
 
  //************************************************************************************
  //************************************************************************************
          
     //******************************************************************************* 
  
  function show_pages () { 
             $data=array();
             $data['pages'] = $this->model_pages->loadPages();
             $data['template'] = 'pages/show_pages'; 
             $this->load->view('admin/main', $data); 
     }
  //************************************************************************************
           function add_page () {
             $data['template'] = 'pages/add_page';  
            // $data['styles'] = $this->model_pages->load_dog_styles();            
        $this->load->view('admin/main', $data); 
     }
  //************************************************************************************
       function add_page_done() {
           $data = $_POST;
           $this->model_pages->add_page($data);
        header('Location: '.base_url().'manage_pages/show_pages');             
        }
  //************************************************************************************
    function update_page_number() 
    {
         $arr_img =   $_POST; 
          $data = $_POST;
        echo "Порядок страниц сохранён!";
      $data = $this->model_pages->update_page_number($arr_img);
    }
     //************************************************************************************  
    function edit_page($id) 
    {
        $data=array();
             $data['page'] = $this->model_pages->loadpageforedit($id);
            // $data['offers'] = $this->model_pages->load_tours_for_ids(); 
            // $data['styles'] = $this->model_pages->load_dog_styles();   
             $data['template'] = 'pages/edit_page'; 
          $this->load->view('admin/main', $data);
    }
//********************************************************************************
        function edit_page_done() 
    {
          $data = $_POST;
          $data = $this->model_pages->edit_page($data);
       header('Location: '.base_url().'manage_pages/show_pages');    
    }
  //************************************************************************************
    function delete_page($id) {
        $this->model_pages->delete_page($id) ;
     header('Location: '.base_url().'manage_pages/show_pages');
    }
 //************************************************************************************
  //*******************************************************************************
 function edit_page_visible($id, $vis) 
    {
        $data=array();
             $data = $this->model_pages->edit_page_visible($id, $vis); 
        header('Location: '.base_url().'manage_pages/show_pages'); 
    }
   //*******************************************************************************
  function edit_page_show_top($id, $vis) 
    {
        $data=array();
             $data = $this->model_pages->edit_page_show_top($id, $vis); 
        header('Location: '.base_url().'manage_pages/show_pages'); 
    }  
//*******************************************************************************  
function show_docs () { 
        
       $data['docs'] = $this->model_pages->loaddocs();
                                                                               
             $data['template'] = 'shop/docs_show'; 
             $this->load->view('admin/main', $data); 
     } 
//*******************************************************************************  
function add_doc () {    // $id_brand=''
                       
         $data['template'] = 'shop/doc_add';   
         $this->load->view('admin/main', $data); 
     }                                                                                
 //************************************************************************************
       function add_doc_tolist() {
           $dataadd = $_POST;                                     
               $dataadd["filedoc"] = $_FILES["doc"];      
               $this->model_pages->add_doc($dataadd);  
              header('Location: '.base_url().'manage_pages/show_docs/');           
                 
        }  
 //************************************************************************************   
 function delete_doc($id) {            
       $this->model_pages->delete_doc($id) ;             
      echo $_SERVER['HTTP_REFERER'];               
    }
//******************************************************************************* 
function edit_doc($id) 
    {
        $data=array();                                                      
        $data['doc'] = $this->model_pages->loaddoc_foredit($id);  
        $data['template'] = 'shop/doc_edit'; 
        $this->load->view('admin/main', $data);
    }
//************************************************************************************
        function edit_doc_done()   {
             
             $dataedit = $_POST;       
             $dataedit["filedoc"] = $_FILES["ed_doc"];
             $this->model_pages->edit_doc($dataedit);    
             header('Location: '.base_url().'manage_pages/show_docs/');     
    }
//*******************************************************************************  
function edit_doc_visible($id, $vis) 
    {
        $data=array();
             $data = $this->model_pages->edit_doc_visible($id, $vis);                
        header('Location: '.$_SERVER['HTTP_REFERER']); 
    }    
   //************************************************************************************    
   function update_doc_number() 
    {
         $arr_img =   $_POST; 
          $data = $_POST;
        echo "Очерёдность сохранена!";
      $data = $this->model_pages->update_doc_number($arr_img);
    }
  //************************************************************************************    
      
   //*******************************************************************************
       
           
        
  //*******************************************************************************    
  
}
?>