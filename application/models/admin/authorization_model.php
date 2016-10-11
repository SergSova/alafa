<?php
/**
 * Authorization Model 
* @author Ageev Alexey
 * @copyright KunKan Studio
 */

class Authorization_model extends Model {
	
	var $db_aliases;
 //************************************************************************************      	
	function Authorization_model(){
		parent::Model();
		$this->load->helper('validation_helper');
		
		$this->load->database();
		
		$this->db_aliases = $this->config->item("table_aliases");
	}
	
	/**
	 * User Authorization
	 * Return true and set SESSION user data if user is logged in the System
	 *
	 * @param array $data
	 * @return bool
	 */
	function user_login ($data){
        $user = array();
        $done = false;		
		$data['login'] = trim($data['login']);
		$data['password'] = trim($data['password']);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, base_url().'../../faynaua/portal_login.php');
        $Post = http_build_query($data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Post); 
        $result = curl_exec($ch);  
        if (!empty($result)) {
               $data = explode("<sep>", $result);
               foreach ($data as $row) {
                   $row_res = explode("=",$row);
                   if (!empty($row_res)) $user[$row_res[0]] = $row_res[1];   
               }
               $done = true;
               $_SESSION[$this->config->item('appname')]['user'] = $user; 
        }
        return $done;    
	}
 //************************************************************************************                   
    function logout(){       
        $_SESSION[$this->config->item('appname')]['user'] = array();
        
        return true;
    }
}
	
?>