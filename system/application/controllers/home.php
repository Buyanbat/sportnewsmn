<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Controller{
	var $current_user;
	var $data;
	function __construct(){
		parent::Controller();
		$this->data['current_user'] = $this->userlib->get_current_user();
		$this->data['error'] = $this->userlib->get_error();
		$this->data['notice'] = $this->userlib->get_notice();
		$this->current_user = $this->data['current_user'];
		$this->data['current_page'] = "Home";
	}
	function index(){
		$this->load->model("NewsModel");
		$this->data['news'] = $this->NewsModel->getFaceNews();
		$this->data['fnews'] = $this->NewsModel->getNewsByCat(1);
		$this->data['bnews'] = $this->NewsModel->getNewsByCat(2);
		$this->data['onews'] = $this->NewsModel->getNewsByCat(0);
		$this->load->view('home',$this->data);
	}
}
?>
