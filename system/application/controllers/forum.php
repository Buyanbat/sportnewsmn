<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum extends Controller{
	var $current_user;
	var $data;
	function __construct(){
		parent::Controller();
		$this->data['current_user'] = $this->userlib->get_current_user();
		$this->data['error'] = $this->userlib->get_error();
		$this->data['notice'] = $this->userlib->get_notice();
		$this->current_user = $this->data['current_user'];
		$this->load->model('Forums');
	}
	function index(){
		$this->load->library('pagination');
		$config['base_url'] = site_url('/forum/index');
		$config['total_rows'] = $this->db->count_all('forum');
		$config['per_page'] = '3';
		$this->pagination->initialize($config);
		$this->data['links'] = $this->pagination->create_links(); 
		$this->data['forums'] = $this->Forums->get_all_forum($config['per_page'], $this->uri->segment(3));
		$this->load->view('forum/index',$this->data);
		
		
	}
	function new_thread(){
		if($this->current_user == NULL){
			$this->userlib->set_error('Энэ хэсэгт нэвтрэхийн тулд логин хийсэн байх шаардлагатай');
			redirect();
		}else {
			if($this->current_user->roll == 3){
				$this->load->library('fckeditor');
				$this->fckeditor->BasePath = 'system/plugins/fckeditor/';
        $this->fckeditor->ToolbarSet = 'Fornews' ;
				$this->data['editor'] = $this->fckeditor->CreateHtml();
				$this->load->view('forum/new',$this->data);
			}else {
				redirect();
			}
		}
	}
	function create_thread(){
		if($this->current_user == NULL){
			$this->userlib->set_error('Энэ хэсэгт нэвтрэхийн тулд логин хийсэн байх шаардлагатай');
			redirect();
		}else {
			if(isset($_POST['btn']) && $this->current_user->roll == 3){
				$this->db->set('user_id',$this->current_user->id);
				$this->db->set('question',$_POST['question']);
				$this->db->set('description',$_POST['body']);
				$this->db->set('created_at',date('Y-m-d H:i:s',time()));
				$this->db->insert('forum');
				redirect(site_url('/forum/thread/')."/".$this->db->insert_id());
			}
		}
	}
	function thread($id=1){
		$threads = $this->Forums->get_thread($id);
		if($threads->num_rows() == 0){
			$this->userlib->set_error('Тохирох мэдээлэл олдсонгүй');
			redirect();
		}else {
			$this->load->library('fckeditor');
			$this->fckeditor->BasePath = 'system/plugins/fckeditor';
			$this->fckeditor->ToolbarSet = 'ForComment';
			$this->fckeditor->Height = '200';
			$this->fckeditor->Width = '450';		
			$this->fckeditor->InstanceName = 'reply';
			$this->load->library('Pagination');
			$config['base_url'] = site_url("/forum/thread/$id");
			$config['total_rows'] = $this->Forums->count_replies($id);
			$config['per_page'] = '30';
			$this->pagination->initialize($config);
			$this->data['links'] = $this->pagination->create_links(); 
			$this->data['replies'] = $this->Forums->get_replies($id,$config['per_page'],$this->uri->segment(4));
			$this->data['editor'] = $this->fckeditor->CreateHtml();
			$this->data['thread'] = $threads->row();
			$this->load->view('forum/thread',$this->data);
		}
	}
	function reply(){
		$this->load->library("Input");
		if($this->current_user != NULL){
			if(isset($_POST['btn'])){
				$this->db->set('reply_id',$this->input->post('rid'));
				$this->db->set('forum_id',$this->input->post('fid'));
				$this->db->set('body',$this->input->post('reply'));
				$this->db->set('user_id',$this->current_user->id);
				$this->db->set('created_at',date('Y-m-d H:i:s',time()));
				$this->db->insert('forum_reply');
				$this->userlib->set_notice('Хэлэлцүүлэгт идэвхитэй оролцсонд баярлалаа.');
				redirect(site_url("/forum/thread/")."/".$this->input->post('fid'));
			}
			
		}else {
			$this->userlib->set_error("Та хэлэлцүүлэгт хариулахын тулд гишүүнээр нэвтэрсэн байх шаардлагатай");
			redirect();
		}
	}
	function up($rid){
		if($this->current_user != NULL){
			$this->db->where('reply_id',$rid);
			$this->db->where('user_id',$this->current_user->id);
			$this->db->where('func',1);
			$scores = $this->db->get('forum_reply_score');
			if($scores->num_rows() == 0){
				$this->db->set('user_id',$this->current_user->id);
				$this->db->set('reply_id',$rid);
				$this->db->set('created_at',date('Y-m-d H:i:s',time()));
				$this->db->set('func',1);
				$this->db->insert('forum_reply_score');
				$this->db->query("update forum_reply set up = up+1 WHERE id=$rid");
				$this->db->where('id',$rid);
				$reply = $this->db->get('forum_reply')->row();
				echo "<a class='upscored' title='Та энэ бичлэгт сайн үнэлгээ өгсөн байна' href='javascript:void(0)'>$reply->up</a>";
			}else {
					$this->db->where('id',$rid);
				$reply = $this->db->get('forum_reply')->row();
				echo "<a class='upscored' title='Та нэг бичлэгт нэг л удаа сайн үнэлгээ өгнө' href='javascript:void(0)'>$reply->up</a>";
			}
		}else {
			$this->db->where('id',$rid);
			$reply = $this->db->get('forum_reply')->row();
			echo "<a class='upscored' title='Та гишүүнээр нэвтэрнэ үү' href='javascript:void(0)'>$reply->up</a>";
		}
	}
	function down($rid){
		if($this->current_user != NULL){
			$this->db->where('reply_id',$rid);
			$this->db->where('user_id',$this->current_user->id);
			$this->db->where('func',2);
			$scores = $this->db->get('forum_reply_score');
			if($scores->num_rows() == 0){
				$this->db->set('user_id',$this->current_user->id);
				$this->db->set('reply_id',$rid);
				$this->db->set('created_at',date('Y-m-d H:i:s',time()));
				$this->db->set('func',2);
				$this->db->insert('forum_reply_score');
				$this->db->query("update forum_reply set down = down+1 WHERE id=$rid");
				$this->db->where('id',$rid);
				$reply = $this->db->get('forum_reply')->row();
				echo "<a class='downscored' title='Та энэ бичлэгт муу үнэлгээ өгсөн байна' href='javascript:void(0)'>$reply->down</a>";
			}else {
				$this->db->where('id',$rid);
				$reply = $this->db->get('forum_reply')->row();
				echo "<a class='downscored' title='Та нэг бичлэгт нэг л удаа муу үнэлгээ өгнө' href='javascript:void(0)'>$reply->down</a>";
			}
		}else {
			$this->db->where('id',$rid);
			$reply = $this->db->get('forum_reply')->row();
			echo "<a class='downscored' title='Та гишүүнээр нэвтэрнэ үү' href='javascript:void(0)'>$reply->down</a>";
		}
	}
}
?>
