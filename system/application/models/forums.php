<?
class Forums extends Model{
	function __construct(){
		parent::Model();
	}
	function get_all_forum($per_page = NULL, $segment = NULL){
		$this->db->select(array('forum.*','user.id as userid', 'user.login','count(forum_reply.id) as num'));
		$this->db->join('user','user.id = forum.user_id','left');
		$this->db->join('forum_reply ','forum_reply.forum_id=forum.id','left');
		$this->db->group_by('forum.id'); 
		if($per_page == NULL && $segment == NULL){
			return $this->db->get('forum');
		}else{ 
			return $this->db->get('forum',$per_page, $segment);
		}
	}
	function get_thread($id){
		$this->db->where('id',$id);
		return $this->db->get('forum');
	}
	function get_replies($id,$per_page,$segment){
		$this->db->where('forum_id',$id);
		$this->db->select(array('fr.*','u.id as uid','u.login','u.status','u.photo'));
		$this->db->join('user as u', 'u.id = fr.user_id','left');
		$this->db->where('reply_id',0);
		return $this->db->get('forum_reply as fr',$per_page,$segment);
	}
	function count_replies($id){
		$this->db->where('forum_id',$id);
		$this->db->where('reply_id',0);
		return $this->db->count_all_results('forum_reply');
	}
	function get_replies_replies($id){
		$this->db->where('reply_id',$id);
		$this->db->select(array('fr.*','u.id as uid','u.login','u.status','u.photo'));
		$this->db->join('user as u','u.id=fr.user_id','left');
		return $this->db->get('forum_reply as fr');
	}
}
?>
