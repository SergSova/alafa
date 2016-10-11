<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_shipping extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
    //*******************************************************************
   function load_Delivery_Cost_Kiev()    {
         // query performing              
        $query = "
            SELECT *
               FROM `delivery_kiev`
           WHERE `id` = 1
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
      //  print_r($data); exit();
         return $data;             
    }
     
//*******************************************************************
function edit_kiev_delivery($data){      
        $mysql_update = "UPDATE `delivery_kiev` SET 
       `min_sum_delivery` = '".$data['min_sum_delivery']."', 
       `delivery_cost` = '".$data['delivery_cost']."',
       `free_delivery_sum` = '".$data['free_delivery_sum']."'
           WHERE `id`= 1
            ";                                                      
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
//*******************************************************************
function load_Delivery_Services()
    {
       
        // query performing 
        $query = "
            SELECT  * FROM `delivery_services`
            WHERE 1
            ORDER by `name`
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
//********************************************************** 
function edit_free_delivery_sum_settings($data){
    //   $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `delivery_options` SET 
       `cost` = ".db_quote($data['free_delivery_sum_option'])."
           WHERE `id` = 1 
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//*******************************************************************
function edit_kurer_do_delivery_sum_settings($data){
    //   $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `delivery_options` SET 
       `cost` = ".db_quote($data['kurer_do_delivery_option'])."
           WHERE `id` = 2 
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//*******************************************************************
function load_Delivery_Options_mindel()
    {                          
        $query = "
            SELECT * FROM `delivery_options`
            WHERE `id` =  1        
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
    //*******************************************************************
function load_kurer_do_delivery_option()
    {                          
        $query = "
            SELECT * FROM `delivery_options`
            WHERE `id` =  2        
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
//******************************************************************* 
function add_delivery_service($data){
  //  print_r($data); exit;         
 
  $mysql_insert="INSERT INTO `delivery_services` ( 
   `name`,
   `cost` 
   ) 
         VALUES (
         ".db_quote($data['name']).",
         ".db_quote($data['cost'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }  
//******************************************************************* 
function loadDelivery_Service_foredit($id)   {
          $query = "
            SELECT *
               FROM `delivery_services`
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
//******************************************************************* 
function edit_delivery_service($data){
         $id = $data['id_ed'];
        $mysql_update = "UPDATE `delivery_services` SET 
   `name` = ".db_quote($data['ed_name']).", 
   `cost` = ".db_quote($data['ed_cost'])." 
           WHERE `id`='".$id."'
            "; 
           $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }    
//******************************************************************* 
function delete_delivery_service($id){
       $sql="DELETE FROM `delivery_services`WHERE `id`= '".$id."'   ";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    }
//******************************************************************* 
function load_Ukrpost_Datas()
    {                      
   //    $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT  * 
            FROM `delivery_ukrpost_matrix`
            WHERE  1
            ORDER BY `cost` ASC
           ";
     
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
function ukrpost_edit_cost($dataedit) {
            
  if(!empty($dataedit['ukrpost'])){
    $sql="DELETE FROM `delivery_ukrpost_matrix`  ";
        mysql_query($sql);
      
  // echo "<pre>"; print_r($dataedit); exit();      
   foreach ($dataedit['ukrpost'] as $item) :
   if($item['cost']!='' && $item['min_v']!='' && $item['max_v']!='') {
   $mysql_insert="INSERT INTO `delivery_ukrpost_matrix` ( 
   `cost`, 
   `min_v`,
   `max_v`
   ) 
         VALUES (
         ".db_quote($item['cost']).",
         ".db_quote($item['min_v']).",
         ".db_quote($item['max_v'])." 
         )";
         
    //  print_r($mysql_insert); exit();
       
        $this->db->query($mysql_insert);         
   }       
   endforeach;  
    } 
        return $this->db->affected_rows(); 
   
     } 
//*******************************************************************
function add_town($data){
  //  print_r($data); exit;         
   
  $mysql_insert="INSERT INTO `city` (    
   `name`,
   `region_id`
   ) 
         VALUES (               
         ".db_quote($data['name']).",
         ".db_quote($data['region'])."
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }
//******************************************************************* 
function loadTown_foredit($id)
    {
         // query performing   
        $query = "
            SELECT * FROM `city`
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
//******************************************************************* 
function edit_town($data){
         $id = $data['id_ed'];
        $mysql_update = "UPDATE `city` SET 
       `name` = '".$data['name']."', 
       `region_id` = '".$data['region']."'
           WHERE `id`='".$id."'
            ";                                                      
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
//******************************************************************* 
function Get_Filtered_towns($searchdata, $start_limit)  {                      
     
        $order = "  LIMIT $start_limit, 20";   
        // query performing        
        
        if($searchdata['region'] !== '' && $searchdata['region'] !== 'all'){ 
             $whereregion = " AND `region_id` = '".$searchdata['region']."' ";
       }else{$whereregion = '';}
      
        if($searchdata['word'] !== '' && $searchdata['word'] !== 'nsw'){ 
             $whereword = $searchdata['word'];
       }else{$whereword = '';}
        
        
                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `city`
            WHERE `name` LIKE '%".$whereword."%'
              $whereregion 
             ORDER BY `name` ASC
            $order  
         ";
        //  echo $query; exit();
         $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           // print_r( $data['total']); exit();
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                    $data['townslist'][] =array(
                     'id'          => $row['id'], 
                     'name'        => $row['name'], 
                     'region_id'   => $row['region_id']
                   ); 
            }
        } 
      //  echo "<pre>";
      //      print_r( $data); exit(); 
        return $data;            
    }  
//*******************************************************************  
function loadTownNameForSearch ($term)              
    { 
    $term = trim($term);  
       $query = "
            SELECT `name` FROM `city`
            WHERE `name` LIKE '%".$term."%'
            LIMIT 15
            ";
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
function delete_town($id){
       $sql="DELETE FROM `city` WHERE id = '".$id."' ";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    
    }        
//*******************************************************************
function load_Towns($region_id)   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `city`
            WHERE `region_id` = '".$region_id."'
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
                     'name'   => $row['name']
                   ); 
             }
        }
         return $data;             
    }
 //************************************************************************
  //*****************************************************************************
     function load_Towns_alone()   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `city`
            WHERE 1
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
                     'name'   => $row['name']
                   ); 
             }
        }
         return $data;             
    }
 //************************************************************************
 function loadRegionName($id)   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `region`
            WHERE `id` = '".$id."'
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data  = $row ;
              /*  $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name']
                   );    */
             }
        }
         return $data;             
    }    
   //*****************************************************************************
     function loadTownName($id)   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `city`
            WHERE `id` = '".$id."'
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data  = $row ;
                /*  $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name']
                   );    */
             }
        }
         return $data;             
    } 
    
       
//************************************************************************************  
//*********************************************************************
     function Get_Towns_All_For_Filter($start_limit)  {                      
     
        $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `city`
            WHERE  1 
            ORDER BY `region_id` ASC
            $order  
         ";
     
        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {
             
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
          
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                                         
                     $data['townslist'][] =array( 
                     'id'              => $row['id'],
                     'region_id'       => $row['region_id'], 
                     'name'       => $row['name'] 
                   );             
            }
        }       
        return $data;            
    }
   
  //***************************************************     
         
  //***************************************************
  function load_Regions()   {
        // query performing 
        $query = "
            SELECT * FROM `region`
            WHERE 1
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
                     'name'   => $row['name']
                   ); 
             }
        }
         return $data;             
    }    
   //*****************************************************************************
   

//******************************************************************* 
//******************************************************************* 
//******************************************************************* 
}
?>