<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *   Model class
 * @author Ageev Alexey
 * @copyright  2013 - 2014
 */

class model_pages extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        $this->load->helper('wm');
        parent::__construct();
    }
//*************************************************************************************************
  
      
 function loadPages()    {
        // query performing 
        $query = "
            SELECT `id`, `menu_name-rus`, `module`, `note`,  `show_top`, `visible`, `priority`, `url` 
            FROM `pages`
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
                     'id'             => $row['id'],
                     'url'            => $row['url'],
                     'menu_name'      => $row['menu_name-rus'],
                     'module'         => $row['module'],
                     'note'           => $row['note'],
                     'visible'        => $row['visible'],
                     'show_top'       => $row['show_top'],
                     'priority'       => $row['priority'],
                     'subpages'       => $this->count_same_subpages( $row['id'])
                     );
                     // count_same_subpages  
             }
        }
         return $data;             
    }
       //************************************************************************  
        function add_page($data){
  //  print_r($data); exit;   
  
     if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['menu_name-rus']) ;      
   }      
   
  $mysql_insert="INSERT INTO `pages` ( 
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
   `note`,
   `module`,
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
         ".db_quote($data['note']).",
         ".db_quote($data['module']).",
         ".db_quote($data['url'])."  
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
         $add_page_id = $this->db->insert_id();
        
       //============================================= 
       $id_url_route = $this->add_new_url_route('page', $data['url'], $add_page_id);
       //============================================= 
       $mysql_update = "UPDATE `pages` SET 
       `number`         = ".db_quote($add_page_id)." ,
       `url_route`      = '".$id_url_route."'
       WHERE `id`='".$add_page_id."'
         ";    
       $this->db->query($mysql_update);
                 
return true;
     }
 //***********************************************************************************    
 function delete_page($id){
       $sql="DELETE FROM `pages` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
         
       //============================================= 
       $this->delete_url_route('page', $id);
       //============================================= 
        return true;
    }         
 //******************************************************************* 
 //******************************************************************* 
 function edit_page($data){
         $id = $data['id_ed'];
         
   if(trim($data['url']) =='') {
   $data['url'] = translit_string_from_cyr($data['ed_menu_name-rus']) ;      
   }
   //============================================= 
       $this->edit_url_route('page', $data['url'], $id);
      //============================================= 
         
        $mysql_update = "UPDATE `pages` SET 
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
   `note` = ".db_quote($data['ed_note']).",
   `module` = ".db_quote($data['ed_module']).", 
   `url` = ".db_quote($data['url'])." 
           WHERE `id`=$id
            "; 
          //  echo $mysql_update; exit();     `menu_name` = '".$data['ed_menu_name']."', 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//*********************************************************************************     

     function edit_page_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `pages` SET 
  `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
    
//****************************************************************
     function edit_page_show_top($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;} 
        $mysql_update = "UPDATE `pages` SET 
        `show_top` = $evis
        WHERE `id`= $id
        "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
    
//****************************************************************
function loadPageforedit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `pages`
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
    //***************************************************
      function update_page_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `pages` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`=$item
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     } 
     
  
  //*****************************************************************************
 function loadBlock($pos)
    {
        // query performing 
        $query = "
            SELECT * FROM `blocks`
            WHERE `position` = '".$pos."'
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row ;
             }
        }
         return $data;             
    } 
  //**********************************************************************************
  
 function loadBlockforedit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `blocks`
            WHERE `id` = ".$id."
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
   //************************************************************************  
   //************************************************************************ 
       function loadBlocks()    {
        // query performing 
        $query = "
            SELECT * FROM `blocks`
            WHERE 1 
            ORDER BY `id` ASC            
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row ;
             }
        }
         return $data;             
    }   
//*******************************************************************   
 //*******************************************************************************************  
   function edit_block($data){
         $id = $data['id_ed'];
 
        $mysql_update = "UPDATE `blocks` SET 
    `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_full_text-hu'])." 
           WHERE `id`=".$id."    
            "; 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //*********************************************************************************** 
//**************************************************************************
   function count_all_customers() 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `customers_users`";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];
     
   } 
//********************************************************************************************** 
//******************************************************************************************
  //**********************************************************  
function loadCustomerNameForSearch ($term)              
    { 
    $term = trim($term);  
       $query = "
            SELECT `name`, `surname` FROM `customers_users`
            WHERE `surname` LIKE '%".$term."%'
          
            LIMIT 15
            ";    //  OR   `surname` LIKE '%".$term."%'   
         $dbres = $this->db->query($query);
        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row ;               
            }
         }      
        return $data;           
    }
 //**************************************************************************************
  
//****************************************************************************************** 
//*********************************************************************************
   function edit_subpage($data){
         $id = $data['id_ed'];
        $mysql_update = "UPDATE `pages_sub` SET 
   `parent_page` = ".db_quote($data['parent_page']).",
   `title-rus` = ".db_quote($data['ed_title-rus']).", 
   `title-eng` = ".db_quote($data['ed_title-eng']).", 
   `descr-rus` = ".db_quote($data['ed_descr-rus']).",
   `descr-eng` = ".db_quote($data['ed_descr-eng']).", 
   `kwd-rus` = ".db_quote($data['ed_kwd-rus']).",
   `kwd-eng` = ".db_quote($data['ed_kwd-eng']).",
   `h1-rus` = ".db_quote($data['ed_h1-rus']).",
   `h1-eng` = ".db_quote($data['ed_h1-eng']).",
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` =".db_quote($data['ed_menu_name-eng']).",
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `note` = ".db_quote($data['ed_note']).",
   `module` = ".db_quote($data['ed_module'])."  
           WHERE `id`=$id
            "; 
          //  echo $mysql_update; exit();    
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //************************************************************************  
        function add_subpage($data){
  //  print_r($data); exit;         
   
  $mysql_insert="INSERT INTO `pages_sub` ( 
   `parent_page`,
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
   `text-eng`,
   `note`,
   `module`
   ) 
         VALUES (
         ".db_quote($data['parent_page']).",
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
         ".db_quote($data['full_text-eng']).",
         ".db_quote($data['note']).",
         ".db_quote($data['module'])."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }
 //******************************************************************* 
 //*******************************************************************
    function loadSubpages_by_id($id)    {
        // query performing 
        $query = "
            SELECT  `id`, `parent_page`, `menu_name-rus`, `module`, `note`, `visible`
            FROM `pages_sub`
            WHERE `parent_page` =  ".$id." 
            ORDER BY `number`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data[] =array(
                     'id'             => $row['id'],
                     'menu_name'      => $row['menu_name-rus'],
                     'module'         => $row['module'],
                     'note'           => $row['note'],
                     'parent_page'    => $row['parent_page'],
                     'visible'        => $row['visible']
                     );
                     
             }
        }
         return $data;             
    }
 //************************************************************************
  
   //***************************************************************************************
   function load_Page_Names($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT `id`, `menu_name-rus`
               FROM `pages`
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
                     'id'             => $row['id'],
                     'menu_name'      => $row['menu_name-rus']
                     );
             }
        }
         return $data;             
    }
  
  //***************************************************************************** 
    //*******************************************************************
    function update_subpage_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `pages_sub` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`=$item
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     } 
 //***************************************************************************************
//***********************************************************************************  
function load_subpage_foredit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `pages_sub`
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
   function edit_subpage_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `pages_sub` SET 
  `visible` = $evis
            WHERE `id`= $id
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //**************************************************************************************    
 function delete_subpage($id){
       $sql="DELETE FROM `pages_sub` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    }                                                                      
 //**************************************************************************************
 function count_same_subpages($id) 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `pages` WHERE `parent_page` = ".$id."  ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];
     
   }                                                                                       
//*******************************************************************   
    //******************************************************************   
    //******************************************************************
   //****************************************************************** 
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
  WHERE `ctype` = '".$ctype."' AND `id_data` =  ".$id_data." 
    ";      
                                                           
    $this->db->query($mysql_update);
    return true;
}
//*******************************************************************  
   function delete_url_route($ctype, $id_data){
       $sql="DELETE FROM `url_routing` WHERE 
       `ctype`='".$ctype."'
       AND `id_data`= ".$id_data." 
       ";
        if (!mysql_query($sql)) {                        
            return false;
        }
        
        return true;
   } 
//*************************************************************************************************
   
//**************************************************************************************
   
 //*******************************************************************      
  //**************************************************************************************
    function loaddocs()
    {
       
        // query performing 
        $query = "
            SELECT SQL_CALC_FOUND_ROWS 
           `id`,
            `menu_name-rus`,
            `h1-rus`,
            `file`, 
            `visible`
            FROM `docs`
            WHERE 1
            ORDER BY `number`    
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
           
           $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
            
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                 $data['list'][] =array(
                     'id'             => $row['id'],
                     'menu_name'      => $row['menu_name-rus'],
                     'h1'      => $row['h1-rus'],
                     'file'      => $row['file'],  
                     'visible'      => $row['visible']
                      );   
                  //count_all_catalogs
             }
        }
         return $data;             
    }
//************************************************************************    
function add_doc($data){
            
     
     $file_w = '';
       if (isset($data['filedoc']['name']) && !empty($data['filedoc']['name'])) {
 
   $global_files_dir = 'upload/docs/';      
   $file = $data['filedoc']['tmp_name'];  
   $filename = encodestring($data['filedoc']['name']) ; // translit_string_from_cyr     encodestring
   $mime = substr(strrchr($filename, '.'), 1);
   $format = $mime; 
   
   
   
   move_uploaded_file($file, $global_files_dir.$filename);       
   //99999999999999999999999999999999999999999          
   $file_w =  $global_files_dir.$filename;            
  //  print_r($data); exit;  
       }       
   $mysql_insert="INSERT INTO `docs` (           
   `menu_name-rus`,
   `menu_name-eng`,
   `menu_name-ukr`,
   `menu_name-hu`,     
   `text-rus`,
   `text-eng`,
   `text-ukr`,
   `text-hu`,     
   `file`
   ) 
         VALUES (                            
         ".db_quote($data['menu_name-rus']).",
         ".db_quote($data['menu_name-eng']).",
         ".db_quote($data['menu_name-ukr']).",
         ".db_quote($data['menu_name-hu']).",   
         ".db_quote($data['text-rus']).",    
         ".db_quote($data['text-eng']).",     
         ".db_quote($data['text-ukr']).",     
         ".db_quote($data['text-hu']).",      
         ".db_quote($file_w)." 
         )"; 
  
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
        $add_page_id = $this->db->insert_id();
       
       $mysql_update = "UPDATE `docs` SET 
       `number`         = ".db_quote($add_page_id)."  
       WHERE `id`= ".$add_page_id." 
         ";    
       $this->db->query($mysql_update);
        
                 
return true;
     }
   //*******************************************************************   
   function delete_doc($id){
       $sql="DELETE FROM `docs` WHERE id = ".$id."  ";
        if (!mysql_query($sql)) {
       
            return false;
        }
      
        return true;
   }
 //*******************************************************************         
function loaddoc_foredit($id)
    {
         // query performing   
        $query = "
            SELECT  *
            FROM `docs`
            WHERE `id` = ".$id."   
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
    //******************************************************************
    function edit_doc($data){
            
   $id = $data['id_ed'];
 
  if(!empty($data['filedoc']['name']))     { 
   /////////////////udalenie starogo izobrazhenija////////////////// 
     $query = " SELECT `file`, `id`
                FROM `docs`
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
        if (isset($dataedit['file']) && @fopen($dataedit['file'], "r")){
        unlink($dataedit['file']);
       }
  // 00000000000000000000000000000000000  
   $global_files_dir = 'upload/docs/';      
   $file = $data['filedoc']['tmp_name'];  
   $filename = encodestring($data['filedoc']['name']) ; // translit_string_from_cyr     encodestring
   $mime = substr(strrchr($filename, '.'), 1);
   $format = $mime; 
                         
   move_uploaded_file($file, $global_files_dir.$filename);       
   //99999999999999999999999999999999999999999          
   $file_w =  $global_files_dir.$filename;      
  // 111111111111111111111111111111111111111         
             
        $mysql_update = "UPDATE `docs` SET           
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",      
   `text-rus` = ".db_quote($data['ed_text-rus']).",
   `text-eng` = ".db_quote($data['ed_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_text-hu']).",       
   `file`        =  '".$file_w."'
    WHERE `id`= ".$id." 
            ";
            // 
  // `break` = '".$data['break']."', 
  }         
   else {
           $mysql_update = "UPDATE `docs` SET     
   `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).",
   `menu_name-hu` = ".db_quote($data['ed_menu_name-hu']).",         
   `text-rus` = ".db_quote($data['ed_text-rus']).",
   `text-eng` = ".db_quote($data['ed_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_text-ukr']).",
   `text-hu` = ".db_quote($data['ed_text-hu'])."
    WHERE `id`= ".$id." 
            "; 
              
   }         
          //  echo $mysql_update; exit();     
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //******************************************************************* 
 function edit_doc_visible($id, $vis){
     
         if($vis == '1')
         {$evis = 0;}
          if($vis == '0')
         {$evis = 1;}
       // $id = $data['id_ed'];
        $mysql_update = "UPDATE `docs` SET 
  `visible` = '".$evis."'
            WHERE `id`=  ".$id." 
            "; 
          //  echo  $mysql_update; exit;
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //*******************************************************************
function update_doc_number($arr_img){
         $arr_img = explode(',', $arr_img['order']);     
      foreach ($arr_img as $position => $item) :

        $mysql_update = "UPDATE `docs` SET 
   `number` = ".db_quote($position)." 
           WHERE `id`= ".$item." 
            "; 
            $this->db->query($mysql_update);
          endforeach;  
         return $this->db->affected_rows(); 
     }
//**********************************************************************  

  //*****************************************************************************
 function loadletter_templ()
    {
        // query performing 
        $query = "
            SELECT * FROM `letter_templs`
            WHERE 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row ;
             }
        }
         return $data;             
    } 
  //**********************************************************************************
  
 function loadletter_templforedit($id)
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `letter_templs`
            WHERE `id` = ".$id."
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
   //************************************************************************  
   //************************************************************************ 
       function loadletter_templs()    {
        // query performing 
        $query = "
            SELECT * FROM `letter_templs`
            WHERE 1 
            ORDER BY `id` ASC            
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row ;
             }
        }
         return $data;             
    }   
//*******************************************************************   
 //*******************************************************************************************  
   function edit_letter_templ($data){
         $id = $data['id_ed'];
 
        $mysql_update = "UPDATE `letter_templs` SET 
    `menu_name-rus` = ".db_quote($data['ed_menu_name-rus']).",
   `menu_name-eng` = ".db_quote($data['ed_menu_name-eng']).",
   `menu_name-ukr` = ".db_quote($data['ed_menu_name-ukr']).", 
   `text-rus` = ".db_quote($data['ed_full_text-rus']).",
   `text-eng` = ".db_quote($data['ed_full_text-eng']).",
   `text-ukr` = ".db_quote($data['ed_full_text-ukr'])." 
           WHERE `id`=".$id."    
            "; 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //***********************************************************************************
//*************************************************************************************************
   
//*******************************************************************    
//*******************************************************************
//*******************************************************************    
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