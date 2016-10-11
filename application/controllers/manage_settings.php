<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_settings extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
     $this->load->model('admin/model_pages','model_pages'); 
     $this->load->model('admin/model_settings','model_settings'); 
     
      $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
     if (!isset($user['user_id']) || empty($user['user_id'])) {
         header('Location: '.base_url().'admin'); 
    } 
    $this->session->set_userdata('open_menu','settings');            
    }
  //************************************************************************************
   
  //************************************************************************************
  //************************************************************************************
          function settings () {
            // echo "1111111111111"; exit();
             $data=array();
             $data['admindata'] = $this->model_settings->loadAdmins(); 
             $data['emails'] = $this->model_settings->loadEmails();
            // $data['groups'] = $this->model_settings->loadGroups();
           //  $data['masters'] = $this->model_settings->loadMasters(); 
           //  print_r($data); exit;
             $data['template'] = 'settings/settings'; 
             $this->load->view('admin/main', $data); 
     }
          
 //********************************************************************************
 //************************************************************************************
     
         function add_admin () {
             $data=array();

             $data['template'] = 'settings/add_user'; 
          
        $this->load->view('admin/main', $data); 
     }
    //************************************************************************************
       function add_admintolist() {
   //   echo "<pre>";         
   // print_r($_POST); exit();         
  
           $data = $_POST;
           $add = $this->model_settings->addusertolist($data);
          header('Location: '.base_url().'manage_settings/settings'); 
         //   $this->show_users(); 
         }
  //************************************************************************************
       function edit_admin($id) 
    {
        $data=array();
             $data['user'] = $this->model_settings->loadUserforedit($id);
             $data['template'] = 'settings/edit_user'; 
          $this->load->view('admin/main', $data);
    } 
    //************************************************************************************
    function edit_user_done() 
    {
        $data = $_POST;
        $data = $this->model_settings->edit_user($data);
       header('Location: '.base_url().'manage_settings/settings');
    }
        //**********************************************************************
    function delete_admin($id) {
        $this->model_settings->delete_user($id) ;
     header('Location: '.base_url().'manage_settings/settings');
    } 
      //**********************************************************************
       //************************************************************************************
       function edit_email($id) 
    {
        $data=array();
             $data['email'] = $this->model_settings->loadEmailforedit($id);
             $data['template'] = 'settings/edit_email'; 
          $this->load->view('admin/main', $data);
    } 
    //************************************************************************************
    function edit_email_done() 
    {
        $data = $_POST;
        $data = $this->model_settings->edit_email($data);
       header('Location: '.base_url().'manage_settings/settings');
    }

//************************************************************************************ 
    
  //************************************************************************************
          function show_employees () {
             $data=array();
             $data['employees'] = $this->model_settings->loadEmployees();
           //  $data['moderators'] = $this->model_settings->loadModerators();
           //  $data['masters'] = $this->model_settings->loadMasters(); 
           //  print_r($data); exit;
             $data['template'] = 'managers/show_employees'; 
             $this->load->view('admin/main', $data); 
     }
    //************************************************************************************
         function add_employee () {
             $data=array();
          //   $data['employees'] = $this->model_settings->loadEmployees();
             $data['template'] = 'managers/add_employee'; 
        $this->load->view('admin/main', $data); 
     }
    //************************************************************************************
       function add_employeetolist() {
          $data = $_POST;
       //   echo "<pre>";         
       //   print_r($data); exit();   
        //   echo "<pre>";
        //   foreach($data['power'] as $k=>$v) 
        //   echo  $k."===".$v ;
          // print_r($data); 
         //  exit();   
           $add = $this->model_settings->addEmployeetolist($data);
          header('Location: '.base_url().'manage_settings/show_employees'); 
         }
     //**********************************************************************************
    function delete_employee($id) {
        $this->model_settings->delete_employee($id) ;
     header('Location: '.base_url().'manage_settings/show_employees');
    } 
      //**********************************************************************
     function edit_employee($id)  {
        $data=array();
             $data['employee'] = $this->model_settings->loadEmployeeforedit($id);
          //   $data['masterlist'] = $this->model_settings->getGroupemployeenametoEditMode($id); 
             $data['template'] = 'managers/edit_employee'; 
          $this->load->view('admin/main', $data);
    } 
 //************************************************************************************
    function edit_employee_done()  {
        
        $data = $_POST;
        $data = $this->model_settings->edit_employee($data);
       header('Location: '.base_url().'manage_settings/show_employees');
    }      
 //********************************************************************** 
 function edit_order_template_custom_bank () {
           // echo "11111";  exit();
             $data=array();
             $data['order_template'] = $this->model_settings->loadOrder_template_custom_bank_for_edit(); 
 
             $data['template'] = 'settings/order_template_custom_bank_edit'; 
            $this->load->view('admin/main', $data);         
    } 
//********************************************************************************* 
function edit_order_template_custom_bank_done() 
    {
        $data = $_POST;
        $data = $this->model_settings->edit_order_template_custom_bank($data);
       header('Location: '.base_url().'manage_settings/show_order_template_custom_bank');
    }

 //************************************************************************************ 
      
//********************************************************************************* 
function show_order_template () {
           // echo "11111";  exit();
             $data=array();
             $data['order_template'] = $this->model_settings->loadOrder_Template(); 
 
             $data['template'] = 'settings/order_template_show'; 
            $this->load->view('admin/main', $data);         
    }
//*********************************************************************************
function edit_order_template () {
           // echo "11111";  exit();
             $data=array();
             $data['order_template'] = $this->model_settings->loadOrder_template_foredit(); 
 
             $data['template'] = 'settings/order_template_edit'; 
            $this->load->view('admin/main', $data);         
    } 
//********************************************************************************* 
function edit_order_template_done() 
    {
        $data = $_POST;
        $data = $this->model_settings->edit_order_template($data);
       header('Location: '.base_url().'manage_settings/show_order_template');
    }

//*********************************************************************************
//********************************************************************************* 
function show_order_template_custom_bank () {
           // echo "11111";  exit();
             $data=array();
             $data['order_template_custom_bank'] = $this->model_settings->loadOrder_template_custom_bank(); 
 
             $data['template'] = 'settings/order_template_custom_bank_show'; 
            $this->load->view('admin/main', $data);         
    }
//*********************************************************************************
//*********************************************************************************
 function show_price_ratio () { 
             $data=array();
             $data['price_ratio'] = $this->model_settings->load_Price_Ratio();
             $data['template'] = 'shop/ratio_edit'; 
             $this->load->view('admin/main', $data); 
     }
//*********************************************************************************  
function edit_price_ratio_done()   {
       $data = $_POST;
          
       $data = $this->model_settings->edit_price_ratio($data);
     echo "Изменения сохранены успешно";
    }
//*********************************************************************************
  //************************************************************************************
     function show_units () { 
             $data=array();
             $data['units'] = $this->model_settings->loadUnits();
             $data['template'] = 'units/units_show'; 
             $this->load->view('admin/main', $data); 
     }
  //************************************************************************************
    function update_unit_number() 
    {
         $arr_img =   $_POST; 
          $data = $_POST;
        echo "Очерёдность сохранена!";
      $data = $this->model_settings->update_unit_number($arr_img);
    }
  //************************************************************************************  
  function edit_unit_visible($id, $vis) 
    {
        $data=array();
             $data = $this->model_settings->edit_unit_visible($id, $vis); 
        header('Location: '.base_url().'manage_settings/show_units'); 
    }    
   //************************************************************************************
        function edit_unit($id) 
    {
        $data=array();
             $data['unit'] = $this->model_settings->loadUnit_foredit($id); 
             $data['template'] = 'units/unit_edit'; 
          $this->load->view('admin/main', $data);
    }
//************************************************************************************
        function edit_unit_done()   {
                 $dataedit = $_POST;

        
             $this->model_settings->edit_unit($dataedit); 
            header('Location: '.base_url().'manage_settings/show_units/');                       
    }
 //************************************************************************ 
     function add_unit () {
             $data['template'] = 'units/unit_add';           
        $this->load->view('admin/main', $data); 
     }    

   //************************************************************************************
       function add_unit_tolist() {
           $dataadd = $_POST; 
             $this->model_settings->add_unit($dataadd); 
             header('Location: '.base_url().'manage_settings/show_units/');  
         
        }  
 //************************************************************************************
    function delete_unit($id) {
        $this->model_settings->delete_unit($id) ;
     header('Location: '.base_url().'manage_settings/show_units/');
    }
//************************************************************************************   
  //************************************************************************************
 //************************************************************************************
 //************************************************************************************    
  
}
?>