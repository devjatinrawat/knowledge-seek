<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs_model extends CI_Model{

public function getCategory(){
    $this->db->where("status", 1);
    $res = $this->db->get("categories");
    if($res->num_rows()>0){
        return $res->result_array(); 
    }else{
        return false;
    }
}

public function get_article($id=""){
      if($id == ""){
        $this->db->select("articles.*, categories.name as category_name");
        $this->db->where("articles.status", 1);
        $this->db->join("categories", "categories.id = articles.category_id");
        $this->db->order_by("id", "DESC");
        $res = $this->db->get("articles");
    
        if($res->num_rows() > 0){
            return $res->row_array(); 
        }else{
            return "null";
        }
    }else{
        $this->db->select("articles.*, categories.name as category_name");
        $this->db->where("articles.category_id", $id);
        $this->db->join("categories", "categories.id = articles.category_id");
        $this->db->order_by("id", "DESC");
        $res = $this->db->get("articles");
    
        if($res->num_rows()>0){
            return $res->row_array(); 
        }else{
            return 'null';
        }
    }
   
}

public function getAllArticles($id, $cat_id=""){
    if($id != "" && $cat_id ==""){
        $this->db->select("articles.*, categories.name as category_name");
        $this->db->where("articles.id !=", $id);
        $this->db->join("categories", "categories.id = articles.category_id");
        $this->db->order_by("id", "DESC");
        $res = $this->db->get("articles");
        
        if($res->num_rows()>0){
            return $res->result_array(); 
        }else{
            return false;
        }
    }else{
        $this->db->select("articles.*, categories.name as category_name");
        $this->db->where('articles.category_id', $cat_id);
        $this->db->join("categories", "categories.id = articles.category_id");
        $this->db->order_by("id", "ASC");
        $res = $this->db->get("articles");
        
        if($res->num_rows()>0){
            return $res->result_array(); 
        }else{
            return false;
        }
    }
}


public function getBlogsArticle($id){
        $this->db->select("articles.*, categories.name as category_name");
        $this->db->where('articles.id', $id);
        $this->db->join("categories", "categories.id = articles.category_id");
        $res = $this->db->get("articles");
        if($res->num_rows()>0){
            return $res->row_array(); 
        }else{
            return false;
        }
}

public function getSideMenu(){
      
        $this->db->select("articles.*, categories.name as category_name");
        $this->db->join("categories", "categories.id = articles.category_id");
        $this->db->order_by("articles.id", "DESC");
        $this->db->limit("5");
        $res = $this->db->get("articles");
     if($res->num_rows()>0){
            return $res->result_array(); 
        }else{
            return false;
        }
    
}

// home page

    public function homeArticles(){
        $this->db->select("articles.*, categories.name as category_name");
            $this->db->join("categories", "categories.id = articles.category_id");
            $this->db->order_by("articles.id", "DESC");
            $this->db->limit("15");
            $res = $this->db->get("articles");
            if($res->num_rows()>0){
                return $res->result_array(); 
            }else{
                return false;
            }
    }

    public function addComment($comment){
            return $this->db->insert('comment', $comment);
    }

     public function addReply($reply){
            return $this->db->insert('comment_reply', $reply);
    }

    public function countComment($id){
          $this->db->where('article_id', $id);
        return $this->db->count_all_results('comment');
    }       

    public function fetchComment($id, $param = array()){

        $this->db->where('article_id', $id);
         if (isset($param['offset']) && isset($param['limit'])) {
			$this->db->limit($param['offset'], $param['limit']);
		}
        $result = $this->db->get('comment');
        if($result->num_rows()>0){
            return $result->result_array();
        }else{
            return 0;
        }
    }

     public function fetchReply($id){
        $this->db->where('article_id', $id);
        $result = $this->db->get('comment_reply');
        if($result->num_rows()>0){
            return $result->result_array();
        }
    }
    

}

?>