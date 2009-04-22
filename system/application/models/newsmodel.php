<?
class NewsModel extends Model{
	function __construct(){
		parent::Model();
	}
	function getNews($id){
		$this->db->where('id',$id);
		$this->db->set('viewed','viewed+1');
		$this->db->update('news');
		$this->db->where('n.id',$id);
		$this->db->select(array('n.*','u.id as uid','u.login','count(p.id) as pnum'));
		$this->db->join('user as u','n.user_id = u.id','left');
		$this->db->join('news_img as p','n.id = p.news_id','left');
//		$this->db->groupby('n.id');
		return $this->db->get('news as n');
	}
	function getPublishedNews(){
		$this->db->select('n.*, u.id as uid, u.login,count(c.id) as cnum');
		$this->db->join("user as u",'n.user_id=u.id','left');
		$this->db->join("comments as c",'n.id=c.news_id','left');
		$this->db->groupby("n.id");
		return $this->db->get('news as n');
	}
	function getCategories(){
		return $this->db->get('news_category');
	}
	function getImages($id){
		$this->db->where('news_id',$id);
		return $this->db->get('news_img');
	}
	function getComments($id){
		$this->db->where('news_id',$id);
		$this->db->select('c.*, u.id as uid, u.login');
		$this->db->join('user as u','c.user_id=u.id','left');
		return $this->db->get('comments as c');
	}
	function getFaceNews(){
		$this->db->where('type_id',1);
		$this->db->select('n.*, (select path from news_img WHERE news_id=n.id LIMIT 1) as path');
		return $this->db->get("news as n");
	}
	function getNewsByCat($cat_id){
		$this->db->select("n.*,(select count(s.id) from comments as s WHERE s.news_id=n.id) as cnum");
		$this->db->join("news as n","n.id=c.news_id",'left');
		if($cat_id == 0){
			$this->db->where("c.cat_id >",2);
		}else{
			$this->db->where("c.cat_id",$cat_id);
		}
		$this->db->where("n.status",1);
		$this->db->distinct("n.id");
		return $this->db->get("news_cat as c");
	}
}
?>
