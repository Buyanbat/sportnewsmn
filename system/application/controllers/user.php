<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Controller {
	var $data;
	var $current_user;
	function User()
	{
		parent::Controller();
		$this->data['current_user'] = $this->userlib->get_current_user();
		$this->data['error'] = $this->userlib->get_error();
		$this->data['notice'] = $this->userlib->get_notice();
		$this->current_user = $this->data['current_user'];
	}
	
	function index()
	{
		$this->db->orderby('register_date','ASC');
		$this->data['users'] = $this->db->get('user');
		$this->load->view('user/list',$this->data);
	}
	function login()
	{
		if($this->current_user == NULL){
			if(isset($_POST['btn'])){
				$this->db->where('login',$_POST['login']);
				$users = $this->db->get('user');
				if($users->num_rows() == 0){
					$this->userlib->set_error('Логин хийж чадсангүй');
					redirect($_POST['back']);
				}
				else{
					$user = $users->row();
					if($user->password == md5($_POST['password'])){
						$this->session->set_userdata('login',$user->login);
						$this->session->set_userdata('password',$user->password);
						$this->userlib->set_notice("Логин амжилттай боллоо");
						redirect($_POST['back']);
					}
					else 
					{
						$this->userlib->set_error("Логин хийж чадсангүй");
						redirect($_POST['back']);
					}
				}
			}else {
				$this->load->view('user/login',$this->data);
			}
		}else {
			redirect();
		}
	}
	function signup()
	{
		if($this->current_user === NULL){
			if(isset($_POST['btn'])){
				if($this->_valid_unique($_POST['login'],$_POST['email'])){
					$this->db->set('login',$_POST['login']);
					$this->db->set('email',$_POST['email']);
					$this->db->set('password',md5($_POST['password']));
					$this->db->set('register_date',date("Y-m-d H:i:s",time()));
					$this->db->set('status',0);
					$this->db->set('roll',1);
					$this->db->insert('user');
					$this->userlib->set_notice('Бүртгэл амжилттай боллоо');
					redirect(site_url());
				}else {
					$this->userlib->set_error('Бүртгэл хийж чадсангүй');
					redirect(site_url("/user/signup"));
				}
			}
			$this->load->view('user/signup',$this->data);
		}else {
			redirect();
		}
	}
	/***
	* @access private
	* @params string login, string name
	* @return boolean
	* @comment Хэрэглэчийн нэр болон И-мэйл хаяг давтахгүй байлгах
	*/
	function _valid_unique($login,$email){
		$this->db->where('login',$login);
		$this->db->orwhere('email',$email);
		$users = $this->db->get('user');
		if($users->num_rows() === 0){
			return true;
		}else {
			return false;
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
