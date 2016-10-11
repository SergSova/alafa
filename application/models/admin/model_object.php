<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Model class
 * @author Ageev Alexey
 * @copyright  2012
 */

class model_object extends CI_Model {
 
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
        
//*************************************************************************************************  
   
//*********************************************************************************
   function edit_catalog_done($data){
         $id = $data['id_ed'];
    $mysql_update = "UPDATE `object_catalogs` SET 
`title-rus` = ".db_quote($data['ed_title-rus']).", 
   `title-eng` = ".db_quote($data['ed_title-eng']).", 
   `title-ukr` = ".db_quote($data['ed_title-ukr']).", 
   `title-hu` = ".db_quote($data['ed_title-hu']).", 
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).", 
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-hu` = ".db_quote($data['ed_descr-hu']).", 
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-hu` = ".db_quote($data['ed_kwd-hu']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-hu` = ".db_quote($data['ed_h1-hu']).",
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_full_text-hu']).",
   `category` = ".db_quote($data['id_category'])." 
           WHERE `id`=$id
            "; 
          //  echo $mysql_update; exit();    
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//************************************************************************************************* 
function edit_object($data){
    $id = $data['id_ed'];
    
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_menu_name-rus']) ;      
   } 
   
      //============================================= 
       $this->edit_url_route('gal_alb', $data['url'], $id);
      //============================================= 
    
    $mysql_update = "UPDATE `object_items` SET 
`title-rus` = ".db_quote($data['ed_title-rus']).", 
   `title-eng` = ".db_quote($data['ed_title-eng']).", 
   `title-ukr` = ".db_quote($data['ed_title-ukr']).", 
   `title-hu` = ".db_quote($data['ed_title-hu']).", 
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).", 
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-hu` = ".db_quote($data['ed_descr-hu']).", 
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-hu` = ".db_quote($data['ed_kwd-hu']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-hu` = ".db_quote($data['ed_h1-hu']).",
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_full_text-hu']).",
   `short_text-rus` = ".db_quote($data['ed_short_text-rus']).",
   `short_text-eng` = ".db_quote($data['ed_short_text-eng']).",
   `short_text-ukr` = ".db_quote($data['ed_short_text-ukr']).",
   `short_text-hu` = ".db_quote($data['ed_short_text-hu']).",
   `category` = ".db_quote($data['id_category']).",
   `priority` = ".db_quote($data['priority']).",
   `url` = ".db_quote($data['url'])." 
           WHERE `id`=$id
            "; 
          //  echo $mysql_update; exit();    
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//*************************************************************************************************   
   function edit_object_category($data){
        $id = $data['id_ed'];
    if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_menu_name-rus']) ;      
   } 
   
      //============================================= 
       $this->edit_url_route('gal_cat', $data['url'], $id);
      //============================================= 
      
        $mysql_update = "UPDATE `object_categories` SET 
   `title-rus` = ".db_quote($data['ed_title-rus']).", 
   `title-eng` = ".db_quote($data['ed_title-eng']).", 
   `title-ukr` = ".db_quote($data['ed_title-ukr']).", 
   `title-hu` = ".db_quote($data['ed_title-hu']).", 
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).", 
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-hu` = ".db_quote($data['ed_descr-hu']).", 
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-hu` = ".db_quote($data['ed_kwd-hu']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-hu` = ".db_quote($data['ed_h1-hu']).",
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_full_text-hu']).",
   `priority` = ".db_quote($data['priority']).",
   `url` = ".db_quote($data['url'])." 
           WHERE `id`=$id
            "; 
          //  echo $mysql_update; exit();     `menu_name` = '".$data['ed_menu_name']."', 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//*********************************************************************************     
    
//**************************************************************************************
    function load_object_categories()
    {
        // query performing 
        $query = "
            SELECT * FROM `object_categories`
            WHERE 1
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data[] =array(
                     'id'      => $row['id'],
                     'visible'      => $row['visible'],
                     'menu_name'   => $row['menu_name-rus'],   
                     'objects'       => $this -> count_same_objects($row['id'])
                   );
             }       // 'catalogs'       => $this -> count_same_catalogs($row['id']), 
        }            // count_same_objects_by_catalog
         return $data;             
    }
 //******************************************************************************************   
 function count_same_catalogs($id) 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `object_catalogs` WHERE `category` = '".$id."'";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];      
   }     
 //*********************************************************************          
  function count_same_objects($id) 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `object_items` WHERE `category` = '".$id."'";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];     
   }      
 //*************************************************************************************** 
  function count_same_objects_by_catalog($id) 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `object_items` WHERE `catalog` = '".$id."'";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];     
   }   
 //**************************************************************************    
   function count_same_photos_objects_by_album($id) 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `object_images` WHERE `object` = '".$id."'";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];      
   }   
 //************************************************************************  
        function add_object_category($data){
  //  print_r($data); exit;         
   
    if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['menu_name-rus']) ;      
   }
   
  $mysql_insert="INSERT INTO `object_categories` ( 
   `h1-rus`,
   `h1-eng`,
   `h1-ukr`,
   `h1-hu`,
   `menu_name-rus`,
   `menu_name-eng`,
   `menu_name-ukr`,
   `menu_name-hu`,
   `title-rus`,
   `title-eng`,
   `title-ukr`,
   `title-hu`,
   `descr-rus`,
   `descr-eng`,
   `descr-ukr`,
   `descr-hu`,
   `kwd-rus`,
   `kwd-eng`,
   `kwd-ukr`,
   `kwd-hu`,
   `text-rus`,
   `text-eng`,
   `text-ukr`,
   `text-hu`,
   `url`
   ) 
         VALUES (
         ".db_quote($data['h1-rus']).",
         ".db_quote($data['h1-eng']).",
         ".db_quote($data['h1-ukr']).",
         ".db_quote($data['h1-hu']).",
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['menu_name-ukr']).",
         ".db_quote($data['menu_name-hu']).",
         ".db_quote($data['title-rus']).",
         ".db_quote($data['title-eng']).",
         ".db_quote($data['title-ukr']).",
         ".db_quote($data['title-hu']).",
         ".db_quote($data['descr-rus']).",
         ".db_quote($data['descr-eng']).",
         ".db_quote($data['descr-ukr']).",
         ".db_quote($data['descr-hu']).",
         ".db_quote($data['kwd-rus']).",
         ".db_quote($data['kwd-eng']).",
         ".db_quote($data['kwd-ukr']).",
         ".db_quote($data['kwd-hu']).",
         ".db_quote($data['full_text-rus']).",
         ".db_quote($data['full_text-eng']).",  
         ".db_quote($data['full_text-ukr']).",
         ".db_quote($data['full_text-hu']).",
         ".db_quote($data['url'])."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
         $add_oc_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('gal_cat', $data['url'], $add_oc_id);
       //============================================= 
         
       $mysql_update = "UPDATE `object_categories` SET 
       `number`         = ".db_quote($add_oc_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`='".$add_oc_id."'
         ";    
       $this->db->query($mysql_update); 
                 
return true;
     }
 //******************************************************************* 
       //************************************************************************  
        function add_catalog($data){
  //  print_r($data); exit;         
   
  $mysql_insert="INSERT INTO `object_catalogs` ( 
   `category`,
   `h1-rus`,
   `h1-eng`,
   `menu_name-rus`,
   `menu_name-eng`,
   `title-rus`,
   `title-eng`,
   `descr-rus`,
   `descr-eng`,
   `kwd-rus`,
   `kwd-eng`,
   `text-rus`,
   `text-eng` ,
   `url`
   ) 
         VALUES (
         ".db_quote($data['id_category']).",
         ".db_quote($data['h1-rus']).",
         ".db_quote($data['h1-eng']).",
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['title-rus']).",
         ".db_quote($data['title-eng']).",
         ".db_quote($data['descr-rus']).",
         ".db_quote($data['descr-eng']).",
         ".db_quote($data['kwd-rus']).",
         ".db_quote($data['kwd-eng']).",
         ".db_quote($data['full_text-rus']).",
         ".db_quote($data['full_text-eng'])." ,
         ".db_quote($data['url'])."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }
 //******************************************************************* 
 //*******************************************************************
    function load_object_catalogs_by_Cat($id)    {
        // query performing 
        $query = "
            SELECT * FROM `object_catalogs`
            WHERE `category` = '".$id."'
             ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data[] =array(
                     'id'      => $row['id'],
                     'visible'      => $row['visible'],
                     'menu_name'   => $row['menu_name-rus'],                       
                     'objects'       => $this -> count_same_objects_by_catalog($row['id'])
                   );
             }
        }
         return $data;             
    }
 //************************************************************************  
   
  
 //***************************************************************************************
   function load_object_Category_Names($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`
               FROM `object_categories`
            WHERE `id` = $id
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data = $row;
                  $data =array(
                     'id'      => $row['id'],           
                     'menu_name'   => $row['menu_name-rus'] 
                   );
             }
        }
         return $data;             
    }
  
  //*****************************************************************************
 
//*******************************************************************
    function update_object_cat_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_categories` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`=$item
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     } 
     //*******************************************************************
    function update_catalogs_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_catalogs` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`=$item
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     } 
 //***************************************************************************************
 function load_object_Cat_foredit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `object_categories`
            WHERE `id` = $id
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
//***********************************************************************************  
function load_catalog_foredit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `object_catalogs`
            WHERE `id` = $id
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
//***********************************************************************************      
 
//****************************************************************
     function edit_catalog_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_catalogs` SET 
  `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
    //****************************************************************
 //****************************************************************
     function edit_object_cat_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_categories` SET 
  `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
    //****************************************************************
  //**************************************************************************************
     
 function delete_object_category($id){
       $sql="DELETE FROM `object_categories` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
         //============================================= 
       $this->delete_url_route('gal_cat', $id);
       //=============================================
    }    
     //***********************************************************************************    
 function delete_catalog($id){
       $sql="DELETE FROM `object_catalogs` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    }                                                                      
 //**************************************************************************************
 //************************************************************************  
        function add_object_photo($data){
 ///////////// - превью и миниатюра - начало --------------------------------------------       
     $thumb = '';
     $big = '';   //имя папки, в которую будем сохранять файлы   $url_name_gal = 'upload/object_images';  
    
 if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
      // if(!empty($data['fileimg']['name']))
// if (isset($_POST['file'])) {
  
    $url_name_gal = 'upload/object_images'; //имя папки, в которую будем сохранять файлы  shop_images
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '900'; //максимальная ширина картинки
    $imgs_height_gal = '0'; // 600
   // $thumb_width_gal = '150'; //ширина для миниатюры
    $thumb_width_gal = '300'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '128M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'img'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$folder_big.$new_filename_big);
    $big = $url_name_gal.$folder_big.$new_filename_big; 
   
    //если ширина картинки превышает максимальную, то уменьшаем картинку до допустимого максимума и сохраняем. 
  if ($size['0']>$imgs_width_gal) { 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_big.''.$new_filename_big, $imgs_width_gal, $imgs_height_gal, '0x000000', '100')){
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
  
 ///////////// - превью и миниатюра - конец --------------------------------------------              
  $mysql_insert="INSERT INTO `object_images` (
   `name-rus`,
   `name-eng`,
   `name-ukr`,
   `name-hu`,
   `preview`,
   `thumb`, 
   `object` 
   ) 
         VALUES (
         ".db_quote($data['name-rus']).",
         ".db_quote($data['name-eng']).",
         ".db_quote($data['name-ukr']).",
         ".db_quote($data['name-hu']).",
         ".db_quote($big).",
         ".db_quote($thumb).",
         ".db_quote($data['object'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
  
  
       $add_object_id = $this->db->insert_id(); 
       $mysql_update = "UPDATE `object_images` SET 
   `number`         = ".db_quote($add_object_id)."
   WHERE `id`= ".$add_object_id." 
            "; 
      
       $this->db->query($mysql_update);
  
                 
return true;
     }
 //*******************************************************************         
//******************************************************************
  function load_objects($id)
    {
        // query performing 
        $query = "
            SELECT * FROM `object_items`
            WHERE `category` =  ".$id." 
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data[] =array(
                     'id'         => $row['id'],
                     'category'   => $row['category'],   
                     'menu_name'  => $row['menu_name-rus'],
                     'number'     => $row['number'],
                     'visible'    => $row['visible'],
                     'picture'    => $this->loadThumbToObject($row['id']),
                     'photos'       => $this ->count_same_photos_objects_by_album($row['id']) 
                                           
                     );    // loadThumbToObject
             }
        }
         return $data;             
    }
 //************************************************************* 
 //******************************************************************
  function load_object_photos($id)
    {
        // query performing 
        $query = "
            SELECT * FROM `object_images`
            WHERE `object` = '".$id."'
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data[] =array(
                     'id'        => $row['id'],        
                     'object'  => $row['object'],
                     'name'  => $row['name-rus'],
                     'thumb'      => $row['thumb'],
                     'number'      => $row['number'],
                     'visible'    => $row['visible']
                                           
                     );
             }
        }
         return $data;             
    }
 //************************************************************* 
 function delete_object($id){
         //  echo $id; exit();
              // query performing   
        $query = "
            SELECT `preview`, `thumb`, `id`
               FROM `object_images`
            WHERE `object` = '".$id."'  
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
       //  return $data; 
     //   print_r($data); exit();
      // $myFile = $data['old_preview'];
      
       foreach ($data as $data) {
        if (isset($data['preview']) && @fopen($data['preview'], "r")){
        unlink($data['preview']);
       }
        if (isset($data['thumb']) && @fopen($data['thumb'], "r")){
        unlink($data['thumb']);
       }
        $sql="DELETE FROM `object_images` WHERE id='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        }    
      
       // return true; 
        } 
         $sql="DELETE FROM `object_items` WHERE id='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        } 
         //============================================= 
       $this->delete_url_route('gal_alb', $id);
       //=============================================                       
       
        return true;
    }         
 //******************************************************************
 function delete_object_photo($id){
     
              // query performing   
        $query = "
            SELECT `preview`, `thumb`, `id`
               FROM `object_images`
            WHERE `id` = '".$id."'  
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
        if (isset($data['thumb']) && @fopen($data['thumb'], "r")){
        unlink($data['thumb']);
       }
                                
       $sql="DELETE FROM `object_images` WHERE `id` ='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    }         
 //******************************************************************
 function loadobject_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `object_items`
            WHERE `id` = '".$id."'  
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
  //*************************************************************************
   function loadObject_by_id($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `object_items`
            WHERE `id` = '".$id."'  
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row;
                $data = array(
                     'id'            => $row['id'],
                     'menu_name'     => $row['menu_name-rus'],
                     'category'     => $this->load_object_Category_Names( $row['category'])      
                     );                                       // load_catalog_for_objects
             }
        }
         return $data;             
    } 
   //******************************************************************
 function loadobject_photo_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `object_images`
            WHERE `id` = '".$id."'  
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
  //*************************************************************************
  function edit_object_photo($data){ 
         $id = $data['id_ed']; 
         //$big = '';
         //$thumb = ''; 
         if(!empty($data['fileimg']['name']) && !empty($data['fileimg']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT `preview`, `thumb`, `id`
                FROM `object_images`
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
    
    $url_name_gal = 'upload/object_images'; //имя папки, в которую будем сохранять файлы
  
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '900'; //максимальная ширина картинки
    $imgs_height_gal = '0'; // 600 
    $thumb_width_gal = '300'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '64M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'img'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$folder_big.$new_filename_big);
    $big = $url_name_gal.$folder_big.$new_filename_big; 
   
    //если ширина картинки превышает максимальную, то уменьшаем картинку до допустимого максимума и сохраняем. 
  if ($size['0']>$imgs_width_gal) { 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_big.''.$new_filename_big, $imgs_width_gal, $imgs_height_gal, '0x000000', '100')){
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
   $mysql_update = "UPDATE `object_images` SET 
   `name-rus`      = ".db_quote($data['ed_name-rus']).",
   `name-eng`      = ".db_quote($data['ed_name-eng']).", 
   `name-ukr`      = ".db_quote($data['ed_name-ukr']).",
   `name-hu`      = ".db_quote($data['ed_name-hu']).", 
   `object`      = ".db_quote($data['object']).",
   `preview`        =  '".$big."',
   `thumb`        =  '".$thumb."'
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
      return $this->db->affected_rows();     
         }
   ////////////////////////////////////////////////     
    else{
    
    $mysql_update = "UPDATE `object_images` SET 
   `name-rus`      = ".db_quote($data['ed_name-rus']).",
   `name-eng`      = ".db_quote($data['ed_name-eng'])." , 
   `name-ukr`      = ".db_quote($data['ed_name-ukr']).",
   `name-hu`      = ".db_quote($data['ed_name-hu'])."
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
    return $this->db->affected_rows();  
    
    }
       
     //   return  true;   
    }
 //*************************************************************
      function edit_object_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_images` SET 
         `visible` = '".$evis."'
            WHERE `id`= '".$id."'
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //************************************************************ 
 function edit_object_photo_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_images` SET 
         `visible` = '".$evis."'
            WHERE `id`= '".$id."'
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //************************************************************ 
  function update_object_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_items` SET 
            `number` = ".db_quote($position)." 
           WHERE `id`='".$item."'
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }       
 //*************************************************** 
 function update_object_photo_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_images` SET 
            `number` = ".db_quote($position)." 
           WHERE `id`='".$item."'
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }       
 //*************************************************** 
   
 function load_catalog_for_objects($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`, `category`
               FROM `object_catalogs`
            WHERE `id` = $id
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data = $row;
                  $data = array(
                     'id'            => $row['id'],
                     'menu_name'     => $row['menu_name-rus'],  
                     'category'      => $this->load_object_Category_Names ($row['category'])       
                     ); 
             }
        }
         return $data;             
    }                                               
       
 //************************************************************************  
function load_Categories_for_add_catalog()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`
               FROM `object_categories`
            WHERE 1
             ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 //  $data[] = $row;
               $data[] = array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus']       
                     );  
             }
        }
         return $data;             
    }
  //************************************************************************  
function load_Catalogs_for_add_object()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`
               FROM `object_catalogs`
            WHERE 1
             ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 //  $data[] = $row;
               $data[] = array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus']       
                     );  
             }
        }
         return $data;             
    }
 //****************************************************************** 
 function loadThumbToObject($id)
    {
        // query performing 
        $query = "
            SELECT `id`, `thumb`, `number`, `visible`, `object` 
            FROM `object_images`
            WHERE `object` = '".$id."'
            AND `visible` = 1
            ORDER BY `number`
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data = array(
                     'id'         => $row['id'],
                     'object'     => $row['object'], 
                     'thumb'      => $row['thumb'],
                     'number'     => $row['number'],
                     'visible'    => $row['visible']                       
                     );
             }         // $this->loadThumbsToAlbum($row['id']) 
        }
         return $data;             
    }
  //****************************************************************** 
     function load_Catalogs_by_IdCategory($category_id)   {
        // query performing 
        $query = "
            SELECT `id`, `menu_name-rus` FROM `object_catalogs`
            WHERE `category` = '".$category_id."'
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'      => $row['id'],
                     'menu_name'   => $row['menu_name-rus']
                   ); 
             }
        }
         return $data;             
    } 
  //***************************************************   
  function add_object($data){
  //  print_r($data); exit;         
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['menu_name-rus']) ;      
   }
   
  $mysql_insert="INSERT INTO `object_items` ( 
   `category`,     
   `h1-rus`,
   `h1-eng`,
   `h1-ukr`,
   `h1-hu`,
   `menu_name-rus`,
   `menu_name-eng`,
   `menu_name-ukr`,
   `menu_name-hu`,
   `title-rus`,
   `title-eng`,
   `title-ukr`,
   `title-hu`,
   `descr-rus`,
   `descr-eng`,
   `descr-ukr`,
   `descr-hu`,
   `kwd-rus`,
   `kwd-eng`,
   `kwd-ukr`,
   `kwd-hu`,
   `text-rus`,
   `text-eng`,
   `text-ukr`,
   `text-hu`,
   `short_text-rus`,
   `short_text-eng`, 
   `short_text-ukr`,
   `short_text-hu`, 
   `url`
   ) 
         VALUES (
         ".db_quote($data['id_category']).",
         ".db_quote($data['h1-rus']).",
         ".db_quote($data['h1-eng']).",
         ".db_quote($data['h1-ukr']).",
         ".db_quote($data['h1-hu']).",
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['menu_name-ukr']).",
         ".db_quote($data['menu_name-hu']).",
         ".db_quote($data['title-rus']).",
         ".db_quote($data['title-eng']).",
         ".db_quote($data['title-ukr']).",
         ".db_quote($data['title-hu']).",
         ".db_quote($data['descr-rus']).",
         ".db_quote($data['descr-eng']).",
         ".db_quote($data['descr-ukr']).",
         ".db_quote($data['descr-hu']).",
         ".db_quote($data['kwd-rus']).",
         ".db_quote($data['kwd-eng']).",
         ".db_quote($data['kwd-ukr']).",
         ".db_quote($data['kwd-hu']).",
         ".db_quote($data['full_text-rus']).",
         ".db_quote($data['full_text-eng']).",  
         ".db_quote($data['full_text-ukr']).",
         ".db_quote($data['full_text-hu']).",
         ".db_quote($data['short_text-rus']).",
         ".db_quote($data['short_text-eng'])." ,
         ".db_quote($data['short_text-ukr']).",
         ".db_quote($data['short_text-hu']).", 
         ".db_quote($data['url'])."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        $add_photo_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('gal_alb', $data['url'], $add_photo_id);
       //============================================= 
         
       $mysql_update = "UPDATE `object_items` SET 
       `number`         = ".db_quote($add_photo_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`='".$add_photo_id."'
         ";    
       $this->db->query($mysql_update); 
                 
return true;
     }      
 //******************************************************************   
  //****************************************************************** 
     function load_Object_by_IdCategory($category_id)   {
        // query performing 
        $query = "
            SELECT `id`, `menu_name-rus`, `url` FROM `object_items`
            WHERE `category` =  ".$category_id." 
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) { 
                $data[] =array(
                     'id'      => $row['id'],
                     'url'           => $row['url'], 
                     'menu_name'   => $row['menu_name-rus']
                   ); 
             }
        }
         return $data;             
    } 
  //***************************************************  
  function loadCategoriesAll()
    {
        // query performing 
        $query = "
            SELECT `id`, `priority`,  `url` FROM `object_categories`
            WHERE `visible` = 1
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data[] =array(
                     'id'      => $row['id'], 
                     'url'           => $row['url'],
                     'priority'      => $row['priority'],                   
                     'albums'  => $this -> load_Object_by_IdCategory($row['id'])
                   );
             }       // 'catalogs'       => $this -> count_same_catalogs($row['id']), 
        }            // count_same_objects_by_catalog
         return $data;             
    }
//************************************************************************  
//******************************************************************* 
function add_new_url_route($ctype, $url, $id_data){  
   $mysql_insert="INSERT INTO `url_routing` (   
           `ctype`,  
           `url` ,
           `id_data`
           ) 
         VALUES (      
         ".db_quote($ctype).",
         ".db_quote($url).",
         ".db_quote($id_data)."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
       $rd_id = $this->db->insert_id();
       return $rd_id;
}
//******************************************************************* 
function edit_url_route($ctype, $url, $id_data){  

$mysql_update = "UPDATE `url_routing` SET 
   `url` = ".db_quote($url)."  
  WHERE `ctype` = '".$ctype."' AND `id_data` = '".$id_data."'
    ";      
                                                           
    $this->db->query($mysql_update);
    return true;
}
//*******************************************************************    
//*******************************************************************  
   function delete_url_route($ctype, $id_data){
       $sql="DELETE FROM `url_routing` WHERE 
       `ctype`='".$id."'
       AND `id_data`='".$id_data."'
       ";
        if (!mysql_query($sql)) {                        
            return false;
        }
        
        return true;
   }
//******************************************************************* 
 //***************************************************   
  function add_videoalbum($data){
  //  print_r($data); exit;         
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['menu_name-rus']) ;      
   }
   
  $mysql_insert="INSERT INTO `object_items` (  
   `h1-rus`,
   `h1-eng`,
   `h1-ukr`,
   `h1-hu`,
   `menu_name-rus`,
   `menu_name-eng`,
   `menu_name-ukr`,
   `menu_name-hu`,
   `title-rus`,
   `title-eng`,
   `title-ukr`,
   `title-hu`,
   `descr-rus`,
   `descr-eng`,
   `descr-ukr`,
   `descr-hu`,
   `kwd-rus`,
   `kwd-eng`,
   `kwd-ukr`,
   `kwd-hu`,
   `text-rus`,
   `text-eng`,
   `text-ukr`,
   `text-hu`,
   `short_text-rus`,
   `short_text-eng`, 
   `short_text-ukr`,
   `short_text-hu`, 
   `url`
   ) 
         VALUES ( 
         ".db_quote($data['h1-rus']).",
         ".db_quote($data['h1-eng']).",
         ".db_quote($data['h1-ukr']).",
         ".db_quote($data['h1-hu']).",
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['menu_name-ukr']).",
         ".db_quote($data['menu_name-hu']).",
         ".db_quote($data['title-rus']).",
         ".db_quote($data['title-eng']).",
         ".db_quote($data['title-ukr']).",
         ".db_quote($data['title-hu']).",
         ".db_quote($data['descr-rus']).",
         ".db_quote($data['descr-eng']).",
         ".db_quote($data['descr-ukr']).",
         ".db_quote($data['descr-hu']).",
         ".db_quote($data['kwd-rus']).",
         ".db_quote($data['kwd-eng']).",
         ".db_quote($data['kwd-ukr']).",
         ".db_quote($data['kwd-hu']).",
         ".db_quote($data['full_text-rus']).",
         ".db_quote($data['full_text-eng']).",  
         ".db_quote($data['full_text-ukr']).",
         ".db_quote($data['full_text-hu']).",
         ".db_quote($data['short_text-rus']).",
         ".db_quote($data['short_text-eng'])." ,
         ".db_quote($data['short_text-ukr']).",
         ".db_quote($data['short_text-hu']).", 
         ".db_quote($data['url'])."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        $add_photo_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('gal_alb', $data['url'], $add_photo_id);
       //============================================= 
         
       $mysql_update = "UPDATE `object_items` SET 
       `number`         = ".db_quote($add_photo_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`= ".$add_photo_id." 
         ";    
       $this->db->query($mysql_update); 
                 
return true;
     }      
 //******************************************************************  
 //************************************************************* 
 function delete_videoalbum($id){
         //  echo $id; exit();
              // query performing   
        $query = "
            SELECT `preview`, `thumb`, `id`
               FROM `object_images`
            WHERE `object` =  ".$id."  
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
       //  return $data; 
     //   print_r($data); exit();
      // $myFile = $data['old_preview'];
      
       foreach ($data as $data) {
        if (isset($data['preview']) && @fopen($data['preview'], "r")){
        unlink($data['preview']);
       }
        if (isset($data['thumb']) && @fopen($data['thumb'], "r")){
        unlink($data['thumb']);
       }
        $sql="DELETE FROM `object_images` WHERE id='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        }    
      
       // return true; 
        } 
         $sql="DELETE FROM `object_items` WHERE id='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        } 
         //============================================= 
       $this->delete_url_route('gal_alb', $id);
       //=============================================                       
       
        return true;
    }         
 //******************************************************************
 //************************************************************************************************* 
function edit_videoalbum($data){
    $id = $data['id_ed'];
    
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_menu_name-rus']) ;      
   } 
   
      //============================================= 
       $this->edit_url_route('gal_alb', $data['url'], $id);
      //============================================= 
    
    $mysql_update = "UPDATE `object_items` SET 
`title-rus` = ".db_quote($data['ed_title-rus']).", 
   `title-eng` = ".db_quote($data['ed_title-eng']).", 
   `title-ukr` = ".db_quote($data['ed_title-ukr']).", 
   `title-hu` = ".db_quote($data['ed_title-hu']).", 
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).", 
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-hu` = ".db_quote($data['ed_descr-hu']).", 
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-hu` = ".db_quote($data['ed_kwd-hu']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-hu` = ".db_quote($data['ed_h1-hu']).",
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_full_text-hu']).",
   `short_text-rus` = ".db_quote($data['ed_short_text-rus']).",
   `short_text-eng` = ".db_quote($data['ed_short_text-eng']).",
   `short_text-ukr` = ".db_quote($data['ed_short_text-ukr']).",
   `short_text-hu` = ".db_quote($data['ed_short_text-hu']).", 
   `priority` = ".db_quote($data['priority']).",
   `url` = ".db_quote($data['url'])." 
           WHERE `id`=$id
            "; 
          //  echo $mysql_update; exit();    
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//*************************************************************************************************          
//******************************************************************
  function load_videoalbums($id)
    {
        // query performing 
        $query = "
            SELECT * FROM `object_items`
            WHERE `category` =  ".$id." 
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data[] =array(
                     'id'         => $row['id'],   
                     'menu_name'  => $row['menu_name-rus'],
                     'number'     => $row['number'],
                     'visible'    => $row['visible'],
                     'picture'    => $this->loadThumbTovideoalbum($row['id']),
                     'photos'       => $this ->count_same_photos_videoalbums_by_album($row['id']) 
                                           
                     );    // loadThumbTovideoalbum
             }
        }
         return $data;             
    }
 //************************************************************* 
 
 //************************************************************ 
  function update_videoalbum_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_items` SET 
            `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }       
 //*************************************************** 
  //*************************************************************
      function edit_videoalbum_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_images` SET 
         `visible` = '".$evis."'
            WHERE `id`=  ".$id." 
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //************************************************************ 
 //************************************************************************  
        function add_videoalbum_photo($data){
 ///////////// - превью и миниатюра - начало --------------------------------------------       
     $thumb = '';
     $big = '';   //имя папки, в которую будем сохранять файлы   $url_name_gal = 'upload/object_images';  
    
 if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
      // if(!empty($data['fileimg']['name']))
// if (isset($_POST['file'])) {
  
    $url_name_gal = 'upload/object_images'; //имя папки, в которую будем сохранять файлы  shop_images
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '900'; //максимальная ширина картинки
    $imgs_height_gal = '0'; // 600
   // $thumb_width_gal = '150'; //ширина для миниатюры
    $thumb_width_gal = '300'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '128M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'img'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$folder_big.$new_filename_big);
    $big = $url_name_gal.$folder_big.$new_filename_big; 
   
    //если ширина картинки превышает максимальную, то уменьшаем картинку до допустимого максимума и сохраняем. 
  if ($size['0']>$imgs_width_gal) { 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_big.''.$new_filename_big, $imgs_width_gal, $imgs_height_gal, '0x000000', '100')){
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
  
 ///////////// - превью и миниатюра - конец --------------------------------------------              
  $mysql_insert="INSERT INTO `object_images` (
   `name-rus`,
   `name-eng`,
   `name-ukr`,
   `name-hu`,
   `preview`,
   `thumb`, 
   `object` 
   ) 
         VALUES (
         ".db_quote($data['name-rus']).",
         ".db_quote($data['name-eng']).",
         ".db_quote($data['name-ukr']).",
         ".db_quote($data['name-hu']).",
         ".db_quote($big).",
         ".db_quote($thumb).",
         ".db_quote($data['object'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
  
  
       $add_videoalbum_id = $this->db->insert_id(); 
       $mysql_update = "UPDATE `object_images` SET 
   `number`         = ".db_quote($add_videoalbum_id)."
   WHERE `id`= ".$add_videoalbum_id." 
            "; 
      
       $this->db->query($mysql_update);
  
                 
return true;
     }
 //*******************************************************************   
 
 //******************************************************************
 function delete_videoalbum_photo($id){
     
              // query performing   
        $query = "
            SELECT `preview`, `thumb`, `id`
               FROM `object_images`
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
        if (isset($data['thumb']) && @fopen($data['thumb'], "r")){
        unlink($data['thumb']);
       }
                                
       $sql="DELETE FROM `object_images` WHERE `id` = ".$id." ";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    }         
 //******************************************************************
 
  //*************************************************************************
  function edit_videoalbum_photo($data){ 
         $id = $data['id_ed']; 
         //$big = '';
         //$thumb = ''; 
         if(!empty($data['fileimg']['name']) && !empty($data['fileimg']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT `preview`, `thumb`, `id`
                FROM `object_images`
                WHERE `id` =  ".$id."  
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
    
    $url_name_gal = 'upload/object_images'; //имя папки, в которую будем сохранять файлы
  
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '900'; //максимальная ширина картинки
    $imgs_height_gal = '0'; // 600 
    $thumb_width_gal = '300'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '64M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'img'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
    copy($file, $url_name_gal.$folder_big.$new_filename_big);
    $big = $url_name_gal.$folder_big.$new_filename_big; 
   
    //если ширина картинки превышает максимальную, то уменьшаем картинку до допустимого максимума и сохраняем. 
  if ($size['0']>$imgs_width_gal) { 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_big.''.$new_filename_big, $imgs_width_gal, $imgs_height_gal, '0x000000', '100')){
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
   $mysql_update = "UPDATE `object_images` SET 
   `name-rus`      = ".db_quote($data['ed_name-rus']).",
   `name-eng`      = ".db_quote($data['ed_name-eng']).", 
   `name-ukr`      = ".db_quote($data['ed_name-ukr']).",
   `name-hu`      = ".db_quote($data['ed_name-hu']).", 
   `object`      = ".db_quote($data['object']).",
   `preview`        =  '".$big."',
   `thumb`        =  '".$thumb."'
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
      return $this->db->affected_rows();     
         }
   ////////////////////////////////////////////////     
    else{
    
    $mysql_update = "UPDATE `object_images` SET 
   `name-rus`      = ".db_quote($data['ed_name-rus']).",
   `name-eng`      = ".db_quote($data['ed_name-eng'])." , 
   `name-ukr`      = ".db_quote($data['ed_name-ukr']).",
   `name-hu`      = ".db_quote($data['ed_name-hu'])."
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
    return $this->db->affected_rows();  
    
    }
       
     //   return  true;   
    }
 //*************************************************************
 function edit_videoalbum_photo_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_images` SET 
         `visible` = '".$evis."'
            WHERE `id`=  ".$id." 
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //************************************************************ 
 //******************************************************************
  function load_videoalbum_photos($id)
    {
        // query performing 
        $query = "
            SELECT * FROM `object_images`
            WHERE `videoalbum` = '".$id."'
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data[] =array(
                     'id'        => $row['id'],        
                     'object'  => $row['object'],
                     'name'  => $row['name-rus'],
                     'thumb'      => $row['thumb'],
                     'number'      => $row['number'],
                     'visible'    => $row['visible']
                                           
                     );
             }
        }
         return $data;             
    }
 //************************************************************* 
  //*************************************************** 
 function update_videoalbum_photo_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_images` SET 
            `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }       
 //*************************************************** 
 
  function load_videos( )
    {
        // query performing 
        $query = "
            SELECT * FROM `object_videos`
            WHERE 1
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data[] =array(
                     'id'        => $row['id'],        
                     'object'  => $row['object'],
                     'name'  => $row['name-rus'],
                     'thumb'      => $row['thumb'],
                     'number'      => $row['number'],
                     'visible'    => $row['visible']
                                           
                     );
             }
        }
         return $data;             
    }
 //************************************************************* 
  //*************************************************** 
 function update_video_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `object_videos` SET 
            `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }       
 //*************************************************** 
 
  //*************************************************************************
  function edit_video($data){ 
         $id = $data['id_ed']; 
         
   // if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_name-rus']) ;      
  // } 
      //============================================= 
       $this->edit_url_route('video', $data['url'], $id);
      //============================================= 
    
         //$big = '';
         //$thumb = ''; 
         if(!empty($data['fileimg']['name']) && !empty($data['fileimg']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT  `thumb`, `id`
                FROM `object_videos`
                WHERE `id` =  ".$id."  
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
   
        if (isset($dataedit['thumb']) && @fopen($dataedit['thumb'], "r")){
        unlink($dataedit['thumb']);
       }
    
    $url_name_gal = 'upload/object_videos'; //имя папки, в которую будем сохранять файлы
  
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '900'; //максимальная ширина картинки
    $imgs_height_gal = '0'; // 600 
    $thumb_width_gal = '300'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '64M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'img'.time().'.'.$format; //генерируем новое имя файла
 
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
     
  //  }  
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
        //////////////////************//////////////////  
   $mysql_update = "UPDATE `object_videos` SET 
   `name-rus`      = ".db_quote($data['ed_name-rus']).",
   `name-eng`      = ".db_quote($data['ed_name-eng']).", 
   `name-ukr`      = ".db_quote($data['ed_name-ukr']).",
   `name-hu`      = ".db_quote($data['ed_name-hu']).", 
   `video`      = ".db_quote($data['video']).", 
   `object`      = ".db_quote($data['object']).", 
   `url`      = ".db_quote($data['url']).", 
   `thumb`        =  '".$thumb."'
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
      return $this->db->affected_rows();     
         }
   ////////////////////////////////////////////////     
    else{
    
    $mysql_update = "UPDATE `object_videos` SET 
   `name-rus`      = ".db_quote($data['ed_name-rus']).",
   `name-eng`      = ".db_quote($data['ed_name-eng'])." , 
   `name-ukr`      = ".db_quote($data['ed_name-ukr']).",
   `name-hu`      = ".db_quote($data['ed_name-hu']).",
   `url`      = ".db_quote($data['url']).", 
   `video`      = ".db_quote($data['video'])."
    WHERE `id`= ".$id." 
    "; 
     $res = $this->db->query($mysql_update);
    return $this->db->affected_rows();  
    
    }
       
     //   return  true;   
    }
 //*************************************************************
 function edit_video_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `object_videos` SET 
         `visible` = '".$evis."'
            WHERE `id`=  ".$id." 
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //************************************************************ 
 
 //******************************************************************
 function delete_video($id){
     
              // query performing   
        $query = "
            SELECT   `thumb`, `id`
               FROM `object_videos`
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
      
   
        if (isset($data['thumb']) && @fopen($data['thumb'], "r")){
        unlink($data['thumb']);
       }
                                
       $sql="DELETE FROM `object_videos` WHERE `id` = ".$id." ";
        if (!mysql_query($sql)) {
            return false;
        }
        
                 //============================================= 
       $this->delete_url_route('video', $id);
       //=============================================   
        
        
        return true;
    }         
 //******************************************************************
 
 
 //************************************************************************  
        function add_video($data){
            
  //  if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['name-rus']) ;      
 //  }
 ///////////// - превью и миниатюра - начало --------------------------------------------       
     $thumb = '';
     $big = '';   //имя папки, в которую будем сохранять файлы   $url_name_gal = 'upload/object_videos';  
    
 if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
      // if(!empty($data['fileimg']['name']))
// if (isset($_POST['file'])) {
  
    $url_name_gal = 'upload/object_videos'; //имя папки, в которую будем сохранять файлы  shop_images
    $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    $imgs_width_gal = '900'; //максимальная ширина картинки
    $imgs_height_gal = '0'; // 600
   // $thumb_width_gal = '150'; //ширина для миниатюры
    $thumb_width_gal = '300'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '128M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']); //получаем массив значений размеров картинкии  её расширения
    
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime; //если mime jpeg, то он будет записан как файл .jpg
    $new_filename = 'img'.time().'.'.$format; //генерируем новое имя файла
    $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
 
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
}                    
  
 ///////////// - превью и миниатюра - конец --------------------------------------------              
  $mysql_insert="INSERT INTO `object_videos` (
   `name-rus`,
   `name-eng`,
   `name-ukr`,
   `name-hu`,
   `video`,
   `thumb`, 
   `object` ,
   `url`
   ) 
         VALUES (
         ".db_quote($data['name-rus']).",
         ".db_quote($data['name-eng']).",
         ".db_quote($data['name-ukr']).",
         ".db_quote($data['name-hu']).",
         ".db_quote($data['video']).",
         ".db_quote($thumb).",
         ".db_quote($data['object'])." ,
         ".db_quote($data['url'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
  
  /*
       $add_videoalbum_id = $this->db->insert_id(); 
       $mysql_update = "UPDATE `object_videos` SET 
   `number`         = ".db_quote($add_videoalbum_id)."
   WHERE `id`= ".$add_videoalbum_id." 
            "; 
      
       $this->db->query($mysql_update);
  */
   $add_photo_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('video', $data['url'], $add_photo_id);
       //============================================= 
         
       $mysql_update = "UPDATE `object_videos` SET 
       `number`         = ".db_quote($add_photo_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`='".$add_photo_id."'
         ";    
       $this->db->query($mysql_update); 
                 
                 
return true;
     }
 //*******************************************************************   
  //******************************************************************
 function loadvideo_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `object_videos`
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
  //*************************************************************************
 
//************************************************************************    
//*******************************************************************
}
?>