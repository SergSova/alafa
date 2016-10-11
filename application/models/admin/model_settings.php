<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_settings extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
  
  function addEmployeetolist($data){
   $power=array();
  // echo $data['password']."<br>";
  // echo db_quote(md5($data['password']));
   foreach($data['power'] as $k=>$v) array_push($power, $k);    
      $power = implode(",", $power);
  //  print_r( $power) ; exit();        
   $mysql_insert="INSERT INTO `system_power` (
       `login`,
       `pass`, 
       `fio`,
       `status`,
       `power` 
       ) 
         VALUES (
         ".db_quote($data['login'])." ,
         ".db_quote(md5($data['password'])).",
         ".db_quote($data['fio'])." ,
         'manager' ,
         ".db_quote($power)." 
         )";
          $this->db->query($mysql_insert);
     return true;       
     }     
    
     //*****************************************************************
         //***********************************************************
    function delete_employee($id){
       $sql="DELETE FROM `system_power` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    
    }    
   //***********************************************************************
      function loadEmployeeforedit($id)
    {
          $query = "   SELECT * FROM `system_power` WHERE `id` = '".$id."'  ";
     
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {    
              $data =array(
                     'id'       => $row['id'],
                     'fio'       => $row['fio'],
                     'login'       => $row['login'],
                     'power'       => $row['power'] 
                   );
              }
        }                 
         return $data;             
    } 
    //*******************************************************************************  
   function edit_employee($data){
         $id = $data['id_ed'];
         
        // echo $data['ed_pass']."<br>";
       //  echo db_quote(md5($data['ed_pass']))."<br>"; 
         
    $power=array();
    if(isset($data['power']) && !empty($data['power'])){
       foreach($data['power'] as $k=>$v){   
            array_push($power, $k);
       }
    }    
      $power = implode(",", $power);
         
        if(empty($data['ed_pass'])){
        $mysql_update = "UPDATE `system_power` SET 
   `fio` = ".db_quote($data['ed_fio']).", 
   `login` = ".db_quote($data['ed_login']).",
   `power` = ".db_quote($power)."
           WHERE `id`=$id
            "; }
        if(!empty($data['ed_pass'])){
        $mysql_update = "UPDATE `system_power` SET 
   `fio` = ".db_quote($data['ed_fio']).", 
   `login` = ".db_quote($data['ed_login']).",
   `pass` = ".db_quote(md5($data['ed_pass'])).", 
   `power` = ".db_quote($power)."
           WHERE `id`=$id
            "; }    
         // echo $mysql_update; exit; 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//**************************************************************************** 
   function loadEmployees()
    {       
     $query = "
            SELECT `id`, `fio`, `login` ,`power` FROM `system_power`
            WHERE `status`= 'manager'
            ORDER by `fio`         
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ; 
                 $data[] =array(
                     'id'       => $row['id'],
                     'fio'       => $row['fio'],
                     'login'       => $row['login']   
                   );              
            }
        }                    
        return $data;            
    } 
    
    function addusertolist($data){
     $mysql_insert="INSERT INTO `system_power` (
       `login`,
       `pass`,
       `status`,
       `fio`
       )
         VALUES (
         ".db_quote($data['login'])." ,
         ".db_quote(md5($data['password'])).",
         'admin',
         ".db_quote($data['fio'])."
         )";
        $this->db->query($mysql_insert);

   return true;
     }
//*************************************************************************************************  
   function edit_user($data){
         $id = $data['id_ed'];

         if(empty($data['ed_pass'])){
        $mysql_update = "UPDATE `system_power` SET 
       `fio` = ".db_quote($data['ed_fio']).", 
       `login` = ".db_quote($data['ed_login'])."
           WHERE `id`='".$id."'
            "; }
            
        if(!empty($data['ed_pass'])){
        $mysql_update = "UPDATE `system_power` SET 
       `fio` = ".db_quote($data['ed_fio']).", 
       `login` = ".db_quote($data['ed_login']).",
       `pass` = ".db_quote(md5($data['ed_pass']))."
           WHERE `id`='".$id."'
            "; } 
               
        //    echo $mysql_update; exit; 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//***********************************************************************
  function delete_user($id){
       $sql="DELETE FROM `system_power` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    
    }          
//********************************************************************************* 
 //**********************************************************************************
     function loadEmails()
    {       
 
        $query = "
            SELECT * FROM `settings_email`
            ORDER by `id`         
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
function loadEmailforedit($id)
    {
          $query = "   SELECT * FROM `settings_email` WHERE `id` = '".$id."'  ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
                   $data[] = $row;
            /*  $data[] =array(
                     'id'       => $row['id'],
                     'fio'       => $row['fio'],
                     'login'       => $row['login']
                   );  */
              }
        }

         return $data;             
    }
//*************************************************************************************************  
   function edit_email($data){
         $id = $data['id_ed'];
         $mysql_update = "UPDATE `settings_email` SET 
   `value` = ".db_quote($data['ed_value'])."
           WHERE `id`='".$id."'
            ";      
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }         
//**********************************************************************************  
 function loadAdmins()
    {       
        // query performing 
       //  $this-> db-> query('SET NAMES cp1251');  
        $query = "
            SELECT * FROM `system_power`
            WHERE `status` = 'admin'
            ORDER by `id`         
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
function loadUserforedit($id)
    {
          $query = "SELECT * FROM `system_power` WHERE `id` = $id  ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
              //    $data[] = $row;
              $data = array(
                     'id'       => $row['id'],
                     'fio'       => $row['fio'],
                     'login'       => $row['login']
                   );
              }
        }

         return $data;             
    } 
//*****************************************************************************
   
  //************************************************************************  
   //****************************************************************
  
  
//*******************************************************************
function loadOrder_template()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `orders_options`
            WHERE `id` = 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row;
                 $data[] =array(
                     'id'                => $row['id'],     
                     'name'              => $row['name-rus'] ,
                     'text'              => $row['text-rus'] 
                     );
             }
        }
         return $data;             
    }
    //*******************************************************************
function loadOrder_template_foredit()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `orders_options`
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
         return $data;             
    }
//*******************************************************************
function edit_order_template($data){
         $id = $data['id_ed'];
 
        $mysql_update = "UPDATE `orders_options` SET   
   `text-rus` = ".db_quote($data['ed_text-rus']).",
   `text-ukr` = ".db_quote($data['ed_text-ukr']).",
   `text-eng` = ".db_quote($data['ed_text-eng'])."
           WHERE `id`= ".$id." 
            "; 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
//******************************************************************* 
function loadOrder_template_custom_bank_for_edit()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `orders_options`
            WHERE `id` = 2
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
function loadOrder_template_custom_bank()
    {
         // query performing                SQL_CALC_FOUND_ROWS       
        $query = "
            SELECT *
               FROM `orders_options`
            WHERE `id` = 2
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //  $data[] = $row;
                  $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name-rus'],
                     'text'   => $row['text-rus'] 
                   );   
             }
        }
         return $data;             
    }
//*******************************************************************
function edit_order_template_custom_bank($data){
         $id = $data['id_ed'];
 
        $mysql_update = "UPDATE `orders_options` SET   
        `text-rus` = ".db_quote($data['ed_text-rus']).",
        `text-eng` = ".db_quote($data['ed_text-eng'])."
           WHERE `id`='".$id."'
            "; 
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }  
//******************************************************************* 
 
//******************************************************************* 
    
//*******************************************************************  
//**************************************************************************************
   
//******************************************************************* 
//******************************************************************* 
//******************************************************************* 
}
?>