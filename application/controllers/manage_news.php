<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cliManageCustomFields Controller class
 * @author  Ageev Alexey
 */

class manage_news extends CI_Controller {
    /**
     * Authorization Constructor
     */
   function __construct()
    {
        parent::__construct();
     $this->load->model('admin/model_news','model_news'); 
     $this->load->model('admin/model_object','model_object');
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
      function show_news ($start_limit = 0) { 
            // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        //  echo "1111111111111"; exit();    
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_news/show_news/';
        // Обозначаем общее количество отзывов
       // $data['pagination_config']['total_rows'] = $this->model_news->count_all_news();
       $data['news'] = $this->model_news->loadNews($start_limit);  
             if(isset($data['news']['total'])){
              $data['pagination_config']['total_rows'] = $data['news']['total'];
              $data['total'] = $data['news']['total'];
              }else{$data['news']['total']=0;}
        // Число отзывов на страницу
        $data['pagination_config']['per_page'] = 20;
        $data['pagination_config']['cur_tag_open'] = '<b style="margin:12px 5px 2px 10px;">';
        $data['pagination_config']['cur_tag_close'] = '</b>';
        $data['pagination_config']['full_tag_open'] = '<div class="paginationstyle" align="center">';
        $data['pagination_config']['full_tag_close'] = '</div>';
        $data['pagination_config']['last_link'] = 'К последней странице';
        $data['pagination_config']['last_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['last_tag_close'] = '</span>';
        $data['pagination_config']['first_link'] = 'В начало';
        $data['pagination_config']['first_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['first_tag_close'] = '</span>';
        $data['pagination_config']['next_link'] = ' &gt; Следующая &gt; ';
        $data['pagination_config']['next_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['next_tag_close'] = '</span>';
        $data['pagination_config']['prev_link'] = ' &lt; Предыдущая &lt; ';
        $data['pagination_config']['prev_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['prev_tag_close'] = '</span>';
       
        // Инициализируем страницы
        $this->pagination->initialize($data['pagination_config']);
             

             $data['pages_code'] = $this->pagination->create_links();
               $data['template'] = 'news/show_news'; 
             $this->load->view('admin/main', $data); 
     }

  //************************************************************************************ 
        function add_new () {
 
            
             $data['template'] = 'news/add_new';
                        
        $this->load->view('admin/main', $data); 
     }
   //************************************************************************************
  function add_new_done() {
           $data = $_POST;
           $data["fileimg"] = $_FILES["img"];      
           $this->model_news->add_new($data);
        header('Location: '.base_url().'manage_news/show_news');             
        }    
   //************************************************************************************  
    function edit_new($id) 
    {
        $data=array();
             $data['new'] = $this->model_news->loadNewforedit($id); 
            // $data['object_photo_links'] = $this->model_pages->load_offer_news_links($id); 
             // load_goods_links_of_news   load_offer_news_links
             //$data['object_photo_links'] = $this->model_pages->load_object_news_links($id); 
             $data['template'] = 'news/edit_new'; 
          $this->load->view('admin/main', $data);
    }  
 //************************************************************************************ 
          function edit_new_done() 
    {
          $data = $_POST;
        $data["fileimg"] = $_FILES["img"];    
        $data = $this->model_news->edit_new($data);
       header('Location: '.base_url().'manage_news/show_news');    
    }
   //*******************************************************************************
 function edit_new_visible($id, $vis) 
    {
        $data=array();
             $data = $this->model_news->edit_new_visible($id, $vis); 
        header('Location: '.base_url().'manage_news/show_news'); 
    }
     //*******************************************************************************
 function edit_new_rss($id, $vis) 
    {
        $data=array();
             $data = $this->model_news->edit_new_rss($id, $vis); 
        header('Location: '.base_url().'manage_news/show_news'); 
    }
   //*******************************************************************************
    function delete_new($id) {
        $this->model_news->delete_new($id) ;
     header('Location: '.base_url().'manage_news/show_news');
    }
 //************************************************************************************
    function update_news_number() 
    {
         $arr_img =   $_POST; 
          $data = $_POST;
         echo "Порядок новостей сохранён!";
 
      $data = $this->model_news->update_news_number($arr_img);
    }
   //********************************************************************************
//************************************************************************ 
     function add_new_objekt_photo_link ($selected_new=0) {
         //loadCategoriesNames           $id
             $data['selected_new'] =  $selected_new;        
             //$data['categories'] = $this->model_pages->loadCategoriesForAddCatalog(); 
             $data['categories'] = $this->model_pages->loadCategoriesForAddCatalog(); 
            // $data['template'] = 'shop/offer-object_link_add';           
             $this->load->view('admin/news/new-object_link_add', $data); 
     }    
//************************************************************************************
    function add_link_new_to_object($id_photo, $new_id)    {
     
       // echo "1";
       if(!$this->model_pages->add_link_new_to_object($id_photo, $new_id)){
          echo "0";   
       }
       else {
           $data['object_photo_links'] = $this->model_pages->load_offer_news_links($new_id);
           // load_offer_news_links  load_object_news_links
           
           $this->load->view('admin/news/new_objects_links_photo_list', $data);   
         //echo "По странной причине создание связи не произошло...."; 
       }
    }
 //************************************************************************************  
      function delete_link_new_to_object($id_link, $new_id)    {
    
       // echo "1";
       if(!$this->model_pages->delete_link_new_to_object($id_link, $new_id)){
          echo "0";   
       }
       else {
           $data['object_photo_links'] = $this->model_pages->load_offer_news_links($new_id);
           $this->load->view('admin/news/new_objects_links_photo_list', $data);   
         //echo "По странной причине создание связи не произошло...."; 
       }
    }        
//******************************************************************************* 
// ***********                        *******************************************   
//******************************************************************************* 
     function add_new_offer_photo_link ($selected_new=0) {
         //loadCategoriesNames           $id
             $data['selected_new'] =  $selected_new;        
             $data['categories'] = $this->model_pages->load_Categories_for_add_catalog();  
            // $data['template'] = 'shop/offer-offer_link_add';           
             $this->load->view('admin/news/new-offer_link_add', $data); 
     }  
 //************************************************************************************    
  function data_load_offer_photos_for_link () {
             $data = $_POST;    
             $data['object_photo_links'] = $this->model_pages->loadoffers_by_catalog($data['id']);
             // echo "<pre>"; print_r($data['object_photo_links']);  exit();
       $this->load->view('admin/news/new-object-photos_list', $data);         
     
        }     
//************************************************************************************
 /*   function add_link_new_to_offer($id_photo, $new_id)    {
                                
       if(!$this->model_pages->add_link_new_to_offer($id_photo, $new_id)){
          echo "0";   
       }
       else {
           $data['offer_photo_links'] = $this->model_pages->load_offer_news_links($new_id);
           $this->load->view('admin/news/new_offers_links_photo_list', $data);  
       }
    }  */
    //************************************************************************************
    function add_link_good_to_new($offer, $new_id)    {  ///++++++++++++++++++++
         $arr_img =   $_POST; 
          //$data = $_POST;
       // echo "1";
       if(!$this->model_pages->add_link_good_to_new($offer, $new_id)){
          echo "0";   
       }
       else {                                                                                       
           $data['object_photo_links'] = $this->model_pages->load_offer_news_links($new_id);  // loadThumb_of_offer_photo   load_goods_links_of_newsload_object_photo_links   
           
          // echo "adfbadfbadfadfadfg";
          $data['new'][0] = $new_id;
           $this->load->view('admin/news/new_objects_links_photo_list', $data);   
         //echo "По странной причине создание связи не произошло...."; 
       }
    }
 //************************************************************************************  
      function delete_link_new_to_offer($id_link, $new_id)    {
    
       // echo "1";
       if(!$this->model_pages->delete_link_new_to_offer($id_link, $new_id)){
          echo "0";   
       }
       else {
           $data['object_photo_links'] = $this->model_pages->load_offer_news_links($new_id);
           $data['new'][0] = $new_id;
           $this->load->view('admin/news/new_objects_links_photo_list', $data);   
           // new_offers_links_photo_list
         //echo "По странной причине создание связи не произошло...."; 
       }
    }        
//*******************************************************************************    
   //************************************************************************************    
   //********************************************************************** 
 
 //************************************************************************************ 
      function show_reviews ($start_limit = 0) { 
            // PAGINATOR BEGIN
        $start_limit = intval($start_limit);
        //  echo "1111111111111"; exit();    
        $this->load->library('pagination');
        $data=array();
        // Формируем массив параметров для генерации страниц
        $data['pagination_config'] = Array();
        $data['pagination_config']['base_url'] = base_url().'manage_news/show_news/';
        // Обозначаем общее количество отзывов
       // $data['pagination_config']['total_rows'] = $this->model_news->count_all_reviews();
       $data['reviews'] = $this->model_news->loadreviews($start_limit);  
             if(isset($data['reviews']['total'])){
              $data['pagination_config']['total_rows'] = $data['reviews']['total'];
              $data['total'] = $data['reviews']['total'];
              }else{$data['reviews']['total']=0;}
        // Число отзывов на страницу
        $data['pagination_config']['per_page'] = 20;
        $data['pagination_config']['cur_tag_open'] = '<b style="margin:12px 5px 2px 10px;">';
        $data['pagination_config']['cur_tag_close'] = '</b>';
        $data['pagination_config']['full_tag_open'] = '<div class="paginationstyle" align="center">';
        $data['pagination_config']['full_tag_close'] = '</div>';
        $data['pagination_config']['last_link'] = 'К последней странице';
        $data['pagination_config']['last_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['last_tag_close'] = '</span>';
        $data['pagination_config']['first_link'] = 'В начало';
        $data['pagination_config']['first_tag_open'] = '<span class="pagetocon">';
        $data['pagination_config']['first_tag_close'] = '</span>';
        $data['pagination_config']['next_link'] = ' &gt; Следующая &gt; ';
        $data['pagination_config']['next_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['next_tag_close'] = '</span>';
        $data['pagination_config']['prev_link'] = ' &lt; Предыдущая &lt; ';
        $data['pagination_config']['prev_tag_open'] = '<span class="pagetonext">';
        $data['pagination_config']['prev_tag_close'] = '</span>';
       
        // Инициализируем страницы
        $this->pagination->initialize($data['pagination_config']);
             

             $data['pages_code'] = $this->pagination->create_links();
               $data['template'] = 'news/show_reviews'; 
             $this->load->view('admin/main', $data); 
     }

  //************************************************************************************ 
        function add_review () {
  
             $data['template'] = 'news/add_review';
                        
        $this->load->view('admin/main', $data); 
     }
   //************************************************************************************
  function add_review_done() {
           $data = $_POST;
           $data["fileimg"] = $_FILES["img"];      
           $this->model_news->add_review($data);
        header('Location: '.base_url().'manage_news/show_reviews');             
        }    
   //************************************************************************************  
    function edit_review($id) 
    {
        $data=array();
             $data['review'] = $this->model_news->loadreviewforedit($id); 
            // $data['object_photo_links'] = $this->model_pages->load_offer_reviews_links($id); 
             // load_goods_links_of_reviews   load_offer_reviews_links
             //$data['object_photo_links'] = $this->model_pages->load_object_reviews_links($id); 
             $data['template'] = 'news/edit_review'; 
          $this->load->view('admin/main', $data);
    }  
 //************************************************************************************ 
          function edit_review_done() 
    {
          $data = $_POST;
        $data["fileimg"] = $_FILES["img"];    
        $data = $this->model_news->edit_review($data);
       header('Location: '.base_url().'manage_news/show_reviews');    
    }
   //*******************************************************************************
 function edit_review_visible($id, $vis) 
    {
        $data=array();
             $data = $this->model_news->edit_review_visible($id, $vis); 
        header('Location: '.base_url().'manage_news/show_reviews'); 
    }
 //*******************************************************************************
 //*******************************************************************************
    function delete_review($id) {
        $this->model_news->delete_review($id) ;
     header('Location: '.base_url().'manage_news/show_reviews');
    }
 //************************************************************************************
    function update_reviews_number() 
    {
         $arr_img =   $_POST; 
          $data = $_POST;
         echo "Порядок новостей сохранён!";
 
      $data = $this->model_news->update_reviews_number($arr_img);
    }
   //********************************************************************************
   
  //************************************************************************************      
  //************************************************************************************      
  //************************************************************************************           
    //************************************************************************************        
    //*********************************************************************************         
  //*******************************************************************************    
  
}
?>