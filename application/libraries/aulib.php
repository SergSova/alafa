<?php
class Aulib
{
	private $obj = NULL;
	
	function Aulib()
	{
		$this->obj =& get_instance();
		$this->obj->load->model('aumodel');
		$this->obj->config->load('auconfig');
		if ($this->obj->config->item('au_language') != '') 
			$curLang = $this->obj->config->item('au_language');
		else
			$curLang = $this->obj->config->item('language');    
		$this->obj->lang->load('au', $curLang); 		
	}

	/*
	 * Return "welcome" string with link to login page
	 * Call this function every time on you main page 
	 */
	function getLoginLink()
	{
		$id = $this->getSessionId();
		if($id)
		{
			$logoff_link = $this->obj->lang->line('logout_link_name');
			$welcome_str = $this->obj->lang->line('welcome_string');
			if($welcome_str != '')
			{
				$welcome_str = str_replace('%name%', $this->obj->aumodel->userInfo($id, 'name'), $welcome_str);
				$welcome_str = str_replace('%logoff%', anchor('au/logout',$logoff_link), $welcome_str);
			}
			return $welcome_str;
		}
		else
		{ 
			$login_link = $this->obj->lang->line('login_link_name');
			$registers_link = $this->obj->lang->line('registers_link_name');
			$login_str = $this->obj->lang->line('login_string');
			if($login_str != '')
			{
				$login_str = str_replace('%registers%', anchor('au/registers',$registers_link), $login_str);
				$login_str = str_replace('%login%', anchor('au/login',$login_link), $login_str);
			}
			
			return $login_str;
		} 
	}

	/*
	 * Return link for call back-end system
	 * This back-end can help you manage users & groups
	 */
	function getManagerLink()
	{
		return anchor('aumanager', $this->obj->lang->line('manager_link_name'));
	}

	/*
	 * function block for set/get session userID
	 */
	function setSessionId($id, $storable = FALSE)
	{
		if( $id < 1 ) 
		{
			$this->obj->session->unset_userdata('id');
			$this->obj->session->unset_userdata('flash');
		}
		else
		{
			$this->obj->session->set_userdata('flash', !$storable);
			$offset = (int) $this->obj->config->item('id_offset');
			
			 if($storable) 
				$this->obj->session->set_userdata('id', $id * $offset);
		 	else 
		 	{
		 		$this->obj->session->set_flashdata('id', $id * $offset);
		 		$this->obj->session->set_flashdata('expire', time()+$this->obj->config->item('autologin_timeout'));
		 	}
		}
	}
	function getSessionId()
	{ 
		$this->keepSession();
		if($this->obj->session->userdata('flash'))
		{
			if( !$this->obj->session->flashdata('id') )
				return 0;		
		}
		$offset = (int) $this->obj->config->item('id_offset');
		if(!$this->obj->session->userdata('flash'))
			$real_id = ($this->obj->session->userdata('id') / $offset);
		else
			$real_id = ($this->obj->session->flashdata('id') / $offset);
		if(ceil($real_id) != floor($real_id)) 
		{
			$this->logout();
			return 0;
		}
			else 
				return $real_id;
	}
	function keepSession()
	{
		if( ($this->obj->session->userdata('flash')) && ($this->obj->session->flashdata('expire') >= time()) ) 
		{
			$this->obj->session->keep_flashdata('id');
			$this->obj->session->set_flashdata('expire', time()+$this->obj->config->item('autologin_timeout'));
		}   		
	}

	/*
	 * Return TRUE if user is logged on
	 */
	function isLogged() { return (bool) getSessionId();	}

	/*
	 * Return TRUE if user is in group
	 */
	function isGroup($group_name) 
	{
		return ($this->obj->aumodel->getRefId('augroup', $group_name) == $this->obj->aumodel->userInfo($this->getSessionId(), 'group_id')); 
	}

	/*
	 * Return TRUE if user has specified role
	 */
	function isRole($role_name) 
	{
		return ( $this->obj->aumodel->getRefId('aurole', $role_name) == $this->obj->aumodel->userInfo($this->getSessionId(), 'role_id') ); 
	}

	/*
	 * Show "deny access" page
	 */
	function denyAccess()
	{
		$this->obj->load->helper('url');
		redirect('au/denyaccess');
	}

	/*
	 * Create and return captcha
	 * Use standart CI plugin
	 */
	function getCaptcha()
	{
		$this->obj->load->helper('url');
		$this->obj->load->plugin('captcha');
		$vals = array(
						'word' => '',
						'img_path' => $this->obj->config->item('au_captcha_store_path'),
						'img_url' => $this->obj->config->item('au_captcha_img_url'),
						'font_path' => '/system/fonts/texb.ttf',
						'img_width' => '120',
						'img_height' => '40',
						'expiration' => '7200'
						);
		$cap = create_captcha($vals);
		return $cap;		
	}
}
?>