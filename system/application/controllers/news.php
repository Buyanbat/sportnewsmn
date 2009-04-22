<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends Controller{
	var $current_user;
	var $data;
	function __construct(){
		parent::Controller();
		$this->data['current_user'] = $this->userlib->get_current_user();
		$this->data['error'] = $this->userlib->get_error();
		$this->data['notice'] = $this->userlib->get_notice();
		$this->current_user = $this->data['current_user'];
		$this->load->model('NewsModel');
	}
	function index(){
		$this->data['news'] = $this->NewsModel->getPublishedNews();
		$this->load->view('news/list',$this->data);
	}
	function insert(){
		if($this->current_user != NULL){
			$this->load->library('fckeditor');
			$this->fckeditor->BasePath = 'system/plugins/fckeditor';
			$this->fckeditor->ToolbarSet = 'Forposts';
			$this->fckeditor->Height = '400';
			$this->fckeditor->Width = '600';
			$this->fckeditor->InstanceName = 'body';
			$this->data['editor'] = $this->fckeditor->CreateHtml();		
			$this->data['cats'] = $this->NewsModel->getCategories();
			$this->load->view('news/new',$this->data);
			
		}else {
			$this->userlib->set_error('Энэ хэсэгт нэвтрэхэд гишүүнээр нэвтэрсэн байх шаардлагатай');
			redirect(site_url('news'));
		}
	}
	function create(){
		if($this->current_user != NULL){
			$this->load->library('Input');
			if(isset($_POST['btn']) && $this->current_user->roll > 1){
				$this->db->set('body',$this->input->post('body'));
				$this->db->set('title',$this->input->post('title'));
				$this->db->set('description',$this->input->post('desc'));
				$this->db->set('status',$this->input->post('status'));
				$this->db->set('user_id',$this->current_user->id);
				$this->db->set('created_at',date('Y-m-d H:i:s',time()));
				$this->db->set('type_id',$this->input->post('face'));
				$this->db->set('down',0);
				$this->db->set('viewed',0);
				$this->db->set('up',0);
				$this->db->insert('news');
				$last_id = $this->db->insert_id();
				$this->_addImg($last_id);
				$this->_addCat($last_id);
				$this->userlib->set_notice('Мэдээг амжилттай орууллаа');
				redirect(site_url("/news/read/".$this->db->insert_id()));
			}else {
				$this->userlib->set_error('Тохирох мэдээлэл олдсонгүй');
				redirect(site_url("news"));
			}
		}
	}
	function read($id='1'){
		$news = $this->NewsModel->getNews($id);
		if($news->num_rows() == 0){
			$this->userlib->set_error('Тохирох мэдээлэл олдсонгүй');
			redirect(site_url("news"));
		}else {
			$this->data['news'] = $news->row();
			$this->data['photos'] = $this->NewsModel->getImages($id);
			if($this->current_user != NULL){
				$this->load->library('fckeditor');
				$this->fckeditor->BasePath = 'system/plugins/fckeditor';
				$this->fckeditor->ToolbarSet = 'ForComment';
				$this->fckeditor->Height = '200';
				$this->fckeditor->Width = '550';
				$this->fckeditor->InstanceName = 'comment_data';
				$this->data['fck'] = $this->fckeditor->CreateHtml();
			}
			$this->data['comments'] = $this->NewsModel->getComments($id);
			$this->load->view('news/read',$this->data);
		}
	}
	function _addImg($news_id){
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '400';
		$config['max_width']  = '2000';
		$config['max_height']  = '1500';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload',$config);
		
		for($i = 1 ; $i <= $_POST['imgNum'] ; $i++){
			if($this->upload->do_upload("img_$i")){
				$datas = $this->upload->data();
				$this->db->set('path',base_url()."images/".$datas['file_name']);
				$this->db->set('news_id',$news_id);
				$this->db->insert('news_img');
			}
		}
	}
	function _addCat($news_id){
		for($i = 1 ; $i <= $_POST['catNum'] ; $i++){
			$this->db->set('news_id',$news_id);
			$this->db->set('cat_id',$_POST["cat_$i"]);
			$this->db->insert('news_cat');
		}
	}
	function add_cat($id){
		$cats = $this->NewsModel->getCategories();
		echo "<select  id='cat_$id' name='cat_$id'>";
			foreach($cats->result() as $cat){
				echo "<option value=$cat->id>$cat->name</option>";
			}
		echo "</select>";
	}
	function addcomment(){
		if($this->current_user == NULL){
			$this->userlib->set_error("Та сэтгэгдэл үлдээхийн тулд гишүүнээр нэвтэрсэн байх шаардагатай");
			redirect(site_url("/news"));
		}else {
			if(isset($_POST['btn'])){
				$news_id = $_POST['news_id'];
				$this->db->set('news_id',$news_id);
				$this->db->set('user_id',$this->current_user->id);
				$this->db->set('up',0);
				$this->db->set('down',0);
				$this->db->set('created_at',date("Y-m-d H:i:s",time()));
				$this->db->set('data',$_POST['comment_data']);
				$this->db->insert("comments");
				$this->userlib->set_notice("Сэтгэгдэл амжилттай илгээгдлээ");
				redirect(site_url("/news/read/$news_id"));
			}
		}
	}
	function edit($id){
		if($this->current_user == NULL){
			$this->userlib->set_error('Уучлаарай энэ хэсэгт нэвтрэхэд таны эрх хүрэхгүй байна');
			redirect(site_url("/news"));
		}
		$posts = $this->NewsModel->getNews($id);
		if($posts->num_rows() == 0){
			$this->userlib->set_error('Тохирох мэдээлэл олдсонгүй');
			redirect(site_url("news"));
		}else {
			$this->data['news'] = $posts;
			$this->load->view('news/edit',$this->data);
		}
	}
}
?>
