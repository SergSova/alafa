<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *   Model class
 * @author Ageev Alexey
 * @copyright  2014
 */

class model_slides extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
     
 //**************************************************************************************
    function loadslides()
    {
        // query performing 
        $query = "
            SELECT
              `id`,
            `menu_name-rus`, 
            `preview`,
            `visible`
             FROM `slides`
            WHERE 1
            ORDER BY `number`
        ";               // number
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                 $data[] =array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus'], 
                     'preview'      => $row['preview'],   
                     'visible'      => $row['visible']       
                      ) ;
             }
        }
         return $data;             
    }
//************************************************************************  
         
   //******************************************************************* 
     
 function loadslide_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * 
            FROM `slides`
            WHERE `id` = ".$id."   
        ";
        /*  `id`,  
            `text`,   
            `menu_name-rus`,
            `url`,  
            `visible`,
            `preview` */
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row;
                 /* $data[] =array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus'], 
                     'preview'      => $row['preview'],   
                     'visible'      => $row['visible']       
                      ) ; */
             }
        }
         return $data;             
    } 
 //**************************************************************************************
  function update_slide_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `slides` SET 
          `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }
//**********************************************************************
      
   
 //*************************************************************
 function add_slide($data){
 ///////////// - превью и миниатюра - начало --------------------------------------------       
       if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
           
      // if(!empty($data['fileimg']['name']))
// if (isset($_POST['file'])) {
  
    $url_name_gal = 'upload/slides'; //имя папки, в которую будем сохранять файлы  shop_images
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '600'; //максимальная ширина картинки
    $imgs_height_gal = '400'; // 600 
    $thumb_width_gal = '100'; //ширина для миниатюры     
    $thumb_height_gal = '65'; //высота для миниатюры
    ini_set('memory_limit', '128M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
    
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'slide'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$folder_big.$new_filename_big);
    $big = $url_name_gal.$folder_big.$new_filename_big; 
   
    //если ширина картинки превышает максимальную, то уменьшаем картинку до допустимого максимума и сохраняем. 
  if ($size['0']>$imgs_width_gal) { 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_big.''.$new_filename_big, $imgs_width_gal, $imgs_height_gal, '0x000000', '90')){
         $big = $url_name_gal.$folder_big.$new_filename_big;
    }
       
    }  
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
        
}   
 else{
   $big = '';
  // $image = '';
   $thumb = '';
 }   
  

   
 ///////////// - превью и миниатюра - конец --------------------------------------------              
  $mysql_insert="INSERT INTO `slides` (     
   `menu_name-rus`,  
   `menu_name-eng`,
   `menu_name-ukr`,  
   `menu_name-hu`,  
   `thumb`,       
   `preview` 
   ) 
         VALUES (                            
         ".db_quote($data['menu_name-rus']).", 
         ".db_quote($data['menu_name-eng']).", 
         ".db_quote($data['menu_name-ukr']).", 
         ".db_quote($data['menu_name-hu']).", 
         ".db_quote($thumb).",  
         ".db_quote($big)." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);           
        $add_photo_id = $this->db->insert_id();
                                                            
         
       $mysql_update = "UPDATE `slides` SET 
       `number`         = ".db_quote($add_photo_id)." 
       WHERE `id`= ".$add_photo_id." 
         ";    
       $this->db->query($mysql_update); 
      
        
         return $this->db->affected_rows();
                                                     
//return true;
     }   
 //************************************************************* 
 function delete_slide($id){
     
              // query performing   
        $query = "
            SELECT `preview`,  `thumb`, `id`
               FROM `slides`
            WHERE `id` = ".$id."  
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row;
             }
        }
       //  return $data; 
     //   print_r($data); exit();
      // $myFile = $data['old_preview'];
      
        if (isset($data['thumb']) && @fopen($data['thumb'], "r")){
        unlink($data['thumb']);
       }
        if (isset($data['preview']) && @fopen($data['preview'], "r")){
        unlink($data['preview']);
       }
       
       
       $sql="DELETE FROM `slides` WHERE id= ".$id." ";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
       
    }         
  
  //*************************************************************************
  
 //*************************************************************
  function edit_slide($data){ 
          $id = $data['id_ed']; 
         //$big = '';
         //$thumb = ''; 
         if(!empty($data['fileimg']['name']) && !empty($data['fileimg']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT `preview`, `thumb`, `id`
                FROM `slides`
                WHERE `id` = '".$id."'  
                 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $dataedit = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $dataedit = $row;
             }
        }
  
        if (isset($dataedit['preview']) && @fopen($dataedit['preview'], "r")){
        unlink($dataedit['preview']);
       }
        if (isset($dataedit['thumb']) && @fopen($dataedit['thumb'], "r")){
        unlink($dataedit['thumb']);
       }
    
    $url_name_gal = 'upload/slides'; //имя папки, в которую будем сохранять файлы
  
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '600'; //максимальная ширина картинки
    $imgs_height_gal = '400'; // 600 
    $thumb_width_gal = '100'; //ширина для миниатюры     
    $thumb_height_gal = '65'; //высота для миниатюры
    ini_set('memory_limit', '128M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
   
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'slide'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$folder_big.$new_filename_big);
    $big = $url_name_gal.$folder_big.$new_filename_big; 
   
    //если ширина картинки превышает максимальную, то уменьшаем картинку до допустимого максимума и сохраняем. 
  if ($size['0']>$imgs_width_gal) { 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_big.''.$new_filename_big, $imgs_width_gal, $imgs_height_gal, '0x000000', '90')){
         $big = $url_name_gal.$folder_big.$new_filename_big;
    }
       
    }  
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
        //////////////////************//////////////////  
   $mysql_update = "UPDATE `slides` SET 
   `menu_name-rus`      = ".db_quote($data['menu_name-rus']).",
   `menu_name-eng`      = ".db_quote($data['menu_name-eng']).",  
   `menu_name-ukr`      = ".db_quote($data['menu_name-ukr']).",  
   `menu_name-hu`      = ".db_quote($data['menu_name-hu']).",  
   `preview`        =  '".$big."',
   `thumb`        =  '".$thumb."'
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
      return $this->db->affected_rows();     
         }
   ////////////////////////////////////////////////     
    else{
    
    $mysql_update = "UPDATE `slides` SET 
   `menu_name-rus`      = ".db_quote($data['menu_name-rus']).",
   `menu_name-eng`      = ".db_quote($data['menu_name-eng'])." , 
   `menu_name-ukr`      = ".db_quote($data['menu_name-ukr']).",  
   `menu_name-hu`      = ".db_quote($data['menu_name-hu'])."
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
    return $this->db->affected_rows();  
    
    }
       
       
  }      
 //**************************************************************************************
   
function edit_slide_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}            
        $mysql_update = "UPDATE `slides` SET 
        `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //*******************************************************************    
 function loadslides_all()
    {
        // query performing 
        $query = "
            SELECT
              `id`,
            `menu_name`,
            `visible`
             FROM `sliders_base`
            WHERE 1
            ORDER BY `number`
        ";               // number
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                 $data[] =array(
                     'id'           => $row['id'],
                     'menu_name'    => $row['menu_name'], 
                     'visible'      => $row['visible']       
                      ) ;
             }
        }
         return $data;             
    }
//************************************************************************  
function loadsliders_for_add()
    {
        // query performing 
        $query = "
            SELECT
              `id`,
            `menu_name`,
            `visible`
             FROM `sliders_base`
            WHERE 1
            ORDER BY `number`
        ";               // number
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                 $data[] =array(
                     'id'           => $row['id'],
                     'menu_name'    => $row['menu_name'], 
                     'visible'      => $row['visible']       
                      ) ;
             }
        }
         return $data;             
    }
//************************************************************************  
  function add_slider($data){                                                                           
  $mysql_insert="INSERT INTO `sliders_base` (     
   `menu_name` 
   ) 
         VALUES (                            
         ".db_quote($data['menu_name'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);           
        $add_photo_id = $this->db->insert_id();
                                                            
         
       $mysql_update = "UPDATE `sliders_base` SET 
       `number`         = ".db_quote($add_photo_id)." 
       WHERE `id`= ".$add_photo_id." 
         ";    
       $this->db->query($mysql_update); 
      
        
         return $this->db->affected_rows();
                                                     
//return true;
     }   
 //*************************************************************      
 function edit_slider($data){ 
       $id = $data['id_ed'];  
                            
       $mysql_update = "UPDATE `sliders_base` SET       
   `menu_name` = ".db_quote($data['ed_menu_name'])." 
    WHERE `id`= ".$id." 
    ";      
     
   ////////////////////////////////////////////////     
    $res = $this->db->query($mysql_update);
      return $this->db->affected_rows();      
   // } 
  }        
//*******************************************************************   
function edit_slider_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}            
        $mysql_update = "UPDATE `sliders_base` SET 
        `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//******************************************************************* 
function delete_slider($id){
  
       
       $sql="DELETE FROM `sliders_base` WHERE id= ".$id." ";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
       
    }         
  
  //*************************************************************************
 function loadslider_foredit($id)
    {
         // query performing   
        $query = "
            SELECT 
            `id`,       
            `menu_name`,  
            `visible` 
            FROM `sliders_base`
            WHERE `id` =  ".$id."   
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row;
             }
        }
         return $data;             
    }  
//******************************************************************* 
function update_slider_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `sliders_base` SET 
          `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }
//**********************************************************************
    
function loadSliderName($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name`
               FROM `sliders_base`
            WHERE `id` =  ".$id."  
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                   $data = $row;  
             }
        }
         return $data;             
    }
//***********************************************************************    
function loadslides_by_slider($id)
    {
        // query performing 
        $query = "
            SELECT
            `id`,
            `menu_name`, 
            `url`,   
            `preview`,
            `visible`
             FROM `sliders_items`
            WHERE `slider` = ".$id."
            ORDER BY `number`
        ";               // number
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                 $data[] =array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name'], 
                     'url'      => $row['url'],
                     'preview'      => $row['preview'],   
                     'visible'      => $row['visible']       
                      ) ;
             }
        }
         return $data;             
    }
//******************************************************************* 
function add_slide_by_slider($data){
 ///////////// - превью и миниатюра - начало --------------------------------------------       
       if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
 
  
    $url_name_gal = 'upload/slides/'; //имя папки, в которую будем сохранять файлы
    
    $imgs_height_gal = '300';
  
    ini_set('memory_limit', '64M');  
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); 
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime;  
    $new_filename = 'img_'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'slide_'.$new_filename;
  //  $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$new_filename_big);
    $big = $url_name_gal.$new_filename_big; 
                                        
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
}   
 else{
   $big = '';
  // $image = '';
  // $thumb = '';
 }   
  

   
 ///////////// - превью и миниатюра - конец --------------------------------------------              
  $mysql_insert="INSERT INTO `sliders_items` (     
   `menu_name`, 
   `slider`, 
   `url`,  
   `text`,       
   `preview` 
   ) 
         VALUES (                            
         ".db_quote($data['menu_name']).", 
         ".db_quote($data['slider']).", 
         ".db_quote($data['url']).", 
         ".db_quote($data['text']).",  
         ".db_quote($big)." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);           
        $add_photo_id = $this->db->insert_id();
                                                            
         
       $mysql_update = "UPDATE `sliders_items` SET 
       `number`         = ".db_quote($add_photo_id)." 
       WHERE `id`= ".$add_photo_id." 
         ";    
       $this->db->query($mysql_update); 
      
        
         return $this->db->affected_rows();
                                                     
//return true;
     }   
 //************************************************************* 
 function edit_slide_by_slider($data){ 
         $id = $data['id_ed'];  
         
                          
          if(!empty($data['fileimg']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT `preview`, `id`
                FROM `sliders_items`
                WHERE `id` =  ".$id." 
                 ";
       // echo  $query; exit(); 
        $dbres = $this->db->query($query);
         $dataedit = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $dataedit = $row;
             }
        }
  
        if (isset($dataedit['preview']) && @fopen($dataedit['preview'], "r")){
        unlink($dataedit['preview']);
       }
        
    
  
 $url_name_gal = 'upload/slides/'; 
    $imgs_height_gal = '300';                                
    ini_set('memory_limit', '64M');
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); 
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }                                    
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; 
    $new_filename = 'img_'.time().'.'.$format;
    $new_filename_big = 'slide_'.$new_filename;      
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$new_filename_big);
    $big = $url_name_gal.$new_filename_big; 
 
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
        //////////////////************//////////////////  
  
        
   $mysql_update = "UPDATE `sliders_items` SET           
   `menu_name` = ".db_quote($data['ed_menu_name']).", 
   `slider` = ".db_quote($data['slider']).",
   `url` = ".db_quote($data['url']).",    
   `text` = ".db_quote($data['ed_text']).",  
   `preview`      =  '".$big."'  
    WHERE `id`= ".$id." 
    "; 
      
         }
         else {
       $mysql_update = "UPDATE `sliders_items` SET       
   `menu_name` = ".db_quote($data['ed_menu_name']).",
   `slider` = ".db_quote($data['slider']).", 
   `url` = ".db_quote($data['url']).",    
   `text` = ".db_quote($data['ed_text'])."    
    WHERE `id`= ".$id." 
    ";      
         }
   ////////////////////////////////////////////////     
    $res = $this->db->query($mysql_update);
      return $this->db->affected_rows();      
   // } 
  }      
 //**************************************************************************************
 function delete_slide_by_slider($id){
     
              // query performing   
        $query = "
            SELECT `preview`, `id`
               FROM `sliders_items`
            WHERE `id` =  ".$id."   
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row;
             }
        }
       //  return $data; 
       //   print_r($data); exit();
       // $myFile = $data['old_preview'];
      
        if (isset($data['preview']) && @fopen($data['preview'], "r")){
        unlink($data['preview']);
       }
               
       $sql="DELETE FROM `sliders_items` WHERE id= ".$id." ";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
       
    }         
  
  //*************************************************************************
 function update_slide_number_by_slider($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `sliders_items` SET 
          `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }
//**********************************************************************
      
 function loadslide_by_slider_foredit($id)
    {
         // query performing   
        $query = "
            SELECT *
            FROM `sliders_items`
            WHERE `id` =  ".$id."   
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row;
             }
        }
         return $data;             
    }    
//*******************************************************************  
function edit_slide_by_slider_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}            
        $mysql_update = "UPDATE `sliders_items` SET 
        `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //*******************************************************************  
//******************************************************************* 
//******************************************************************* 
//*******************************************************************   
//******************************************************************* 
//*******************************************************************
//*******************************************************************   
//******************************************************************* 
//*******************************************************************
}
?>