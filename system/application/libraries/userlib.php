<?php
/*
* Created on 2009/03/26
* Created by Buyanbat
*
* Copyright by United solutions International
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserLib
{
	var $object;

	function UserLib()
	{
		$this->object =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	* Checks if the login information is true
	*
	* @access    private
	* @param    string    name
	* @param    string    password
	*
	* @return    boolean    true or false if login correct
	*/
	function _login($name, $pass)	{

		$this->object->db->from('user');
		$this->object->db->where('login', $name);
		$this->object->db->where('password', $pass);

		$query = $this->object->db->get();

		if ($query->num_rows() == 0){
			return FALSE;
		}else{
			return true;
		}
	}

	function _auth(){
		if($this->_sess_auth()){
			return true;
		}else {
			return false;
		}	
	}
	function _cook_auth(){
		$cook_name = get_cookie('login');
		$cook_pass = get_cookie('password');
		if(isset($cook_name) && isset($cook_pass)){
			if($this->login($cook_name,$cook_pass) == true){
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	function _sess_auth(){
		$sess_name = $this->object->session->userdata('login');
		$sess_pass = $this->object->session->userdata('password');
		if($sess_name != '' && $sess_pass != ''){
			if($this->_login($sess_name,$sess_pass) == true){
				return true;				
			}else {
				return false;
			}			
		}else {
			return false;
		}
	}	
		// --------------------------------------------------------------------

	/**
	* Checks if the login information is true
	*
	* @access    private
	* @return    object or boolean    UserObject or false if login correct
	* 
	*/
	function get_current_user(){
		$data = NULL;
		if($this->_auth() == true){
			$current_user = $this->object->session->userdata('login');
			$this->object->db->where('login',$current_user);
			$this->object->db->set('last_activity',date("Y-m-d H:i:s",time()));
			$this->object->db->set('status',1);
			$this->object->db->update('user');
			$this->object->db->where('login',$current_user);
			$data = $this->object->db->get('user')->row();
		}
		return $data;
	}

	function set_error($msg=""){
		$this->object->session->set_flashdata('error',$msg);
	}
	function get_error(){
		return  $this->object->session->flashdata('error');
	}
	function set_notice($msg){
		$this->object->session->set_flashdata('notice',$msg);
	}
	function get_notice(){
			return $this->object->session->flashdata('notice');
	}
} 

?>
