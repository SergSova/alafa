<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class shop extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
         
    $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
 $main_lang = '';
     if (isset($user['selected_lang']) && !empty($user['selected_lang'])) {
         $main_lang = $user['selected_lang'];
    }
        
        
     $lang = $this->uri->segment(1);
        
        switch($lang){

        case 'en':
        $this->lang->load('main', 'english');
        //$main_lang = 'en'; 
        $this->set_lang($main_lang, 'en');
        break;

        case 'ru':
        $this->lang->load('main', 'russian');
        //$main_lang = 'ru'; 
        $this->set_lang($main_lang, 'ru');
        break;
        
        case 'ua':
        $this->lang->load('main', 'ukrainian');
        break;
       

        default:
        $this->lang->load('main', 'russian');
        
        $main_lang = 'ru';
        $this->set_lang($main_lang, 'ru');
        break;

        }
        $this->load->model('user/model_user', 'model_user'); 
        $this->load->model('admin/model_bills','model_bills');
        $this->load->model('admin/model_routing', 'model_routing');
        
        
$this->session->set_userdata('its_user_page','off');
   

    }
//************************************************************************************ 
      function set_lang ($lang_past, $lang_to_set) {
        // echo $lang_past." ==>> ".$lang_to_set; exit();
          if($lang_past!= '' && $lang_past != $lang_to_set) { 
            $this->session->set_userdata('selected_lang', $lang_to_set);      
          } 
          else if($lang_past== '' ) { 
            $this->session->set_userdata('selected_lang', 'ru');      
          }     
     
        }   
//***********************************************************************************
  //************************************************************************************
       function index () { 
            header('Location: '.base_url());  
     }
 //************************************************************************************    
        function routing3 ($url1='', $url2='', $url3='') {  
        
       // echo "routing3 :  <br>";   
       //  echo "url1 - ".$url1."<br>";                                           
          /*
            echo "routing3 :  <br>";
            echo "url1 - ".$url1."<br>";
            echo "url2 - ".$url2."<br>"; 
            echo "url3 - ".$url3."<br>"; 
          */ 
          $real_content_1 = $this->model_routing->loadContent_t_by_url($url1);
          $real_content_2 = $this->model_routing->loadContent_t_by_url($url2);
          $real_content_3 = $this->model_routing->loadContent_t_by_url($url3); 
         
          if( (!empty($real_content_1) && $real_content_1['ctype'] == 'catalog')  
           && (!empty($real_content_2) && $real_content_2['ctype'] == 'catalog') 
           && (!empty($real_content_3) && $real_content_3['ctype'] == 'offer')  ) {  
           $this->offer($real_content_3['id_data'],$url1, $url2);            
          } 
          else {
          $this->error_404();     
          }                                                                               
                           
     }
 //************************************************************************************
        function routing2 ($url1='', $url2='', $num = 0) {                                      
             // echo "routing2 :  <br>";
           // echo "url1 - ".$url1."<br>";
           // echo "url2 - ".$url2."<br>";   
          $real_content_1 = $this->model_routing->loadContent_t_by_url($url1);
          $real_content_2 = $this->model_routing->loadContent_t_by_url($url2); 
         
       /*   if( (!empty($real_content_1) && !empty($real_content_2) ) 
          && $real_content_1['ctype'] == $real_content_2['ctype'] ) { // == 'catalog'  
           $this->subcategory($real_content_2['id_data'],$url1, $url2, $num);  
          }    */
          
 
        if( (!empty($real_content_1) && $real_content_1['ctype'] == 'catalog')   
           && (!empty($real_content_2) && $real_content_2['ctype'] == 'catalog')    ) {
           $this->subcategory($real_content_2['id_data'],$url1, $url2, $num);  
          }
          
         else if ( (!empty($real_content_1) && $real_content_1['ctype'] == 'catalog')  
           && (!empty($real_content_2) && $real_content_2['ctype'] == 'offer')  ) {
           $this->offer($real_content_2['id_data'], $num);  
          }
         else {                            
                  $this->error_404();   
         }
                           
     }
 //************************************************************************************
        function routing1 ($url1='', $num = 0) {                                      
            // echo "routing1 :  <br>";
             //echo "url1 - ".$url1."<br>";    
            
        $real_content = $this->model_routing->loadContent_t_by_url($url1); 
        
        if( !empty($real_content) && $real_content['ctype'] == 'page') {
             $this->readpage($real_content['id_data']);
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'new') {
             $this->readnew($real_content['id_data']);
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'review') {
             $this->readreview($real_content['id_data']);
        }
        //
        /*
        else if( !empty($real_content) && $real_content['ctype'] == 'gal_alb') {
             $this->gallery_album($real_content['id_data']);
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'gal_cat') {
             $this->gallery_category($real_content['id_data']);
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'brand') {
             $this->brand($real_content['id_data'], $url1, $num);
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'catalog') {
             $this->category($real_content['id_data'], $url1, $num );
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'page_custom') {
             $this->page_custom($real_content['id_data'], $url1, $num );
        }
        else if( !empty($real_content) && $real_content['ctype'] == 'offer') {
             $this->offer($real_content['id_data'], $url1, $num );
        }
        */
        else {                            
                  $this->error_404();   
         }
        /* 
        switch($real_content["ctype"])
        {
            case "page":     
          //  echo $real_content['id_data'];
                $this->readpage($real_content['id_data']);
                break;
            case "brand":
                $this->brand($real_content['id_data'], $num); 
                break;          
            case "catalog":
                $this->category($real_content['id_data'], $url1, $num); 
                break;        
        }  */
                                    
     }
 //************************************************************************************
 //************************************************************************************ 
        function readpage ($id) {
          //  echo "111";
              $real_page_id = $id;
              $data=array();
               
              $data['pages'] = $this->model_user->loadPages();  
              // echo "===========";      
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              
              $data['page'] = $this->model_user->loadPage($real_page_id);
              
              if(empty($data['page'])){    
                  $this->error_404();  
             } 
             else {
              // echo "<pre>"; print_r($data['page']);exit();
             $data['template'] = 'page'; 
             
              
               if($data['page']['note']!='' && $data['page']['note']=='contacts' ){
               $data['template_page_bottom'] = 'forma_feed';
               }
               if($data['page']['note']!='' && $data['page']['note']=='partners' ){
               $data['template_page_bottom'] = 'forma_partners';
               }
               if($data['page']['note']!='' && $data['page']['note']=='order' ){
               $data['template_page_bottom'] = 'order_form';
               $data['hide_bottom_form'] = 1;
               }
               
               if($data['page']['module']!='' && $data['page']['module']=='documents' ){
                   $data['docs'] = $this->model_user->loaddocs();              
                   $data['template_page_bottom'] = 'docs';
               } 
                  
                
               $data['current_page'] = $id;
               $data['crumbs'] = '1';
               $data['page']['last_crumb'] = $data['page']['menu_name']; 
                                                     
          $this->load->view('user/index', $data);
        } 
        }
//***********************************************************************************
//************************************************************************************ 
        function readnew ($id) {

              $data=array();                                                
             
              $data['pages'] = $this->model_user->loadPages();   
            
              $data['blocks'] = $this->model_user->loadBlocksIndex(); 
                
                $real_new_id = $id;
                 
              $data['page'] = $this->model_user->loadNew($real_new_id);      
              if(empty($data['page'])){    
                  $this->error_404();  
            } 
            else {
              $data['crumbs'] = '1';
              $data['back_link'] = "<a href = '/".lang('main_lang')."/news'>".lang('main_news')." </a>";
              // $data['page']['last_crumb'] = "<a href = '/".lang('main_lang')."/news'>Новости </a> &rarr; ".$data['page']['h1'];  
              
              $data['template'] = 'news/new';   
          $this->load->view('user/index', $data);
        }  
        }   
//************************************************************************************
//************************************************************************************ 
        function readreview ($id) {

              $data=array();              
              $data['pages'] = $this->model_user->loadPages();    
              $data['blocks'] = $this->model_user->loadBlocksIndex(); 
                
              $real_new_id = $id;
                 
              $data['page'] = $this->model_user->loadNew($real_new_id);      
              if(empty($data['page'])){    
                  $this->error_404();  
            } 
            else {
              $data['crumbs'] = '1';
              $data['back_link'] = "<a href = '/".lang('main_lang')."/reviews'>".lang('main_reviews')." </a>";
              
              $data['template'] = 'news/review';   
          $this->load->view('user/index', $data);
        }  
        }   
//************************************************************************************
//************************************************************************************ 
//************************************************************************************
//************************************************************************************  
//************************************************************************************     
//*******************************************************************************
//*********************************************************************************** 
//*******************************************************************************  
//******************************************************************************* 
  
//************************************************************************************         
 function error_404() {
    set_status_header(404);
    $data=array();
              $data['pages'] = $this->model_user->loadPages();  
              $data['blocks'] = $this->model_user->loadBlocksIndex();
              $data['page'] = $this->model_user->loadErrorPage();  
              $data['template'] = 'page';  
    $this->load->view('user/index', $data);
    //exit(); 
    //return "404 - not found";
}     
 //************************************************************************************
  
//*******************************************************************************
//******************************************************************************* 
//******************************************************************************* 
//******************************************************************************* 
//******************************************************************************* 
//******************************************************************************* 
//******************************************************************************* 
//******************************************************************************* 
//******************************************************************************* 
}
?>