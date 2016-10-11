<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_statistic extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
 function load_Active_User_Cart($sess_id)  {                      
       // echo $sess_id; exit();
        // query performing                
        $query = "
            SELECT  * 
            FROM `ci_sessions`
            WHERE `session_id` = '".$sess_id."'  
         ";
       //   echo $query; exit();          //  ASC 
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
 //*********************************************************************
     function load_Active_Users()  {                      
     
       /*  
         if (strtolower($this->time_reference) == 'gmt')
        {
            $now = time();
            $time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));
        }
        else
        {
            $time = time();
        }
            9600              */
        $time = time();   
        $time = $time - 300 ;
        // last_activity < time()-172800 
        // WHERE `last_activity` > $time          
        // query performing                
        $query = "
            SELECT  * 
            FROM `ci_sessions` 
             WHERE `last_activity` > $time 
            ORDER BY `last_activity`
         ";
                  //  ASC 
                     $dbres = $this->db->query($query);
                     $data = array();
                     $data['total'] = '';
                      if ($dbres->num_rows() >= 1) {
                          
                       $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           // print_r( $data['total']); exit();
            $rows = $dbres->result_array();
            foreach ($rows as $row) {         
                      $data['user_list'][] = $row;          
                    
            }
        }       
        return $data;             
    } 
 //**************************************************************************************
 function load_Trafic_Day()  {                      
     
      $date = date('Y-m-d', time())  ;
        // query performing                        
        $query = "
            SELECT  * 
            FROM `trafic` 
            WHERE DATE(`date`) =  '".$date."' 
            ORDER BY `date` DESC
         ";
                  //  ASC 
                     $dbres = $this->db->query($query);
                     $data = array();
                      if ($dbres->num_rows() >= 1) {
         //   $data['total'] = 0;              
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           // print_r( $data['total']); exit();
            $rows = $dbres->result_array();
            foreach ($rows as $row) {         
                      $data['trafic_list'][] = $row;          
                    
            }
        }    
    //   echo "<pre>"; print_r($data); exit();   
        return $data;             
    } 

//****************************************************************
function getFilteredTrafic($data)
    {   
    
        if( trim($data['date_input1'])!='' || trim($data['date_input2'])!='' )
         {
         $where = " WHERE ";
         }
           
        if(trim($data['date_input1']) !== '' && trim($data['date_input2']) !== ''){ 
                     $date1 = trim($data['date_input1']);
                     $date2 = trim($data['date_input2']);
                     $wheredated = "  DATE(`date`) >= '".$date1."' AND DATE(`date`) <= '".$date2."'  ";
                     }
        if(trim($data['date_input1']) == '' && trim($data['date_input2']) !== ''){ 
                     $date1 = trim($data['date_input1']);
                     $date2 = trim($data['date_input2']);
                     $wheredated = "  DATE(`date`) <= '".$date2."'  ";
                     }
        if(trim($data['date_input1']) !== '' && trim($data['date_input2']) == ''){ 
                     $date1 = trim($data['date_input1']);
                     $date2 = trim($data['date_input2']);
                     $wheredated = "  DATE(`date`)  >= '".$date1."' ";
                     }
        if(trim($data['date_input1']) == '' && trim($data['date_input2']) == ''){ 
                     $date1 = trim($data['date_input1']);
                     $date2 = trim($data['date_input2']);
                     $wheredated = "";
                     }                                           
          //  if($whereorg != '' || $wheremanager != '' && $wheredated != ''){ 
            if( $wheredated != ''){  
                        // $wheredate = " AND ";
                         }   
                        
            if(!isset($wheredate)){$wheredate='';} 
                  
         $query = "
            SELECT * 
            FROM `trafic`
            $where 
            $wheredate
            $wheredated
            ORDER BY `date` DESC
            ";
        // echo  $query; exit(); 
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
            
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
        
                $data['trafic_list'][] = $row;
             }    
           }  
  
         return $data;             
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
//******************************************************************* 
}
?>