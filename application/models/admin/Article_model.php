<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

public function insert($inputarray)
	{

		$this->db->insert("articles", $inputarray);
		return $this->db->insert_id();
	}		

public function select($param = array())
	{	
		if (isset($param['offset']) && isset($param['limit'])) {
			$this->db->limit($param['offset'], $param['limit']);
		}

		$fetcharticle = $this->db->get("articles")->result_array();
		return $fetcharticle;
	}	

public function selectcount($param = array())
	{

		$count = $this->db->count_all_results("articles");
		return $count;
	}	

public function getarticle($id)
{

	$this->db->where("id", $id);
	$editarticle = $this->db->get("articles")->row_array();
		return $editarticle;
}	

public function editarticle($id, $inputarray){

	$this->db->where("id", $id);
	$this->db->update("articles", $inputarray);

}

public function deletearticle($id)
{
	$this->db->where("id", $id);
	$this->db->delete("articles");

	}

public function searchArticle($search){	
	$this->db->or_like('title', $search);
	$this->db->or_like('author', $search);
	$res = $this->db->get("articles");
	if($res->num_rows()>0){
		return $res->result_array();
	}
}

// comments
public function deleteComments($id)
{
	$this->db->where("article_id", $id);
	$this->db->delete("comment");

}
public function deleteReplies($id)
{
	$this->db->where("article_id", $id);
	$this->db->delete("comment_reply");

}

// // frontend
// public function blogs($param = array())
// 	{	
// 		if (isset($param['offset']) && isset($param['limit'])) {
// 			$this->db->limit($param['offset'], $param['limit']);
// 		}

// 		if (isset($param['q'])){
// 			$this->db->or_like("title", $param['q']);
// 			$this->db->or_like("author", $param['q']);
// 			$this->db->or_like("name", $param['q']);
// 		}
		
// 		$this->db->select('articles.*,categories.name as category_name');
// 		$this->db->order_by("articles.created_at","DESC");
// 		$this->db->where("articles.status=1");
// 		$this->db->join("categories","categories.id=articles.category","left");

// 		$fetchblog = $this->db->get("articles")->result_array();
// 		return $fetchblog;
// 	}

// public function categoriesblogs($categoryid, $param = array())
// 	{	
// 		if (isset($param['offset']) && isset($param['limit'])) {
// 			$this->db->limit($param['offset'], $param['limit']);
// 		}

// 		if (isset($param['q'])){
// 			$this->db->or_like("title", $param['q']);
// 			$this->db->or_like("author", $param['q']);
// 			$this->db->or_like("name", $param['q']);
// 		}
		
// 		$this->db->select('articles.*,categories.name as category_name');
// 		$this->db->order_by("articles.created_at","DESC");
// 		$this->db->where("articles.category=$categoryid");
// 		$this->db->join("categories","categories.id=articles.category","left");

// 		$fetchcategoryblog = $this->db->get("articles")->result_array();
// 		return $fetchcategoryblog;
// 	}

// 	public function showblogs($articleid)
// 	{	
		
// 		$this->db->select('articles.*,categories.name as category_name');
// 		$this->db->where("articles.id=$articleid");
// 		$this->db->join("categories","categories.id=articles.category","left");

// 		$fetchblog = $this->db->get("articles")->row_array();
// 		return $fetchblog;
// 	}	
	


 }