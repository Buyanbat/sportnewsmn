<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Football extends Controller{
	var $data;
	var $current_user;
	function Football(){
		parent::Controller();
		$this->data['current_user'] = $this->userlib->get_current_user();
		$this->data['error'] = $this->userlib->get_error();
		$this->data['notice'] = $this->userlib->get_notice();
		$this->current_user = $this->data['current_user'];
	}
	function new_team(){
		if($this->current_user == NULL){
			redirect();
		}else {
			if($this->current_user->roll == 3){
				$this->load->library('fckeditor'); 

				$this->fckeditor->BasePath = 'system/plugins/fckeditor/';
        
				$this->data['body'] = $this->fckeditor->CreateHtml();
				$this->load->view('football/new',$this->data);
			}
		}
	}
	function create(){
		if($this->current_user == NULL){
			redirect();
		}else {
			if($this->current_user->roll == 3 && isset($_POST['btn'])){
				$this->db->set('name',$_POST['name']);
				$this->db->set('body',$_POST['body']);
				$this->db->set('logo',$this->_img_upload('logo'));
				$this->db->set('country',$_POST['country']);
				$this->db->set('league_id',$_POST['league']);
				$this->db->insert('f_team');
				redirect(site_url('/football/team/1'));
			}else {
				redirect();
			}
		}
	}
	function _img_upload($index){
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '300';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload($index)){
			return base_url()."/images/nopic.jpg";
		}else {
			$datas =  $this->upload->data();
			return base_url()."/images/".$datas['file_name'];
		}
	}
	function new_player(){
		if($this->current_user == NULL){
			redirect();
		}else {
			if($this->current_user->roll == 3){
				$this->load->view('football/new_player',$this->data);
			}
		}
	}
	function create_player(){
		if($this->current_user == NULL){
			redirect();
		}else {
			if($this->current_user->roll == 3 && isset($_POST['btn'])){
				$this->db->set('name',$_POST['name']);
				$this->db->set('country',$_POST['country']);
				$this->db->set('body',$_POST['body']);
				$this->db->set('team_id',$_POST['team']);
				$this->db->set('photo',$this->_img_upload('photo'));
				$this->db->set('jersey',$this->_img_upload('jersey'));
				$this->db->set('author_id',$this->current_user->id);
				$this->db->set('created_at',date('Y-m-d H:i:s',time()));
				$this->db->insert('f_player');
				$this->userlib->set_notice('Тоглогчийг амжилттай бүртгэлээ');
				redirect(site_url('/football/player/1'));
			}else {
				redirect();
			}
		}
	}
	function player($id=1){
		$this->db->where('id',$id);
		$players = $this->db->get('f_player');
		if($players->num_rows() == 0){
			$this->userlib->set_error('Тохирох мэдээлэл олдсонгүй');
			redirect();
		}else {
			$this->data['player'] = $players->row();
			$this->load->view('football/player',$this->data);
		}
	}
	function team($id=1){
		$this->db->where('id',$id);
		$teams = $this->db->get('f_team');
		if($teams->num_rows() == 0){
			$this->userlib->set_error('Тохирох мэдээлэл олдсонгүй');
			redirect();
		}else {
			$this->data['team'] = $teams->row();
			$this->load->view('football/team',$this->data);
		}
	}
}
?>
