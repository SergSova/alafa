<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_auth extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************

 function load_User_info($data)
    {
        
        // query performing 
        $query = "
            SELECT * FROM `system_power`
            WHERE `login`=  ".db_quote($data['username'])." 
            AND  `pass`=  ".db_quote(md5($data['pword']))."
           
        ";
       // echo  $query; exit;      AND  `status`=  'Master'
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;
                
            }
        }
       
        return $data;
                  
    } 
     //*************************************************************************************************   
    function UnsetPower(){
       $sql="DELETE FROM `ci_sessions` WHERE `user_id`='".$this->session->userdata('user_id')."'";
       // echo  $sql; exit;  
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    
    }
     //************************************************************************  
    function UnsetUser(){
       $sql="DELETE FROM `ci_sessions` WHERE `user_id`='".$this->session->userdata('user_id')."'";
       // echo  $sql; exit;  
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    
    }      
    //*************************************************************************************************
 

  
//*************************************************************************************************
    /**
     * EmptyTemplateModel
     * @return {void}
     * @param  {void} $param
     */
/*  function some_func() {
        
        //----------------------------------------------------------------------------
        return true;
    }
*/
//************************************************************************************
}
?>