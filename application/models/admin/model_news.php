<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_news extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************    
  function update_news_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `news` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`=$item
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }                                                                    
  
//**************************************************************************************
    function loadNews($start_limit)
    {
         $order = "  LIMIT $start_limit, 20"; 
        // query performing 
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * FROM `news`
            WHERE `type` = 'new'
             ORDER BY `date` DESC, `number` ASC    
            $order
        ";
       // echo  $query; exit;  ORDER by `date` DESC 
        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {
             
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
             
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data['list'][] = $row; 
                    
            }
        }    
         return $data;             
    }
  
 //*****************************************************
  
 //************************************************************************
 //************************************************************************  
        function add_new($data){
  //  print_r($data); exit; 
  
  
     $thumb = '';
    if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
      // if(!empty($data['fileimg']['name']))
// if (isset($_POST['file'])) {
  
    $url_name_gal = 'upload/images'; //имя папки, в которую будем сохранять файлы
   // $folder_big = '/big/';
    $folder_thumbs = '/news/';
    //$imgs_width_gal = '500'; //максимальная ширина картинки
    //$imgs_height_gal = '600';
   // $thumb_width_gal = '150'; //ширина для миниатюры
     $thumb_width_gal = '250'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '64M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']);  
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime;  
    $new_filename = 'img'.time().'.'.$format;  
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
   
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '100')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb;
         }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
}
  
  
  
  if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['h1-rus']) ;      
   }        
   
  $mysql_insert="INSERT INTO `news` (   
   `h1-rus`,
   `h1-ukr`,
   `h1-eng`,
   `menu_name-rus`,
   `menu_name-ukr`,
   `menu_name-eng`,
   `short_text-rus`,
   `short_text-ukr`,
   `short_text-eng`,
   `date`,
   `title-rus`,
   `title-ukr`,
   `title-eng`,
   `descr-rus`,
   `descr-ukr`,
   `descr-eng`,
   `kwd-rus`,
   `kwd-ukr`,
   `kwd-eng`,
   `text-rus`,
   `text-ukr`,
   `text-eng`,
   `url` ,
   `thumb`,
   `type`
   ) 
         VALUES (                              
         ".db_quote($data['h1-rus']).", 
         ".db_quote($data['h1-ukr']).", 
         ".db_quote($data['h1-eng']).",
         ".db_quote($data['menu_name-rus']).", 
         ".db_quote($data['menu_name-ukr']).", 
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['short_text-rus']).", 
         ".db_quote($data['short_text-ukr']).", 
         ".db_quote($data['short_text-eng']).",
         ".db_quote($data['date']).",
         ".db_quote($data['title-rus']).",
         ".db_quote($data['title-ukr']).",
         ".db_quote($data['title-eng']).",
         ".db_quote($data['descr-rus']).",
         ".db_quote($data['descr-ukr']).",
         ".db_quote($data['descr-eng']).",
         ".db_quote($data['kwd-rus']).",
         ".db_quote($data['kwd-ukr']).",
         ".db_quote($data['kwd-eng']).",
         ".db_quote($data['full_text-rus']).",
         ".db_quote($data['full_text-ukr']).",
         ".db_quote($data['full_text-eng'])." ,
         ".db_quote($data['url']).",
         ".db_quote($thumb).",
         'new'
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
       
       $add_new_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('new', $data['url'], $add_new_id);
       //============================================= 
       $mysql_update = "UPDATE `news` SET 
       `number`         = ".db_quote($add_new_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`=".$add_new_id."
         ";    
       $this->db->query($mysql_update);
                 
return true;
     }
 //******************************************************************* 
  //******************************************************************* 
 function loadNewforedit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `news`
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
//*****************************************************************************
function edit_new($data){
         $id = $data['id_ed'];
         
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_h1-rus']) ;      
   } 
   
      //============================================= 
       $this->edit_url_route('new', $data['url'], $id);
      //============================================= 
     if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {    
  
    $url_name_gal = 'upload/images'; //имя папки, в которую будем сохранять файлы   
    $folder_thumbs = '/news/';                                         
                                
    $thumb_width_gal = '250'; //ширина для миниатюры     
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
    $new_filename = 'news_'.time().'.'.$format; //генерируем новое имя файла        
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
 // exit();
    //создаём миниатюру для загруженной картинки
  /*  if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb;                                     
    } */
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
         unlink($image); 
        }
//}       
         
        $mysql_update = "UPDATE `news` SET 
   `title-rus` = ".db_quote($data['ed_title-rus']).",
   `title-ukr` = ".db_quote($data['ed_title-ukr']).",
   `title-eng` = ".db_quote($data['ed_title-eng']).",
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).",
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `menu_name-rus` = ".db_quote($data['menu_name-rus']).",
   `menu_name-ukr` = ".db_quote($data['menu_name-ukr']).",
   `menu_name-eng` = ".db_quote($data['menu_name-eng']).",
   `short_text-rus` = ".db_quote($data['ed_short_text-rus']).",
   `short_text-ukr` = ".db_quote($data['ed_short_text-ukr']).",
   `short_text-eng` = ".db_quote($data['ed_short_text-eng']).",
   `date` = '".$data['ed_date']."',
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `url` = ".db_quote($data['url']).",
   `thumb` = ".db_quote($thumb)." 
           WHERE `id`=$id
            "; 
     } else {
       $mysql_update = "UPDATE `news` SET 
   `title-rus` = ".db_quote($data['ed_title-rus']).",
   `title-ukr` = ".db_quote($data['ed_title-ukr']).",
   `title-eng` = ".db_quote($data['ed_title-eng']).",
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).",
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `menu_name-rus` = ".db_quote($data['menu_name-rus']).",
   `menu_name-ukr` = ".db_quote($data['menu_name-ukr']).",
   `menu_name-eng` = ".db_quote($data['menu_name-eng']).",
   `short_text-rus` = ".db_quote($data['ed_short_text-rus']).",
   `short_text-ukr` = ".db_quote($data['ed_short_text-ukr']).",
   `short_text-eng` = ".db_quote($data['ed_short_text-eng']).",
   `date` = '".$data['ed_date']."',
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `url` = ".db_quote($data['url'])." 
           WHERE `id`=$id
            "; 
     
     }          
            
            
          //  echo $mysql_update; exit();     `menu_name` = '".$data['ed_menu_name']."', 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
//*******************************************************************
   function edit_new_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `news` SET 
  `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }    
//******************************************************************* 
function edit_new_rss($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `news` SET 
  `rss` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }    
//******************************************************************* 
function delete_new($id){
       $sql="DELETE FROM `news` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
       //============================================= 
       $this->delete_url_route('new', $id);
       //=============================================           
        return true;
    }           
 //******************************************************************* 
   function loadNewsAll()
    {
         
        // query performing 
        $query = "
            SELECT `id`, `priority`,  `url` FROM `news`
            WHERE `visible` = 1
            AND `type` = 'review'
            ORDER BY `number`   
        ";
       // echo  $query; exit;  ORDER by `date` DESC 
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
  
 //*************************************************************************************************    
  function update_reviews_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `news` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`=$item
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }                                                                    
  
//**************************************************************************************
    function loadreviews($start_limit)
    {
         $order = "  LIMIT $start_limit, 20"; 
        // query performing 
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * FROM `news`
            WHERE `type` = 'review'
             ORDER BY `date` DESC, `number` ASC    
            $order
        ";
       // echo  $query; exit;  ORDER by `date` DESC 
        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {
             
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
             
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data['list'][] = $row; 
                    
            }
        }    
         return $data;             
    }
  
 //*****************************************************
  
 //************************************************************************
 //************************************************************************  
        function add_review($data){
  //  print_r($data); exit; 
  
  
     $thumb = '';
    if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {
      // if(!empty($data['fileimg']['name']))
// if (isset($_POST['file'])) {
  
    $url_name_gal = 'upload/images'; //имя папки, в которую будем сохранять файлы
   // $folder_big = '/big/';
    $folder_thumbs = '/reviews/';
    //$imgs_width_gal = '500'; //максимальная ширина картинки
    //$imgs_height_gal = '600';
   // $thumb_width_gal = '150'; //ширина для миниатюры
     $thumb_width_gal = '250'; //ширина для миниатюры     
    $thumb_height_gal = '0'; //высота для миниатюры
    ini_set('memory_limit', '64M'); //увеличиваем размер оперативки для работы с изображениями, а то крупных картинок не загрузишь
    $file = $data['fileimg']['tmp_name'];
    $filename = $data['fileimg']['name'];
    $size = getimagesize($data['fileimg']['tmp_name']);  
    $types = array('jpg', 'jpeg', 'gif', 'png');
    
    $mime = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
     if (!in_array($mime, $types)) { 
     }
     //узнаём mime-тип изображений
    if ($mime=='jpeg') $format = 'jpg'; else $format = $mime;  
    $new_filename = 'img'.time().'.'.$format;  
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
   
    //создаём миниатюру для загруженной картинки
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '100')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb;
         }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
        unlink($image);  }
}
  
  
  
  if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['h1-rus']) ;      
   }        
   
  $mysql_insert="INSERT INTO `news` (   
   `h1-rus`,
   `h1-ukr`,
   `h1-eng`,
   `menu_name-rus`,
   `menu_name-ukr`,
   `menu_name-eng`,
   `short_text-rus`,
   `short_text-ukr`,
   `short_text-eng`,
   `date`,
   `title-rus`,
   `title-ukr`,
   `title-eng`,
   `descr-rus`,
   `descr-ukr`,
   `descr-eng`,
   `kwd-rus`,
   `kwd-ukr`,
   `kwd-eng`,
   `text-rus`,
   `text-ukr`,
   `text-eng`,
   `url` ,
   `thumb`,
   `type`
   ) 
         VALUES (                              
         ".db_quote($data['h1-rus']).", 
         ".db_quote($data['h1-ukr']).", 
         ".db_quote($data['h1-eng']).",
         ".db_quote($data['menu_name-rus']).", 
         ".db_quote($data['menu_name-ukr']).", 
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['short_text-rus']).", 
         ".db_quote($data['short_text-ukr']).", 
         ".db_quote($data['short_text-eng']).",
         ".db_quote($data['date']).",
         ".db_quote($data['title-rus']).",
         ".db_quote($data['title-ukr']).",
         ".db_quote($data['title-eng']).",
         ".db_quote($data['descr-rus']).",
         ".db_quote($data['descr-ukr']).",
         ".db_quote($data['descr-eng']).",
         ".db_quote($data['kwd-rus']).",
         ".db_quote($data['kwd-ukr']).",
         ".db_quote($data['kwd-eng']).",
         ".db_quote($data['full_text-rus']).",
         ".db_quote($data['full_text-ukr']).",
         ".db_quote($data['full_text-eng'])." ,
         ".db_quote($data['url']).",
         ".db_quote($thumb).",
         'review'
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
       
       $add_new_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('review', $data['url'], $add_new_id);
       //============================================= 
       $mysql_update = "UPDATE `news` SET 
       `number`         = ".db_quote($add_new_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`=".$add_new_id."
         ";    
       $this->db->query($mysql_update);
                 
return true;
     }
 //******************************************************************* 
  //******************************************************************* 
 function loadreviewforedit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `news`
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
//*****************************************************************************
function edit_review($data){
         $id = $data['id_ed'];
         
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_h1-rus']) ;      
   } 
   
      //============================================= 
       $this->edit_url_route('review', $data['url'], $id);
      //============================================= 
     if (isset($data['fileimg']['name']) && !empty($data['fileimg']['name'])) {    
  
    $url_name_gal = 'upload/images'; //имя папки, в которую будем сохранять файлы   
    $folder_thumbs = '/reviews/';                                         
                                
    $thumb_width_gal = '250'; //ширина для миниатюры     
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
    $new_filename = 'news_'.time().'.'.$format; //генерируем новое имя файла        
    $new_filename_thumb = 'thumb_'.$new_filename;
    copy($file, $url_name_gal.'/'.$new_filename); //копируем файл 
 // exit();
    //создаём миниатюру для загруженной картинки
  /*  if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb;                                     
    } */
    if (image_resize($url_name_gal.'/'.$new_filename, $url_name_gal.''.$folder_thumbs.''.$new_filename_thumb, $thumb_width_gal, $thumb_height_gal, '0x000000', '90')) {
        $thumb = $url_name_gal.$folder_thumbs.$new_filename_thumb; 
    }
   // else echo 'Миниатюра создана не была.';
    $image = $url_name_gal.'/'.$new_filename;
        if (isset($image) && @fopen($image, "r")){
         unlink($image); 
        }
//}       
         
        $mysql_update = "UPDATE `news` SET 
   `title-rus` = ".db_quote($data['ed_title-rus']).",
   `title-ukr` = ".db_quote($data['ed_title-ukr']).",
   `title-eng` = ".db_quote($data['ed_title-eng']).",
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).",
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `menu_name-rus` = ".db_quote($data['menu_name-rus']).",
   `menu_name-ukr` = ".db_quote($data['menu_name-ukr']).",
   `menu_name-eng` = ".db_quote($data['menu_name-eng']).",
   `short_text-rus` = ".db_quote($data['ed_short_text-rus']).",
   `short_text-ukr` = ".db_quote($data['ed_short_text-ukr']).",
   `short_text-eng` = ".db_quote($data['ed_short_text-eng']).",
   `date` = '".$data['ed_date']."',
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `url` = ".db_quote($data['url']).",
   `thumb` = ".db_quote($thumb)." 
           WHERE `id`=$id
            "; 
     } else {
       $mysql_update = "UPDATE `news` SET 
   `title-rus` = ".db_quote($data['ed_title-rus']).",
   `title-ukr` = ".db_quote($data['ed_title-ukr']).",
   `title-eng` = ".db_quote($data['ed_title-eng']).",
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-ukr` = ".db_quote($data['ed_descr-ukr']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).",
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-ukr` = ".db_quote($data['ed_kwd-ukr']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-ukr` = ".db_quote($data['ed_h1-ukr']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `menu_name-rus` = ".db_quote($data['menu_name-rus']).",
   `menu_name-ukr` = ".db_quote($data['menu_name-ukr']).",
   `menu_name-eng` = ".db_quote($data['menu_name-eng']).",
   `short_text-rus` = ".db_quote($data['ed_short_text-rus']).",
   `short_text-ukr` = ".db_quote($data['ed_short_text-ukr']).",
   `short_text-eng` = ".db_quote($data['ed_short_text-eng']).",
   `date` = '".$data['ed_date']."',
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `url` = ".db_quote($data['url'])." 
     WHERE `id`=$id
      "; 
     
     }          
            
            
          //  echo $mysql_update; exit();     `menu_name` = '".$data['ed_menu_name']."', 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
//*******************************************************************
   function edit_review_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `news` SET 
  `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }    
//******************************************************************* 
function edit_review_rss($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `news` SET 
  `rss` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }    
//******************************************************************* 
function delete_review($id){
       $sql="DELETE FROM `news` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
       //============================================= 
       $this->delete_url_route('review', $id);
       //=============================================           
        return true;
    }           
 //******************************************************************* 
   function loadreviewsAll()
    {
         
        // query performing 
        $query = "
            SELECT `id`, `priority`,  `url` FROM `news`
            WHERE `visible` = 1
            AND `type` = 'review'
             ORDER BY `number`   
        ";
       // echo  $query; exit;  ORDER by `date` DESC 
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
 //*********************************************************************************** 
 function loadNews_rss()
    {
    // query performing 
        $query = "
            SELECT `id`, `rss`, `url`, `h1-rus` as `h1`, `text-rus` as  `text`, `date` FROM `news`
            WHERE `rss` = 1
            ORDER BY `number`   
        ";
    // echo  $query; exit;  ORDER by `date` DESC 
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
             
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row; 
                /* $data[] = array(
                     'id'                 => $row['id'],
                     'url'       => $row['url'], 
                     'menu_name'          => $row['menu_name-rus'],    
                     'text'             => $row['text-rus'],   
                     'date_edit'            => $row['date'] 
                    );   */
            }
        }  
        
       // echo "<pre>"; print_r($data); exit();                
          
         return $data;   
         
           
    }
  
   
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
       `ctype`='".$ctype."'
       AND `id_data`='".$id_data."'
       ";
        if (!mysql_query($sql)) {                        
            return false;
        }
        
        return true;
   }
//******************************************************************* 
 //******************************************************************* 
   
 //******************************************************************* 
 //*******************************************************************
}
?>