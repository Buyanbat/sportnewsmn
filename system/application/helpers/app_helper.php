<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function js_include($name)
{
	return "<script type='text/javascript' src='".base_url()."javascript/$name.js"."'></script>";
}
function link_to_remote_tag($value,$options){
	$Obj =& get_instance();
	$Obj->load->library("Ajax");
	return $Obj->ajax->link_to_remote($value,$options);
}

function country_select(){
	$countries = array(
		'Англи' => 'Англи',
		'Испани' => 'Испани',
		'Итали' => 'Итали',
		'Франц' => 'Франц',
		'Герман' => 'Герман',
		'Голланд' => 'Голланд',
		'Шотланд' => 'Шотланд',
	);
	$str = "<select name='country'>";
	foreach ( $countries as $key=>$vall){
		$str .= "<option value='$key'>$vall</option>";
	}$str .= "</select>";
	return $str;
}
function league_select(){
	$Obj =& get_instance();
	$leagues = $Obj->db->get('league');
	$str = "<select name='league'>";
	foreach($leagues->result() as $league){
		$str .= "<option value='$league->id'>$league->name</option>";
	}$str .= "</select>";
	return $str;
}
function team_select(){
	$str = "<select name='team'>";
	$Obj =& get_instance();
	$teams = $Obj->db->get('f_team');
	foreach($teams->result() as $team){
		$str .= "<option value='$team->id'>$team->name</option>";
	} $str .= "</select>";
	return $str; 
}

function css_include($name){
	return "<link type='text/css' rel='stylesheet' href='".base_url("css/$name")."'";
}
function get_all_users(){
	$Obj =& get_instance();
	return $Obj->db->get('user');
}
function replies_replies($id){
	$Obj =& get_instance();
	$Obj->load->model('Forums');
	$replies = $Obj->Forums->get_replies_replies($id);
	if($replies->num_rows() == 0){
		return "";
	} else {
		foreach($replies->result() as $reply){
			$user_url = site_url("/user/show/$reply->uid");
			echo "<div class='forum_child_sub'>";
				echo "<div class='forum_child_sub_header'>";
						echo "<span style='line-height: 25px;'><a href=$user_url onmouseover='User.Show($reply->uid)' onmouseout='User.Hide($reply->id)'>$reply->login</a> бичсэн нь</span>";
						echo "<span style='margin-left: 20px;'>$reply->created_at</span>"; 
				echo "</div>";
				echo "<div class='forum_child_sub_body'><br/>";
					echo "<div class='body'>".$reply->body."</div>";
					echo "<div class='footer'>";
						echo "<ul class='forum_menu' id='forum_sub_menu'>";
							echo "<li class='rup' id=rup_$reply->id> ";
							echo "<a class='upscore' href='javascript:void(0)' title = 'Сайн үнэлгээ өгөх' onclick='Forum.Up($reply->id)'>$reply->up</a>";
						echo "</li>";
						echo "<li class='rdown' id=rdown_$reply->id> ";
								echo "<a class='downscore' href='javascript:void(0)' title = 'Муу үнэлгээ өгөх' onclick='Forum.Down($reply->id)'>$reply->down</a>";
						echo "</li>";
						echo "<li class='rreply' id=rreply_$reply->id>";
							echo "<a class='reply' href='javascript:void(0)' title = 'Хариу бичих' onclick='Forum.ReplyRequest($id)'></a>";
						echo "</li>";
						echo "</ul>";
					echo "</div>";
					
				echo "</div>";
				echo "<div class='forum_child_sub_footer'>";
						
				echo "</div>";
			echo "</div>";
			
		}
	}
}
function user_stats(){
	$Obj =& get_instance();
	$total = $Obj->db->count_all('user');
	$Obj->db->where('status',1);
	$users = $Obj->db->get('user');
	$online = $users->num_rows();
	echo "<span>";
		echo "Нийт $total хэрэглэгч</span>";
		echo "<span>$online хэрэглэгч online байна";
	echo "</span>"; 
}
function anchor_to_user($uid,$login){
	$href_url = site_url("/user/show/$uid");
	$over_url = "User.Show($uid)";
	return "<a href='$href_url' onmouseover='$over_url' onmouseout='User.Quit();'>$login</a>";
}
function anchor_to_news($news_id,$title,$style='',$class='',$id=''){
	$href_url = site_url("/news/read/$news_id");
	return "<a style='$style' class='$class' id='$id' href='$href_url' title='$title'>$title</a>";
}
function anchor_to_edit_news($id){
	$url = site_url("news/edit/$id");
	return "<a class='edit_data' href='$url' title='Мэдээг засварлах'></a>";
}
function anchor_to_delete_news($id){
	$url = site_url("news/delete/$id");
	return "<a class='delete_data' href='$url' title='Мэдээг устгах'></a>";
}
function anchor_to_read_news($id){
	$url = site_url("news/read/$id");
	return "<a class='show_data' href='$url' title='Мэдээг унших'></a>";
}

/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */
