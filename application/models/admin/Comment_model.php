<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_MOdel{

public function getComments($id){

    $this->db->where('article_id', $id);
    $res= $this->db->get("comment");
    if($res->num_rows()>0){
        return $res->result_array();
    }
}

public function countComments(){
    return $this->db->count_all_results("comment");
}


public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("comment");
	}


public function getReply($id){
         $this->db->where('comment_id', $id );
        $res= $this->db->get("comment_reply");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }


public function deleteReply($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("comment_reply");
	}

    
}

?>