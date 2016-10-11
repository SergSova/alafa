<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_payments extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
     $this->load->model('admin/model_pages','model_pages'); 
     $this->load->model('admin/model_payments','model_payments'); 
     
      $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
     if (!isset($user['user_id']) || empty($user['user_id'])) {
         header('Location: '.base_url().'admin'); 
    }  
    $this->session->set_userdata('open_menu','payments');            
    }
  //************************************************************************************
   
    //************************************************************************************
 
  //************************************************************************************
  //************************************************************************************
           function add_payment () {
             $data=array();
           //  $data['manager'] = $this->model_pages->loadUsers();
         //  $data['groups'] = $this->model_payments->load_payments_Groups_For_Add();
         //  $data['regions'] = $this->model_payments->load_Regions(); 
             $data['template'] = 'payments/add_payment'; 
          
        $this->load->view('admin/main', $data); 
     }

  //************************************************************************************
       function add_paymenttolist() {
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
             $this->model_payments->addpaymentToList($dataadd);
               echo base_url().'manage_payments/show_payments' ;
          }
        // echo "46 246 2546"; 
        //   $add = $this->model_pages->addpaymenttolist($data);
        //  header('Location: '.base_url().'manage_shop/show_payments'); 
          }
  //************************************************************************************
         function payment($id)      {
       $data=array();
             $data['payment'] = $this->model_payments->loadpayment_one($id);
           //  $data['delivery_services'] = $this->model_bills->load_Delivery_services(); 
             $data['order_statuses'] = $this->model_bills->load_Order_satuses(); 
             $data['payment_id'] = $id;
             
           //  $data['orders'] = $this->model_payments->Get_Orders_All_User($id);  
             
           //  $data['providers'] = $this->model_bills->loadProviders(); 
          //   $data['groups'] = $this->model_payments->load_payments_Groups_For_Add();
           //  $data['comments'] = $this->model_payments->Get_User_comments($id);     
           //  $data['comments_writen'] = $this->model_payments->Get_User_comments_writen($id);     
             
             $data['template'] = 'payments/show_payment_one'; 
          $this->load->view('admin/main', $data);
    } 
 //************************************************************************************
        function edit_payment($id)    {
    
        $data=array();
       // $data['towns'] = $this->model_payments->load_Towns_alone();
       // $data['groups'] = $this->model_payments->load_payments_Groups_For_Add();
        $data['payment'] = $this->model_payments->loadpaymentforedit($id);
           //  $data['categories'] = $this->model_pages->loadCategories();
             $data['template'] = 'payments/edit_payment'; 
          $this->load->view('admin/main', $data);
    } 
    //************************************************************************************  
       function edit_payment_done() {
        
     //   echo "444";
          $dataedit = $_POST;
       //    echo "<pre>";
         //  print_r($dataedit);exit();
         //  if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', trim($dataedit['email']))){ 
         if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i", trim($dataedit['email']))){ 
      // 
            echo "Неверно введен email <br>";
          } 
        else  if(!isset($dataedit['gender'])) {
          echo " Вы не указали пол пользователя  <br>";
          }  
        else  if(trim($dataedit['surname'])=='') {
          echo " Вы не ввели фамилию пользователя  <br>";
          }
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
             $this->model_payments->edit_payment($dataedit);
               echo base_url().'manage_payments/show_payments' ;
          }
        
          }  
 
  //************************************************************************************
  /*function payment_name() {

    $data = $_POST;
    $keyword = $data['term'];  
  
    $datawords = $this->model_payments->loadpaymentNameForSearch($keyword);      

    $keywords = array();
        foreach ($datawords as $datawords){
     
     $datalist = $datawords['surname'] ;                              
          array_push($keywords, $datalist);
        }                                                              
    echo json_encode($keywords);  
    }  */
 //************************************************************************************            
    function payment_name() {

    $data = $_POST;
    $keyword = $data['term'];                                      
   $datawords_count = $this->model_payments->loadpaymentNameForSearch($keyword); 
 //  print_r($datawords_count);     
   if($datawords_count>0) {    
      echo "Найдено ".$datawords_count." совпадений" ; 
   }
   else{
      echo "Cовпадений нет" ;  
   } 
    }
  //************************************************************************************
   function delete_payment($id) {
        $this->model_payments->delete_payment($id) ;
        
        if($this->session->userdata('payments_admin_page') != ''){
        
        $redirect_url = $this->session->userdata('payments_admin_page');   
        header('Location: '.base_url().ltrim($redirect_url, "/"));     
        
       $this->session->unset_userdata('payments_admin_page');
       }
         
    } 
    // **************************************************************************************      
function generate_filter() {

 $data = $_POST; 
 
 $date_reg_from = trim($data['date_reg_from']);
 $date_reg_to = trim($data['date_reg_to']);
 
 $pay_done_from = trim($data['pay_done_from']);
 $pay_done_to = trim($data['pay_done_to']);
 
 $target = trim($data['target']);
 $pb_status = trim($data['pb_status']);
 $payment_status = trim($data['payment_status']);
  
 
 $filtr_name = str_replace(' ', '_', $data['filtr_name']); 
 $filtr_name =  str_replace( "@", "[at]", urldecode($filtr_name)) ;     
 
                    //===
                    if($target == ''){
                    $target = 'alltargets';
                    }
                    if($pb_status == ''){
                    $pb_status = 'all_pb_status';
                    } 
                    if($payment_status == ''){
                    $payment_status = 'allpaystatuses';
                    }     
                    //===
                     //===
                    if($date_reg_from == ''){
                    $date_reg_from = 'old';
                    }
                    if($date_reg_to == ''){
                    $date_reg_to = 'new';
                    }      
                    //===
                    if($pay_done_from == ''){
                    $pay_done_from = 'old';
                    }                                              
                    if($pay_done_to ==''){
                    $pay_done_to = 'new';
                    }
                    //===
                   
                    // заносим значение поля отправитель в переменную sender
                                        
                if($filtr_name==''){
                    $filtr_name = 'nsw';
                    } 
        
   header('Location: '.base_url().'manage_payments/filter_payments/'.$target."/".$pb_status."/".$payment_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to."/".$filtr_name."/");  
   

} 
    
 //**********************************************************************************        
 //************************************************************************************
 function filter_payments (  $target='alltargets', $pb_status='all_pb_status', $payment_status='allpaystatuses', $date_reg_from='old', $date_reg_to='new', $pay_done_from='old', $pay_done_to='new',  $word ='', $start_limit = 0) {
       
     
     if($this->session->userdata('item_per_page_adm_to_begin')=='1') {
            header('Location: '.base_url().'manage_payments/filter_payments/'.$target."/".$pb_status."/".$payment_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to."/".$filtr_name."/0");
            $this->session->unset_userdata('item_per_page_adm_to_begin');   
        }
        
     if(  $target=='alltargets' && $pb_status=='all_pb_status' && $payment_status=='allpaystatuses' &&  $date_reg_from=='old' && $date_reg_to=='new' && $pay_done_from=='old' && $pay_done_to=='new'  && ( $word=='' || $word=='nsw' )) {
             header('Location: '.base_url().'manage_payments/show_payments/');
       }
       
      
       if($date_reg_from==''){  $date_reg_from = 'old';   } 
       if($date_reg_to==''){  $date_reg_to = 'new';   } 
       if($pay_done_from==''){  $pay_done_from = 'old';   } 
       if($pay_done_to==''){  $pay_done_to = 'new';   }  
       
       if($target==''){  $target = 'alltargets';   }  
       if($pb_status==''){  $pb_status = 'all_pb_status';   }  
       if($payment_status==''){  $payment_status = 'allpaystatuses';   }   
       
     
       $data['selected_date_reg_from'] = $searchdata['date_reg_from'] = trim($date_reg_from);
       $data['selected_date_reg_to'] = $searchdata['date_reg_to'] = trim($date_reg_to);   
       $data['selected_pay_done_from'] = $searchdata['pay_done_from'] = trim($pay_done_from);
       $data['selected_pay_done_to'] = $searchdata['pay_done_to'] = trim($pay_done_to); 
       
       $data['selected_target'] = $searchdata['target'] = trim($target);
       $data['selected_pb_status'] = $searchdata['pb_status'] = trim($pb_status);
       $data['selected_payment_status'] = $searchdata['payment_status'] = trim($payment_status);
       
      // echo $word."<br>";
      
      $word =  str_replace( "[at]", "@", urldecode($word)) ;
  
      $data['selected_word'] = $searchdata['word'] = trim(urldecode($word));
                      
       // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        $this->load->library('pagination');
       // $data=array();           
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_payments/filter_payments/'.$target."/".$pb_status."/".$payment_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to.'/'.$word.'/'; 
        // Обозначаем общее количество отзывов
        $data['paymentslistall'] = $this->model_payments->Get_Filtered_payments($searchdata, $start_limit);
     //    echo "<pre>";
     //    echo $data['products']['total'];
     //    print_r($data['products']); 
     //    exit();
     if(!isset($data['paymentslistall']['total'])){$data['paymentslistall']['total'] = 0;}
        $data['pagination_config']['total_rows'] = $data['paymentslistall']['total']; 
         // Число отзывов на страницу
        $data['pagination_config']['uri_segment'] = 12;
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
      //  $data['groups'] = $this->model_payments->load_payments_Groups_For_Add();  
       //  echo "<pre>"; print_r( $data['groups']);                                             
             //$data['regions'] = $this->model_payments->load_Regions(); 
        $data['pages_code'] = $this->pagination->create_links();
        
 // $vip_com."/".$where_find."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to."/".$order_sum_from."/".$order_sum_to.'/'.$word
     //   $data['dowload_query'] = $date_dont_disturb."/".$user_status."/".$vip_com."/".$where_find."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to."/".$order_sum_from."/".$order_sum_to.'/'.$word.'/';      
          $data['targets'] = $this->model_payments->load_List_targets(); 
          
             $data['template'] = 'payments/filter_payments'; 
             $this->load->view('admin/main', $data); 
       

     }   
  //*******************************************************************************
    
    //************************************************************************************
 function show_payments ($start_limit = 0) {
    
       // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_payments/show_payments/';
        // Обозначаем общее количество отзывов                                                    
      $data['paymentslistall'] = $this->model_payments->Get_payments_All_for_filter($start_limit); 
      if(isset($data['paymentslistall']['total'])){
      $data['pagination_config']['total_rows'] = $data['paymentslistall']['total'];
      $data['total'] = $data['paymentslistall']['total'];
      }else{$data['paymentslistall']['total']=0;}
        // Число отзывов на страницу
        $data['pagination_config']['per_page'] = 20;     
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
       
      $data['targets'] = $this->model_payments->load_List_targets(); 
             $data['pages_code'] = $this->pagination->create_links();    
             $data['template'] = 'payments/filter_payments'; 

             $this->load->view('admin/main', $data); 
     }
  //************************************************************************************
 //************************************************************************************
           function add_order_vivod () {
             $data=array();
           //  $data['manager'] = $this->model_pages->loadUsers();
         //  $data['groups'] = $this->model_order_vivods->load_order_vivods_Groups_For_Add();
         //  $data['regions'] = $this->model_order_vivods->load_Regions(); 
             $data['template'] = 'payments/add_order_vivod'; 
          
        $this->load->view('admin/main', $data); 
     }

  //************************************************************************************
       function add_order_vivodtolist() {
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
             $this->model_payments->addorder_vivodToList($dataadd);
               echo base_url().'manage_order_vivods/show_order_vivods' ;
          }
        // echo "46 246 2546"; 
        //   $add = $this->model_pages->addorder_vivodtolist($data);
        //  header('Location: '.base_url().'manage_shop/show_order_vivods'); 
          }
  //************************************************************************************
         function order_vivod($id)      {
       $data=array();
             $data['order_vivod'] = $this->model_payments->loadorder_vivod_one($id); 
             $data['order_vivod_id'] = $id; 
             $data['template'] = 'payments/show_order_vivod_one'; 
          $this->load->view('admin/main', $data);
    } 
 //************************************************************************************
        function edit_order_vivod($id)    {
    
        $data=array();
       // $data['towns'] = $this->model_order_vivods->load_Towns_alone();
       // $data['groups'] = $this->model_order_vivods->load_order_vivods_Groups_For_Add();
        $data['order_vivod'] = $this->model_payments->loadorder_vivodforedit($id);
           //  $data['categories'] = $this->model_pages->loadCategories();
             $data['template'] = 'payments/edit_order_vivod'; 
          $this->load->view('admin/main', $data);
    } 
    //************************************************************************************  
       function edit_order_vivod_done() {
        
     //   echo "444";
          $dataedit = $_POST;
       //    echo "<pre>";
         //  print_r($dataedit);exit();
         //  if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', trim($dataedit['email']))){ 
         if(!preg_match("/[-0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i", trim($dataedit['email']))){ 
      // 
            echo "Неверно введен email <br>";
          } 
        else  if(!isset($dataedit['gender'])) {
          echo " Вы не указали пол пользователя  <br>";
          }  
        else  if(trim($dataedit['surname'])=='') {
          echo " Вы не ввели фамилию пользователя  <br>";
          }
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
             $this->model_payments->edit_order_vivod($dataedit);
               echo base_url().'payments/show_order_vivods' ;
          }
        
          }  
 
  //************************************************************************************
  /*function order_vivod_name() {

    $data = $_POST;
    $keyword = $data['term'];  
  
    $datawords = $this->model_order_vivods->loadorder_vivodNameForSearch($keyword);      

    $keywords = array();
        foreach ($datawords as $datawords){
     
     $datalist = $datawords['surname'] ;                              
          array_push($keywords, $datalist);
        }                                                              
    echo json_encode($keywords);  
    }  */
 //************************************************************************************            
    function order_vivod_name() {

    $data = $_POST;
    $keyword = $data['term'];                                      
   $datawords_count = $this->model_payments->loadorder_vivodNameForSearch($keyword); 
 //  print_r($datawords_count);     
   if($datawords_count>0) {    
      echo "Найдено ".$datawords_count." совпадений" ; 
   }
   else{
      echo "Cовпадений нет" ;  
   } 
    }
  //************************************************************************************
   function delete_order_vivod($id) {
        $this->model_payments->delete_order_vivod($id) ;
        
        if($this->session->userdata('order_vivods_admin_page') != ''){
        
        $redirect_url = $this->session->userdata('order_vivods_admin_page');   
        header('Location: '.base_url().ltrim($redirect_url, "/"));     
        
       $this->session->unset_userdata('order_vivods_admin_page');
       }
         
    } 
 //************************************************************************************
 
   function do_komission_sended($id) { 
     $this->model_payments->do_komission_sended($id) ; 
     header('Location: '.$_SERVER['HTTP_REFERER']);           
    } 
 //************************************************************************************
  
   function do_komission_setstatus($id_item, $id_status=0) { 
     $this->model_payments->do_komission_setstatus($id_item, $id_status) ; 
     header('Location: '.$_SERVER['HTTP_REFERER']);           
    } 
 //************************************************************************************
 
   function do_pay_cash_received($id) { 
     $this->model_payments->do_pay_cash_received($id) ; 
     header('Location: '.$_SERVER['HTTP_REFERER']);           
    }     
 // **************************************************************************************         
 // **************************************************************************************      
function generate_filter_order_vivod() {

 $data = $_POST; 
 
 $date_reg_from = trim($data['date_reg_from']);
 $date_reg_to = trim($data['date_reg_to']);
 
 $pay_done_from = trim($data['pay_done_from']);
 $pay_done_to = trim($data['pay_done_to']);
 
 $target = trim($data['target']);
 
 $order_vivod_status = trim($data['order_vivod_status']);
  
 
 $filtr_name = str_replace(' ', '_', $data['filtr_name']); 
 $filtr_name =  str_replace( "@", "[at]", urldecode($filtr_name)) ;     
 
                    //===
                    if($target == ''){
                    $target = 'alltargets';
                    }
                  
                    if($order_vivod_status == ''){
                    $order_vivod_status = 'allpaystatuses';
                    }     
                    //===
                     //===
                    if($date_reg_from == ''){
                    $date_reg_from = 'old';
                    }
                    if($date_reg_to == ''){
                    $date_reg_to = 'new';
                    }      
                    //===
                    if($pay_done_from == ''){
                    $pay_done_from = 'old';
                    }                                              
                    if($pay_done_to ==''){
                    $pay_done_to = 'new';
                    }
                    //===
                   
                    // заносим значение поля отправитель в переменную sender
                                        
                if($filtr_name==''){
                    $filtr_name = 'nsw';
                    } 
        
   header('Location: '.base_url().'manage_payments/filter_order_vivods/'.$target."/".$order_vivod_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to."/".$filtr_name."/");  
   

} 
    
 //**********************************************************************************        
 //************************************************************************************
 function filter_order_vivods (  $target='alltargets',   $order_vivod_status='allpaystatuses', $date_reg_from='old', $date_reg_to='new', $pay_done_from='old', $pay_done_to='new',  $word ='', $start_limit = 0) {
       
     
     if($this->session->userdata('item_per_page_adm_to_begin')=='1') {
            header('Location: '.base_url().'manage_payments/show_order_vivods/'.$target."/".$order_vivod_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to."/".$filtr_name."/0");
            $this->session->unset_userdata('item_per_page_adm_to_begin');   
        }
        
     if(  $target=='alltargets' && $order_vivod_status=='allpaystatuses' &&  $date_reg_from=='old' && $date_reg_to=='new' && $pay_done_from=='old' && $pay_done_to=='new'  && ( $word=='' || $word=='nsw' )) {
             header('Location: '.base_url().'manage_payments/show_order_vivods/');
       }
       
      
       if($date_reg_from==''){  $date_reg_from = 'old';   } 
       if($date_reg_to==''){  $date_reg_to = 'new';   } 
       if($pay_done_from==''){  $pay_done_from = 'old';   } 
       if($pay_done_to==''){  $pay_done_to = 'new';   }  
       
       if($target==''){  $target = 'alltargets';   }  
      
       if($order_vivod_status==''){  $order_vivod_status = 'allpaystatuses';   }   
       
     
       $data['selected_date_reg_from'] = $searchdata['date_reg_from'] = trim($date_reg_from);
       $data['selected_date_reg_to'] = $searchdata['date_reg_to'] = trim($date_reg_to);   
       $data['selected_pay_done_from'] = $searchdata['pay_done_from'] = trim($pay_done_from);
       $data['selected_pay_done_to'] = $searchdata['pay_done_to'] = trim($pay_done_to); 
       
       $data['selected_target'] = $searchdata['target'] = trim($target);
       
       $data['selected_order_vivod_status'] = $searchdata['order_vivod_status'] = trim($order_vivod_status);
       
      // echo $word."<br>";
      
      $word =  str_replace( "[at]", "@", urldecode($word)) ;
  
      $data['selected_word'] = $searchdata['word'] = trim(urldecode($word));
                      
       // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        $this->load->library('pagination');
       // $data=array();           
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_order_vivods/filter_order_vivods/'.$target."/".$order_vivod_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to.'/'.$word.'/'; 
        // Обозначаем общее количество отзывов
        $data['order_vivodslistall'] = $this->model_payments->Get_Filtered_order_vivods($searchdata, $start_limit);
     //    echo "<pre>";
     //    echo $data['products']['total'];
     //    print_r($data['products']); 
     //    exit();
     if(!isset($data['order_vivodslistall']['total'])){$data['order_vivodslistall']['total'] = 0;}
        $data['pagination_config']['total_rows'] = $data['order_vivodslistall']['total']; 
         // Число отзывов на страницу
        $data['pagination_config']['uri_segment'] = 12;
        $data['pagination_config']['num_links'] = 6;
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
         //  echo "<pre>"; print_r( $data['groups']);           
         
        $data['download_query'] = $target."/".$order_vivod_status."/".$date_reg_from."/".$date_reg_to."/".$pay_done_from."/".$pay_done_to.'/'.$word.'/';                                   
 
        $data['pages_code'] = $this->pagination->create_links();
        $data['targets'] = $this->model_payments->load_List_targets(); 
 
             $data['template'] = 'payments/filter_orders'; 
             $this->load->view('admin/main', $data); 
       

     }   
  //*******************************************************************************
    
    //************************************************************************************
 function show_order_vivods ($start_limit = 0) {
    
       // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_order_vivods/show_order_vivods/';
        // Обозначаем общее количество отзывов                                                    
      $data['order_vivodslistall'] = $this->model_payments->Get_order_vivods_All_for_filter($start_limit); 
      if(isset($data['order_vivodslistall']['total'])){
      $data['pagination_config']['total_rows'] = $data['order_vivodslistall']['total'];
      $data['total'] = $data['order_vivodslistall']['total'];
      }else{$data['order_vivodslistall']['total']=0;}
        // Число отзывов на страницу
        $data['pagination_config']['per_page'] = 20;     
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
      // $data['groups'] = $this->model_order_vivods->load_order_vivods_Groups_For_Add();
             $data['pages_code'] = $this->pagination->create_links();   
             $data['targets'] = $this->model_payments->load_List_targets();  
             $data['template'] = 'payments/filter_orders'; 

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
                                                        
         $this->session->set_userdata('sort_paym_result_adm', $sort_by); 
         $this->session->set_userdata('sort_paym_result_adm_firstly', '1');                                                      
           echo $_SERVER['HTTP_REFERER'];
         //header('Location: '.$_SERVER['HTTP_REFERER']);           
    }
 //*******************************************************************************  
  //************************************************************************************  
 function drop_sort_result () {              
                                                            
         $this->session->unset_userdata('sort_paym_result_adm'); 
         $this->session->set_userdata('sort_paym_result_adm_firstly', '1');                                                      
          // echo $_SERVER['HTTP_REFERER'];
          header('Location: '.$_SERVER['HTTP_REFERER']);           
    }
 //************************************************************************************      
 //************************************************************************************  
     function update_payments_main_sum() {
        //$done = $this->model_converter->export_brands() ;
        if ($this->model_payments->update_payments_main_sum(0, 0) ) echo "Export payments history sum Completed";   
    }     
 //************************************************************************************  
 function update_notices () {
        // echo $start_limit; 
        $user_id = $this->session->userdata('user_id');   
        $this->session->sess_update_time();                             
        /////////////////    
           $data=array();     
           
           $new_feed = $this->model_payments->check_new_feed($user_id); 
           $new_callbacks = $this->model_payments->check_new_callbacks($user_id); 
         //  $new_tasks = $this->model_payments->check_new_tasks($user_id);   
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
  function add_payment_comment ($id) {
             $data=array();  
             $data['payment'] = $this->model_payments->loadpayment_one_name($id);                                               
             $data['template'] = 'payments/add_payment_comment'; 
          
        $this->load->view('admin/main', $data); 
     }         
  //************************************************************************************    
   function ask_status_from_bank ($id_order) {
 
 include_once("resources/LiqPay.php") ;           
   // $merchant_id='i30240804689';
    $public_key = 'i30240804689';
   // $signature="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant    
    $private_key="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";  // code of merchant    
    
    $url="https://liqpay.com/?do=clickNbuy";
    $method='card';
       
 $liqpay = new LiqPay($public_key, $private_key);
 $res = $liqpay->api("payment/status", array(
  'version'       => '3',
  'order_id'      => 'ORDER_'.$id_order
 ));
 //  [result] => ok [payment_id] => 46591255 [status] => success [amount] => 1 [currency] => UAH [order_id] => ORDER_2952 [liqpay_order_id] => 1203823u1418827970714415 [description] => Оплата перехода на новый уровень ORDER_2952 
 //  print_r( $res);

if($res->result=='error') {
     $data['status'] = 0;  
     $data['description'] = $res->description;
     $data['message'] = 'Такого платежа в банке не обнаружено или произошла другая ошибка с банком'; 
 
 echo json_encode($data);
} else {
 //$order_id = ltrim("ORDER_", $res->order_id)  ;

    $data = array();
// echo "<br>".$res->result; 
    $data['result'] = $res->result; 
// echo "<br>".$res->payment_id;
    $data['payment_id'] = $res->payment_id;
// echo "<br>".$res->status;
    $data['status_p'] = $res->status;
//echo "<br>".$res->amount;
    $data['amount'] = $res->amount;
//echo "<br>".$res->currency;
    $data['currency'] = $res->currency;
//echo "<br>".$res->order_id;
 
    $data['order_id'] = $id_order;
//echo "<br>".$res->liqpay_order_id;
    $data['liqpay_order_id'] = $res->liqpay_order_id;
//echo "<br>".$res->description;
    $data['description'] = $res->description; 
    $data['date_done'] = date("Y-m-d");

//=====
 $data['status'] = 1;  
 echo json_encode($data); 
 $this->model_payments->update_payment_status_by_admins($data);
 
}
//=====            


       
     }    
 // **************************************************************************************  
 //************************************************************************************    
   function ask_status_from_bank_privat24 ($id_order) {
 
       
    $privat24_merchant_id='105390';
    $privat24_signature="9s2Exf9mt0Inke9W6aHfaI100tPwYSI3";
    /*
 <?xml version="1.0" encoding="UTF-8"?>
<request version="1.0">
  <merchant>
    <id>75482</id>
    <signature>b45d66d192cb258ba1661a978e08cfe1ca171535</signature>
  </merchant>
  <data>
    <oper>cmt</oper>
    <wait>0</wait>
    <test>0</test>
    <payment>
      <prop name="order" value="000AB1502ZGH" />
    </payment>
  </data>
</request> 
     */
    $xml='<?xml version="1.0" encoding="UTF-8"?>
<request version="1.0">
  <merchant>
    <id>'.$privat24_merchant_id.'</id>
    <signature>'.$privat24_signature.'</signature>
  </merchant>
  <data>
    <oper>cmt</oper>
    <wait>0</wait>
    <test>0</test>
    <payment>
      <prop name="order" value="'.$order_id.'" />
    </payment>
  </data>
</request> 
        ';  
    
    $url="https://api.privatbank.ua/p24api/ishop_pstatus";
    $method='card';
       
 $liqpay = new LiqPay($public_key, $private_key);
 $res = $liqpay->api("payment/status", array(
  'version'       => '3',
  'order_id'      => 'ORDER_'.$id_order
 ));
 //  [result] => ok [payment_id] => 46591255 [status] => success [amount] => 1 [currency] => UAH [order_id] => ORDER_2952 [liqpay_order_id] => 1203823u1418827970714415 [description] => Оплата перехода на новый уровень ORDER_2952 
 //  print_r( $res);

if($res->result=='error') {
     $data['status'] = 0;  
     $data['description'] = $res->description;
     $data['message'] = 'Такого платежа в банке не обнаружено или произошла другая ошибка с банком'; 
 
 echo json_encode($data);
} else {
 //$order_id = ltrim("ORDER_", $res->order_id)  ;
 
//=====
 $data['status'] = 1; 
 
 echo json_encode($data);
 
 $this->model_payments->update_payment_status_by_admins($data);
 
}
//=====            


       
     }    
 // **************************************************************************************  
   //************************************************************************************
 //************************************************************************************
 function check_ready_receipts_all () {    
        
        $this->model_payments->check_ready_receipts_all();   
          
 }  
 //**********************************************************************************
 
//**********************************************************************************
   function export_filter_orders ( $target='alltargets',   $order_vivod_status='allpaystatuses', $date_reg_from='old', $date_reg_to='new', $pay_done_from='old', $pay_done_to='new',  $word ='' ) {
       
   // Get_Filtered_payments_download      
       ini_set('memory_limit', '2048M'); 
        set_time_limit (3600);
     //  echo "-"; exit();   
   
       if($date_reg_from==''){  $date_reg_from = 'old';   } 
       if($date_reg_to==''){  $date_reg_to = 'new';   } 
       if($pay_done_from==''){  $pay_done_from = 'old';   } 
       if($pay_done_to==''){  $pay_done_to = 'new';   }  
       
       if($target==''){  $target = 'alltargets';   }  
      
       if($order_vivod_status==''){  $order_vivod_status = 'allpaystatuses';   }   
       
     
       $data['selected_date_reg_from'] = $searchdata['date_reg_from'] = trim($date_reg_from);
       $data['selected_date_reg_to'] = $searchdata['date_reg_to'] = trim($date_reg_to);   
       $data['selected_pay_done_from'] = $searchdata['pay_done_from'] = trim($pay_done_from);
       $data['selected_pay_done_to'] = $searchdata['pay_done_to'] = trim($pay_done_to); 
       
       $data['selected_target'] = $searchdata['target'] = trim($target);
       
       $data['selected_order_vivod_status'] = $searchdata['order_vivod_status'] = trim($order_vivod_status);
       
      // echo $word."<br>";
      
      $word =  str_replace( "[at]", "@", urldecode($word)) ;
  
      $data['selected_word'] = $searchdata['word'] = trim(urldecode($word));
        
      $data['order_vivodslistall'] = $this->model_payments->Get_Filtered_order_vivods_download($searchdata);
               
 $uriki_vid = array(
    "fop"=>  lang('main_user_uriki_vid_sobs_fop') ,
    "pp"=>  lang('main_user_uriki_vid_sobs_pp') ,
    "tov"=>  lang('main_user_uriki_vid_sobs_tov') 
 );         
 
 $nalog_sys = array(
    1=>  lang('main_user_uriki_nalog_sys_1') ,
    2=>  lang('main_user_uriki_nalog_sys_2') ,
    3=>  lang('main_user_uriki_nalog_sys_3') ,
    4=>  lang('main_user_uriki_nalog_sys_4') ,
    5=>  lang('main_user_uriki_nalog_sys_5') ,
    6=>  lang('main_user_uriki_nalog_sys_6') 
 );       
               
             $export_orders_content = '';   
 
 /*  === ===== ====== ===== ====== */
                             
  if (!empty($data['order_vivodslistall']['order_vivods'])){
      
      $data['targets'] = $this->model_payments->load_List_targets(); 
       
 //$export_images_content = '';  
 //////////////////////////////  "UTF-8", "windows-1251" 
   $export_orders_content .= mb_convert_encoding ( " Личный код;Организация (для ЮР.лиц); Пользователь;  Кто привел; Дата запроса ;Дата отправки средств;Назначение ;Сумма (с формы); Сумма (по базе); Статус оплаты; ФИЗ ИНН (ЮР ОКПО) ;Банк;ОКПО банка;МФО банка;Номер карты;Номер счета;Вид собствен. (ЮР); Форма налогообложения   \r", "windows-1251", "UTF-8"  ); // "UTF-8", "windows-1251"   "windows-1251", "UTF-8"
   // birthday
      
   foreach ( $data['order_vivodslistall']['order_vivods'] as $customer) { 
                                                       
 $customer['price'] = str_replace(".", ",", $customer['price']); 
 
 $datetime_create =  date("Y-m-d H:i", $customer['datetime_create']); 
 $datetime_pay_done =  date("Y-m-d H:i", $customer['datetime_pay_done']); 
// $time_to_take = date("H:i", $customer['timestamp_predzakaz']); 
 
 $name = ' - ';
 $referal_info = ' - ';
 $urik_vid_sobs = ' - ';
 $urik_nalog_sys = ' - ';    
 $pay_status_name = ' - '; 
 $target_name = ' - ';
 $target_otkat = ' - ';
 
 if(trim($customer['user_info']['name'])!='') {
     $name = strip_tags(html_entity_decode($customer['user_info']['name'].' '.$customer['user_info']['byfather'].' '.$customer['user_info']['surname'])); 
     //$name = mb_convert_encoding($name, "windows-1251", "UTF-8"); 
    // echo "<br>=".$name."=";
 }    
  if(trim($customer['referal_info']['name'])!='') {
     $referal_info = strip_tags(html_entity_decode($customer['referal_info']['name'].' '.$customer['referal_info']['surname'])); 
    // $referal_info = mb_convert_encoding($name, "windows-1251", "UTF-8"); 
 } 
 // if(isset($cs['referal_info']['name'])) {echo $cs['referal_info']['name'].' '.$cs['referal_info']['surname'] ; }

// $comment = strip_tags(html_entity_decode($customer['text'])); 
// $comment = str_replace(array("\n", "\r\n", "\r"), ' ', $comment); 
// $comment = preg_replace('![^\w\d\s]*!','',$comment);
  
 //------------------                                 
 if ( isset($customer['target']) && !empty($data['targets'])){ foreach($data['targets'] as $target){ 
     if ($customer['target'] == $target['id']){ $target_name = $target['menu_name'] ; $target_otkat =  $target['otkat'] ;}  
    }
 }  
 //------------------   
 //------------------                                 
   foreach($uriki_vid as $key_vid=>$val_vid ) { 
      if($customer['user_info']['urik_vid_sobs'] == $key_vid ) { $urik_vid_sobs = $val_vid; } 
      }
 //------------------  
   if($customer['pay_status']==0){ $pay_status_name = "ожидает отправки"; }  if($customer['pay_status']==1) {$pay_status_name =  "отправлен";}              
  //------------------ 
   foreach($nalog_sys as $key_sys=>$val_sys ) { 
       if($customer['user_info']['urik_nalog_sys'] == $key_sys ) { $urik_nalog_sys = $val_sys; }   ;  
    }
  //------------------ 
 // Личный код; Пользователь; Организация (для ЮР.лиц)4 Кто привел; Дата запроса ;Дата отправки средств;Назначение ;Сумма (с формы); Сумма (по базе); Статус оплаты; ФИЗ ИНН (ЮР ОКПО) ;Банк;ОКПО банка;МФО банка;Номер карты;Номер счета;Вид собствен. (ЮР); Форма налогообложения   
 
 //   ;Вид собствен. (ЮР); Форма налогообложения   
$export_orders_content .= mb_convert_encoding (  $customer['id']."; ".$customer['user_info']['urik_name']."; ".$name.";".$referal_info."; ".$datetime_create."; ".$datetime_pay_done.";".$target_name.";".$customer['price']."; ".$target_otkat.";".$customer['user_info']['urik_edrpou'].";".$customer['bank_name']." ;".$customer['bank_edrpou']."; ".$customer['bank_mfo'].";".$customer['card_number'].";".$customer['card_shet']."; ".$urik_vid_sobs."; ".$urik_nalog_sys."   \r", "windows-1251", "UTF-8"); // "UTF-8  windows-1251     
             
// echo "<br><br>".$export_orders_content; 
  } //  
 
  // echo $export_orders_content; exit();   
 // echo "<br>".$customer['id']."; ".$customer['user_info']['urik_name']."; ".$name.";".$referal_info."; ".$datetime_create."; ".$datetime_pay_done.";".$target_name.";".$customer['price']."; ".$target_otkat.";".$customer['user_info']['urik_edrpou'].";".$customer['bank_name']." ;".$customer['bank_edrpou']."; ".$customer['bank_mfo'].";".$customer['card_number'].";".$customer['card_shet']."; ".$urik_vid_sobs."; ".$urik_nalog_sys;
   //////////////////////////////// 
  }
   
                                                                   
  $this->download_query_orders($export_orders_content);
       

     }   
//*********************************************************************************
 //*************************************************************        
  function download_query_orders($content) {   
                                  
//echo $content; exit(); 
if(isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))

Header('Content-Type: application/force-download');

else

Header('Content-Type: application/octet-stream');                                                 
Header('Accept-Ranges: bytes');                                   
Header('Content-Length: '.strlen($content));                                                     
Header('Content-disposition: attachment; filename="alafa.com.ua - Отчет по Заявкам - '.date("Y-m-d H:i:s").'.csv"');

echo $content;

exit();                                                            
    }    
//************************************************************************************
  //**********************************************************************************
   function set_hand_tranz () {
                              
   $data = $_POST; 
  // echo "===========<br><pre>"; print_r($data); exit();
   if($data['tranz_id']==0 || $data['tranz_id']==''  ) {
       echo "Указаны не все данные"; exit();
   }
   
     if(!$this->model_payments->set_hand_tranz($data)    ){      
       echo 'Статус не может быть изменен. <br> ';           
    } 
    else {   
        echo 1;      
    }
    }          
  //**********************************************************************************      
 // **************************************************************************************  
 //************************************************************************************
  //************************************************************************************    
  //*********************************************************************************         
  //*******************************************************************************    
  
}
?>