<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function user_auth(){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$CI->db->where('TIMEDIFF(CURRENT_TIMESTAMP,last_activity) > ','00:30:00');
	$CI->db->set('status',0);
	$CI->db->update('user');
}
?>
