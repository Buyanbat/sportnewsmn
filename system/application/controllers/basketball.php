<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basketball extends Controller{
	var $data;
	var $current_user;
	function Basketball(){
		parent::Controller();
		$this->data['current_user'] = $this->userlib->get_current_user();
		$this->data['error'] = $this->userlib->get_error();
		$this->data['notice'] = $this->userlib->get_notice();
		$this->current_user = $this->data['current_user'];
	}
	function new_game(){
		if($this->current_user == NULL){
			redirect();
		}else {
			if($this->current_user->roll == 3){
				$this->load->library('fckeditor',array('instanceName' => 'content')); 

				$this->fckeditor->BasePath = 'system/plugins/fckeditor/';
        
				$this->data['fck1'] = $this->fckeditor->CreateHtml();
				$this->load->view('game/new',$this->data);
			}else {
				redirect();
			}
		}
	}
	function game(){
		
	}
}
?>
