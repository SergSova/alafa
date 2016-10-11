<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Model class
 * @author Ageev Alexey
 * @copyright  2012
 */

class model_filters extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
  
  function loadValues($id)
    {
        // query performing 
        $query = "
            SELECT `id`, `menu_name-rus`,  `visible`, `preview`, `parent` FROM `filters_values`
            WHERE `parent` = '".$id."'
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
                     'id'                => $row['id'],
                     'menu_name'         => $row['menu_name-rus'],    
                     'visible'           => $row['visible'],
                     'preview'           => $row['preview'], 
                     'parent'   => $this->loadfilterName($row['parent'])  
                     );
             }
        }
         return $data;             
    }
//************************************************************************ 
function loadValues_names($id)
    {
        // query performing 
        $query = "
            SELECT `id`, `menu_name-rus`, `parent` FROM `filters_values`
            WHERE `parent` = '".$id."'
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
                     'id'                => $row['id'],
                     'menu_name'         => $row['menu_name-rus'] 
                     );
             }
        }
         return $data;             
    }
//************************************************************************   
        function add_filter_value($data){
  //  print_r($data); exit;
  $thumb=""; 
      if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
 
  
    $url_name_gal = 'upload/images'; //имя папки, в которую будем сохранять файлы
  //  $folder_big = '/big/';
    $folder_thumbs = '/thumbs/';
    //$imgs_width_gal = '500'; //максимальная ширина картинки
    // $imgs_height_gal = '500';
   // $thumb_width_gal = '150'; //ширина для миниатюры
    $thumb_width_gal = '0'; //ширина для миниатюры     
    $thumb_height_gal = '150'; //высота для миниатюры
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
   // $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
   // copy($file, $url_name_gal.$folder_big.$new_filename_big);
    
   // $big = $url_name_gal.$folder_big.$new_filename_big; 
    
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '100')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb;
      //   echo  $thumb; exit();  
   // echo 'Создание миниатюры произведено успешно - '.$url_name_gal.'/'.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
} 
  //==-=-=-=-=-=-=-=-=-=-=   
          
   $mysql_insert="INSERT INTO `filters_values` (  
   `menu_name-rus`,
   `menu_name-eng`, 
   `text-rus`,
   `text-eng`,
   `preview`,
   `parent`
   ) 
         VALUES (
        
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",  
         ".db_quote($data['text-rus']).",
         ".db_quote($data['text-eng']).",
         '".$thumb."',
         ".db_quote($data['parent'])."
         )"; 
  
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }
   //******************************************************************* 
     
 function load_filter_value_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `filters_values`
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
 //**************************************************************************************
  function update_filter_value_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `filters_values` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`='".$item."'
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }
//**********************************************************************

  function edit_filter_value($data){
 
        $id = $data['id_ed'];
        
        
                if(!empty($data['fileimg']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT `preview`, `id`
                FROM `filters_values`
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
  
    
     $url_name_gal = 'upload/images'; //имя папки, в которую будем сохранять файлы
 
    $folder_thumbs = '/thumbs/';
   
    $thumb_width_gal = '0'; //ширина для миниатюры     
    $thumb_height_gal = '150'; //высота для миниатюры
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
   // $new_filename_big = 'big_'.$new_filename;
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
 
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '100')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb;
      //   echo  $thumb; exit();  
   // echo 'Создание миниатюры произведено успешно - '.$url_name_gal.'/'.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }    
        
        $mysql_update = "UPDATE `filters_values` SET   
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",   
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",        
   `text-rus` = ".db_quote($data['ed_text-rus']).",
   `text-eng` = ".db_quote($data['ed_text-eng']).",   
   `preview`        =  '".$thumb."' 
    WHERE `id`='".$id."'
            "; 
     }  else {
     
         $mysql_update = "UPDATE `filters_values` SET 
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",   
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",        
   `text-rus` = ".db_quote($data['ed_text-rus']).",
   `text-eng` = ".db_quote($data['ed_text-eng'])."    
    WHERE `id`='".$id."'
            "; 
     }                                                                                      
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //******************************************************************* 
   function delete_filter_value($id){
          $query = "
            SELECT `preview` , `id`
               FROM `filters_values`
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
     
      
        if (isset($data['preview']) && @fopen($data['preview'], "r")){
        unlink($data['preview']);
        }
       
       
        $sql="DELETE FROM `filters_values` WHERE id='".$id."' ";
        if (!mysql_query($sql)) {
            return false;
        }
        
        $sql="DELETE FROM `goods_filter_values` WHERE `filter_value` = '".$id."' ";
        if (!mysql_query($sql)) {
            return false;
        }
        
        return true;
    }
//****************************************************************
     function edit_filter_value_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `filters_values` SET 
  `visible` = '".$evis."'
            WHERE `id`= '".$id."'
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //**************************************************************************************
    function loadFilters()
    {
        // query performing 
        $query = "
            SELECT * FROM `filter_types`
            WHERE 1
             ORDER BY `number`
        ";
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
                     'admin_name'      => $row['admin_name'],
                     'visible'      => $row['visible'],  
                     'priority'      => $row['priority'],     
                     'count'    => $this->count_same_values($row['id']),
                     'list'    => $this->loadValues_names($row['id'])  
                      );  
                  
                  //count_all_articles
             }
        }
         return $data;             
    }
//************************************************************************  
  function add_filter($data){
  //  print_r($data); exit;         
   $mysql_insert="INSERT INTO `filter_types` (  
   `admin_name`,
   `menu_name-rus`,
   `menu_name-eng`, 
   `text-rus`,
   `text-eng`   
   ) 
         VALUES (
         ".db_quote($data['admin_name']).",        
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",   
         ".db_quote($data['text-rus']).",
         ".db_quote($data['text-eng'])."
         )"; 
  
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }
   //******************************************************************* 
     
 function loadCategory_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `filter_types`
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
 //**************************************************************************************
  function update_filter_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `filter_types` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`='".$item."'
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }
//**********************************************************************

  function edit_filter($data){
             // ".db_quote(htmlspecialchars($data['ed_title'])).", 
        $id = $data['id_ed'];
        $mysql_update = "UPDATE `filter_types` SET   
   `admin_name` = '".$data['admin_name']."',
   `menu_name-rus` = '".$data['ed_menu_name-rus']."',
   `menu_name-eng` = '".$data['ed_menu_name-eng']."',
   `text-rus` = '".$data['text-rus']."',
   `text-eng` = '".$data['text-eng']."' 
    WHERE `id`='".$id."'
            "; 
          //  echo $mysql_update; exit();     `menu_name` = '".$data['ed_menu_name']."', 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //******************************************************************* 
   function delete_filter($id){
       $sql="DELETE FROM `filter_types` WHERE id='".$id."' ";
        if (!mysql_query($sql)) {
            return false;
        }
        
        $sql="DELETE FROM `goods_catalog_filters` WHERE `filter_id` = '".$id."' ";
        if (!mysql_query($sql)) {
            return false;
        }      
       $sql="DELETE FROM `goods_filter_values` WHERE `filter_id` = '".$id."' ";
        if (!mysql_query($sql)) {
            return false;
        }
        
        
        
        return true;
    }
//****************************************************************
     function edit_filter_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `filter_types` SET 
  `visible` = '".$evis."'
            WHERE `id`= '".$id."'
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //*******************************************************************
  //****************************************************************
     function edit_filter_priority($id, $priority){
     
         if($priority == '1')
         {$epriority = 0;}
          if($priority == '0')
         {$epriority = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `filter_types` SET 
  `priority` = '".$epriority."'
            WHERE `id`= '".$id."'
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //*******************************************************************
  function loadfilterName($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`, `admin_name`
               FROM `filter_types`
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
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus'],
                     'admin_name'      => $row['admin_name']                      
                     );  
                     // 'preview' => $this -> loadPortfolioPreview($row['id']) 
             }
        }
         return $data;             
    }
 //******************************************************************
 function loadFilterNames($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`, `admin_name`, `visible`
               FROM `filter_types`
            WHERE `id` = '".$id."'
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //   $data = $row;
                 $data = array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus'],
                     'admin_name'      => $row['admin_name']                      
                     );  
             }
        }
         return $data;             
    }
  
  //******************************************************************
  function loadFilter_for_add_value_list()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`, `admin_name`  
            FROM `filter_types`
            WHERE 1
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //    $data[] = $row;
               $data[] = array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus'],
                     'admin_name'      => $row['admin_name']                      
                     );   
             }
        }
         return $data;             
    }
    
  //******************************************************************
  function loadFilter_for_add_value($id)    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`, `admin_name`
           FROM `filter_types`
           WHERE `id` = '".$id."'
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //   $data = $row;
                $data = array(
                     'id'                => $row['id'],
                     'menu_name'      => $row['menu_name-rus'],
                     'admin_name'      => $row['admin_name']                      
                     );  
             }
        }
         return $data;             
    }
   
  //************************************************************************ 
  function count_same_values($id) 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `filters_values` WHERE `parent` = '".$id."' ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];
     
   }  
 //***********************************************************************************    
//*******************************************************************
}
?>