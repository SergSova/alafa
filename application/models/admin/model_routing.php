<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Model class
 * @author Ageev Alexey
 * @copyright    2013
 */

class model_routing extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {                                   
        parent::__construct();
    }
//*************************************************************************************************
  
 //************************************************************************   
 function loadContent_t_by_url($url) 
   { 
   $sql = "
   SELECT `id_url` as `id`, `ctype`, `id_data` 
   FROM `url_routing`
   WHERE `url` = '".trim($url)."'
   LIMIT 1
   ";             
    $query = $this->db->query($sql);
    $row = $query->result_array();
   // echo  $row."<br>";
     //echo "<pre>"; print_r($row[0]);
   // exit();
    
    if(isset($row[0]['id'])){ 
    return $row[0]; 
    }
    else {
     return false;
    }   
   }   
 //************************************************************************************  
   //******************************************************************   
//******************************************************************* 
//******************************************************************* 
//******************************************************************* 
}
?>