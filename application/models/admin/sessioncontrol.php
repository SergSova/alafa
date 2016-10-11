<?php 
class SessionControl extends Model {
	//************************************************************************************                
	function SessionControl(){
		parent::Model();
		
		$this->db_aliases = $this->config->item("table_aliases");
		
		ini_set('memory_limit', '-1');
		set_time_limit(0);
		session_set_cookie_params(date("r",time()+(100*60)));
		session_start();
	}
	//************************************************************************************                
	function CheckSession() {
		checkAuth($this->config->item('appname'));
		return true;
	}
}
?>