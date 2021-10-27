<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function insertCategories($insertarray)
	{
		$this->db->insert("categories", $insertarray);
		if($this->db->affected_rows()>0){
			return true;
		}
		
	}

	public function getCategories()
	{
		
		$category = $this->db->get("categories")->result_array();
		return $category;
	}

	public function edit($id)
	{
		$this->db->where('id',$id);
		$result = $this->db->get("categories")->row_array();
		return $result;
	}

	public function update($id,$insertarray)
	{
		$this->db->where('id',$id);
		$this->db->update("categories", $insertarray);
			if($this->db->affected_rows()>0){
			return true;
		}
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("categories");
	}

	public function searchCategory($search){
		$this->db->like('name', $search);
		$res = $this->db->get("categories");
	
			return $res->result_array();
		
		
	}

	// frontend// frontend// frontend// frontend

	// public function categorycount($param = array())
	// {

	// 	if (isset($param['q'])){
	// 		$this->db->or_like("name", $param['q']);
	// 	}
	// 	$count = $this->db->count_all_results("categories");
	// 	return $count;
	// }	

	
	// 	public function getCategoriesfront($param = array())
	// {

	// 	if (isset($param['offset']) && isset($param['limit'])) {
	// 		$this->db->limit($param['offset'], $param['limit']);
	// 	}

	// 	if (isset($param['q'])){
	// 		$this->db->like("name", $param['q']);
	// 	}
	// 	$this->db->where("status=1");
	// 	$category = $this->db->get("categories")->result_array();
	// 	return $category;
	// }
	
}