<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_customers extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
     $this->load->model('admin/model_pages','model_pages'); 
     $this->load->model('admin/model_customers','model_customers');
     $this->load->model('admin/model_bills','model_bills');
     $this->load->model('admin/model_settings','model_settings'); 
     
      $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
     if (!isset($user['user_id']) || empty($user['user_id'])) {
         header('Location: '.base_url().'admin'); 
    }  
    $this->session->set_userdata('open_menu','customers');            
    }
  //************************************************************************************
   
    //************************************************************************************
 
  //************************************************************************************
  //************************************************************************************
           function add_customer () {
             $data=array();
           //  $data['manager'] = $this->model_pages->loadUsers();
         //  $data['groups'] = $this->model_customers->load_Customers_Groups_For_Add();
         //  $data['regions'] = $this->model_customers->load_Regions(); 
             $data['template'] = 'customers/add_customer'; 
          
        $this->load->view('admin/main', $data); 
     }

  //************************************************************************************
       function add_customertolist() {
          $dataadd = $_POST;
           if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', trim($dataadd['email']))){ 
      
            echo "Неверно введен email <br>";
          } 
          
          if(trim($dataadd['surname'])=='') {
          echo " Вы не ввели фамилию пользователя  <br>";
          }
          
         else if(!isset($dataadd['gender']) || trim($dataadd['gender'])=='') {
          echo " Вы не выбрали пол пользователя  <br>";
          }
          
         else if(trim($dataadd['newpass'])=='') {
          echo " Вы не ввели пароль пользователя <br> ";
          }
         else   if(strlen(trim($dataadd['newpass'])) < 6) {
          echo " Пароль должен быть не менее 6 символов <br>";
          }
         else   if($dataadd['newpass']!=$dataadd['confirm_newpass']) {
          echo "Пароли не совпадают  <br>";
          }
          else {
             $this->model_customers->addCustomerToList($dataadd);
               echo base_url().'manage_customers/show_customers' ;
          }
        // echo "46 246 2546"; 
        //   $add = $this->model_pages->addcustomertolist($data);
        //  header('Location: '.base_url().'manage_shop/show_customers'); 
          }
  //************************************************************************************
         function customer($id)      {
       $data=array();
             $data['customer'] = $this->model_customers->loadCustomer_one($id);
           //  $data['delivery_services'] = $this->model_bills->load_Delivery_services(); 
             $data['order_statuses'] = $this->model_bills->load_Order_satuses(); 
             $data['customer_id'] = $id;
             
           //  $data['orders'] = $this->model_customers->Get_Orders_All_User($id);  
             
           //  $data['providers'] = $this->model_bills->loadProviders(); 
          //   $data['groups'] = $this->model_customers->load_Customers_Groups_For_Add();
           //  $data['comments'] = $this->model_customers->Get_User_comments($id);     
           //  $data['comments_writen'] = $this->model_customers->Get_User_comments_writen($id);     
             
             $data['template'] = 'customers/show_customer_one'; 
          $this->load->view('admin/main', $data);
    } 
 //************************************************************************************
        function edit_customer($id)    {
    
        $data=array();
       // $data['towns'] = $this->model_customers->load_Towns_alone();
       // $data['groups'] = $this->model_customers->load_Customers_Groups_For_Add();
        $data['customer'] = $this->model_customers->loadCustomerforedit($id);
           //  $data['categories'] = $this->model_pages->loadCategories();
             $data['template'] = 'customers/edit_customer'; 
          $this->load->view('admin/main', $data);
    } 
    //************************************************************************************  
       function edit_customer_done() {
        
     //   echo "444";
          $dataedit = $_POST;
       //    echo "<pre>";
         //  print_r($dataedit);exit();
         //  if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', trim($dataedit['email']))){ 
         if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i", trim($dataedit['email']))){ 
      // 
            echo "Неверно введен email <br>";
          } 
      /*   else  if(!isset($dataedit['gender'])) {
          echo " Вы не указали пол пользователя  <br>";
          }  
       else  if(trim($dataedit['surname'])=='') {
          echo " Вы не ввели фамилию пользователя  <br>";
          }*/
            ////// 
          else if(isset($dataedit['change_pass']) && trim($dataedit['newpass'])=='') {    
                 
                  echo " Вы не ввели пароль пользователя <br> ";
                  }
          else if(isset($dataedit['change_pass']) && (strlen(trim($dataedit['newpass'])) < 6)) {
                  echo " Пароль должен быть не менее 6 символов <br>";
                  }
          else if(isset($dataedit['change_pass']) && $dataedit['newpass']!=$dataedit['confirm_newpass']) {
                  echo "Пароли не совпадают  <br>";
                  }
         
          //  } 
               //////     
          else {
           //   echo "!!!!!!!!!!!!";exit();
             $this->model_customers->edit_customer($dataedit);
               echo base_url().'manage_customers/show_customers' ;
          }
        
          }  
 
  //************************************************************************************
  /*function customer_name() {

    $data = $_POST;
    $keyword = $data['term'];  
  
    $datawords = $this->model_customers->loadCustomerNameForSearch($keyword);      

    $keywords = array();
        foreach ($datawords as $datawords){
     
     $datalist = $datawords['surname'] ;                              
          array_push($keywords, $datalist);
        }                                                              
    echo json_encode($keywords);  
    }  */
 //************************************************************************************            
    function customer_name() {

    $data = $_POST;
    $keyword = $data['term'];                                      
   $datawords_count = $this->model_customers->loadCustomerNameForSearch($keyword); 
 //  print_r($datawords_count);     
   if($datawords_count>0) {    
      echo "Найдено ".$datawords_count." совпадений" ; 
   }
   else{
      echo "Cовпадений нет" ;  
   } 
    }
  //************************************************************************************
   function delete_customer($id) {
        $this->model_customers->delete_customer($id) ;
        
        if($this->session->userdata('customers_admin_page') != ''){
        
        $redirect_url = $this->session->userdata('customers_admin_page');   
        header('Location: '.base_url().ltrim($redirect_url, "/"));     
        
       $this->session->unset_userdata('customers_admin_page');
       }
         
    } 
    // **************************************************************************************      
function generate_filter() {

 $data = $_POST; 
 
 $date_reg_from = trim($data['date_reg_from']);
 $date_reg_to = trim($data['date_reg_to']);
 
 $last_visit_from = trim($data['last_visit_from']);
 $last_visit_to = trim($data['last_visit_to']);
  
 
 $filtr_name = str_replace(' ', '_', $data['filtr_name']); 
 $filtr_name =  str_replace( "@", "[at]", urldecode($filtr_name)) ;     

 
                   /* if($order_ready == ''){
                    $order_ready = 'all';
                    }  */
                    
                    //===
                    if($date_reg_from == ''){
                    $date_reg_from = 'old';
                    }
                    if($date_reg_to == ''){
                    $date_reg_to = 'new';
                    }      
                    //===
                    if($last_visit_from == ''){
                    $last_visit_from = 'old';
                    }                                              
                    if($last_visit_to ==''){
                    $last_visit_to = 'new';
                    }
                    //===
                   
                    // заносим значение поля отправитель в переменную sender
                                        
                if($filtr_name==''){
                    $filtr_name = 'nsw';
                    } 
        
   header('Location: '.base_url().'manage_customers/filter_customers/'.$date_reg_from."/".$date_reg_to."/".$last_visit_from."/".$last_visit_to."/".$filtr_name."/");    // 9 segmentov

} 
    
 //**********************************************************************************        
 //************************************************************************************
 function filter_customers (  $date_reg_from='old', $date_reg_to='new', $last_visit_from='old', $last_visit_to='new',  $word ='', $start_limit = 0) {
       
     
     if($this->session->userdata('item_per_page_adm_to_begin')=='1') {
            header('Location: '.base_url().'manage_customers/filter_customers/'.$date_reg_from."/".$date_reg_to."/".$last_visit_from."/".$last_visit_to."/".$filtr_name."/0");
            $this->session->unset_userdata('item_per_page_adm_to_begin');   
        }
        
     if(    $date_reg_from=='old' && $date_reg_to=='new' && $last_visit_from=='old' && $last_visit_to=='new'  && ( $word=='' || $word=='nsw' )) {
             header('Location: '.base_url().'manage_customers/show_customers/');
       }
       
      
       if($date_reg_from==''){  $date_reg_from = 'old';   } 
       if($date_reg_to==''){  $date_reg_to = 'new';   } 
       if($last_visit_from==''){  $last_visit_from = 'old';   } 
       if($last_visit_to==''){  $last_visit_to = 'new';   }   
       
     
       $data['selected_date_reg_from'] = $searchdata['date_reg_from'] = trim($date_reg_from);
       $data['selected_date_reg_to'] = $searchdata['date_reg_to'] = trim($date_reg_to);   
       $data['selected_last_visit_from'] = $searchdata['last_visit_from'] = trim($last_visit_from);
       $data['selected_last_visit_to'] = $searchdata['last_visit_to'] = trim($last_visit_to); 
       
      // echo $word."<br>";
      
      $word =  str_replace( "[at]", "@", urldecode($word)) ;
  
      $data['selected_word'] = $searchdata['word'] = trim(urldecode($word));
                      
       // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        $this->load->library('pagination');
       // $data=array();           
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_customers/filter_customers/'.$date_reg_from."/".$date_reg_to."/".$last_visit_from."/".$last_visit_to.'/'.$word.'/'; 
        // Обозначаем общее количество отзывов
        $data['customerslistall'] = $this->model_customers->Get_Filtered_customers($searchdata, $start_limit);
     //    echo "<pre>";
     //    echo $data['products']['total'];
     //    print_r($data['products']); 
     //    exit();
     if(!isset($data['customerslistall']['total'])){$data['customerslistall']['total'] = 0;}
        $data['pagination_config']['total_rows'] = $data['customerslistall']['total']; 
         // Число отзывов на страницу
        $data['pagination_config']['uri_segment'] = 7;
        $data['pagination_config']['num_links'] = 7;
        $data['pagination_config']['per_page'] = 40;
        $data['pagination_config']['cur_tag_open'] = '<b style="margin:12px 5px 2px 10px;">';
        $data['pagination_config']['cur_tag_close'] = '</b>';
        $data['pagination_config']['full_tag_open'] = '<div class="paginationstyle" align="center">';
        $data['pagination_config']['full_tag_close'] = '</div>';
        $data['pagination_config']['last_link'] = '&rArr;';
        $data['pagination_config']['last_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['last_tag_close'] = '</span>';
        $data['pagination_config']['first_link'] = '&lArr;';
        $data['pagination_config']['first_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['first_tag_close'] = '</span>';
        $data['pagination_config']['next_link'] = '  &rarr;  ';
        $data['pagination_config']['next_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['next_tag_close'] = '</span>';
        $data['pagination_config']['prev_link'] = ' &larr; ';
        $data['pagination_config']['prev_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['prev_tag_close'] = '</span>';
         
        // Инициализируем страницы
        $this->pagination->initialize($data['pagination_config']);
       // PAGINATOR END  
      //  $data['groups'] = $this->model_customers->load_Customers_Groups_For_Add();  
       //  echo "<pre>"; print_r( $data['groups']);                                             
             //$data['regions'] = $this->model_customers->load_Regions(); 
             
        $data['pages_code'] = $this->pagination->create_links();
        
 // $vip_com."/".$where_find."/".$date_reg_from."/".$date_reg_to."/".$last_visit_from."/".$last_visit_to."/".$order_sum_from."/".$order_sum_to.'/'.$word
        $data['dowload_query'] = $date_reg_from."/".$date_reg_to."/".$last_visit_from."/".$last_visit_to.'/'.$word.'/';      
          
          
             $data['template'] = 'customers/filter_customers'; 
             $this->load->view('admin/main', $data); 
       

     }   
  //*******************************************************************************
    
    //************************************************************************************
 function show_customers ($start_limit = 0) {
    
       // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_customers/show_customers/';
        // Обозначаем общее количество отзывов                                                    
      $data['customerslistall'] = $this->model_customers->Get_Customers_All_for_filter($start_limit); 
      if(isset($data['customerslistall']['total'])){
      $data['pagination_config']['total_rows'] = $data['customerslistall']['total'];
      $data['total'] = $data['customerslistall']['total'];
      }else{$data['customerslistall']['total']=0;}
        // Число отзывов на страницу
        $data['pagination_config']['per_page'] = 40;     
        $data['pagination_config']['uri_segment'] = 3;
        $data['pagination_config']['num_links'] = 9;
        $data['pagination_config']['cur_tag_open'] = '<b style="margin:12px 5px 2px 10px;">';
        $data['pagination_config']['cur_tag_close'] = '</b>';
        $data['pagination_config']['full_tag_open'] = '<div class="paginationstyle" align="center">';
        $data['pagination_config']['full_tag_close'] = '</div>';
        $data['pagination_config']['last_link'] = '&rArr;';
        $data['pagination_config']['last_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['last_tag_close'] = '</span>';
        $data['pagination_config']['first_link'] = '&lArr;';
        $data['pagination_config']['first_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['first_tag_close'] = '</span>';
        $data['pagination_config']['next_link'] = '  &rarr;  ';
        $data['pagination_config']['next_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['next_tag_close'] = '</span>';
        $data['pagination_config']['prev_link'] = ' &larr; ';
        $data['pagination_config']['prev_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['prev_tag_close'] = '</span>';
       
        // Инициализируем страницы
        $this->pagination->initialize($data['pagination_config']);
       // PAGINATOR END
      // $data['groups'] = $this->model_customers->load_Customers_Groups_For_Add();
             $data['pages_code'] = $this->pagination->create_links();    
            $data['template'] = 'customers/filter_customers'; 

             $this->load->view('admin/main', $data); 
     }
  //************************************************************************************
    
//************************************************************************************  
//************************************************************************************     
     function change_sort_result () {              
         
         $data = $_POST;
         
         // `menu_name-rus` ASC
         //  sort_name, sort_type
         $sort_name = $data['sort_name'];
         $sort_type = $data['sort_type'];
         
         // $sort_by = " `".$sort_name."` ".$sort_type;
         $sort_by = array();
         $sort_by['sort_name'] = $data['sort_name'];
         $sort_by['sort_type'] = $data['sort_type']; 
         //echo $sort_by;
                                                        
         $this->session->set_userdata('sort_cust_result_adm', $sort_by); 
         $this->session->set_userdata('sort_cust_result_adm_firstly', '1');                                                      
           echo $_SERVER['HTTP_REFERER'];
         //header('Location: '.$_SERVER['HTTP_REFERER']);           
    }
 //*******************************************************************************  
  //************************************************************************************  
 function drop_sort_result () {              
                                                            
         $this->session->unset_userdata('sort_cust_result_adm'); 
         $this->session->set_userdata('sort_cust_result_adm_firstly', '1');                                                      
          // echo $_SERVER['HTTP_REFERER'];
          header('Location: '.$_SERVER['HTTP_REFERER']);           
    }
 //************************************************************************************      
 //************************************************************************************  
     function update_customers_main_sum() {
        //$done = $this->model_converter->export_brands() ;
        if ($this->model_customers->update_customers_main_sum(0, 0) ) echo "Export customers history sum Completed";   
    }     
 //************************************************************************************  
 function update_notices () {
        // echo $start_limit; 
        $user_id = $this->session->userdata('user_id');   
        $this->session->sess_update_time();                             
        /////////////////    
           $data=array();     
           
           $new_feed = $this->model_customers->check_new_feed($user_id); 
           $new_callbacks = $this->model_customers->check_new_callbacks($user_id); 
         //  $new_tasks = $this->model_customers->check_new_tasks($user_id);   
           $wait_goods = $this->model_pages->check_wait_goods_ready();   
           
            $data['status'] = 1;
            $data['new_feed'] = $new_feed; 
            $data['new_callbacks'] = $new_callbacks; 
          //  $data['new_tasks'] = $new_tasks; 
            $data['wait_goods'] = $wait_goods; 
            echo json_encode($data);
                                                      
               // echo " <pre>"; print_r($data['permissions']); exit();   
            
     }   
   //************************************************************************************
  function add_customer_comment ($id) {
             $data=array();  
             $data['customer'] = $this->model_customers->loadCustomer_one_name($id);                                               
             $data['template'] = 'customers/add_customer_comment'; 
          
        $this->load->view('admin/main', $data); 
     }         
  //************************************************************************************    
 //************************************************************************************
        function edit_levels()    {
    
        $data=array(); 
        $data['levels'] = $this->model_customers->load_Levels(); 
        $data['template'] = 'payments/target_edit'; 
          $this->load->view('admin/main', $data);
    } 
    //************************************************************************************  
       function edit_levels_done() {
        
     //   echo "444";
          $dataedit = $_POST;
     // echo "<pre>";   print_r($dataedit);exit();
         
             $this->model_customers->edit_levels_done($dataedit); 
           header('Location: '.base_url().'manage_customers/edit_levels' ); 
           // base_url().'manage_customers/show_customers' ;          
          }  
 
  //************************************************************************************   
 // **************************************************************************************  
   //************************************************************************************
   
 //**********************************************************************************
       
 // **************************************************************************************  
 //************************************************************************************
  //************************************************************************************    
  //*********************************************************************************         
  //*******************************************************************************    
  
}
?>