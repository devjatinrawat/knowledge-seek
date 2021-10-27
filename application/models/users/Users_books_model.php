<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_books_model extends CI_Model{


     public function getSubjects(){

        $this->db->select("DISTINCT(books.subject_id) as subject_id, subjects.sub_name as sub_name");
        $this->db->join("subjects", "subjects.id = books.subject_id");
        $this->db->where("books.status", 1);
        $res = $this->db->get("books");
       
        if($res->num_rows()>0){
            return $res->result_array();
        }else{
            return "";
        }
      
    }

    public function searchBooks($val){
        $this->db->select("DISTINCT(books.subject_id) as subject_id, subjects.sub_name as sub_name");
        $this->db->like("subjects.sub_name", $val);
        $this->db->join("subjects", "subjects.id = books.subject_id");
        $this->db->where("books.status", 1);
        $res = $this->db->get("books");
        if($res->num_rows()>0){
            return $res->result_array();
        }else{
            return "";
        }
    }

    public function getBooks($id){
       $this->db->where('subject_id', $id, 'status', 1);
        $res = $this->db->get("books");
        
        return $res->result_array();
       
    }

}

?>