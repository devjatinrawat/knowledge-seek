<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Books_model extends CI_Model{

    public function getSubjectData($param = array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
       $res = $this->db->get("subjects");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function subjectsCount()
    {
        return $this->db->count_all_results("subjects");
    }

    public function addBooks($books_data)
    {
        $this->db->insert("books", $books_data);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }


    public function getBooksData($id)
    {
        $this->db->where('subject_id', $id);
        $res = $this->db->get("books");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function viewBooksData($id)
    {  
        $this->db->where('id', $id);
        $res = $this->db->get("books");
        return $res->row_array();
    }

    public function editBook($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("books");
        if($res->num_rows()>0){
            return $res->row();
        }
    }

    public function updateBooks($id, $updateArray)
    {   
        $this->db->where('id', $id);
        $this->db->update("books", $updateArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deleteBooks($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("books");
        if($this->db->affected_rows()>0){
            return "delete";
        }
      
    }

    public function searchBooks($search)
    {
        $this->db->or_like("subjects.sub_name", $search);
           $this->db->or_like("subjects.subject_code", $search);
        $res = $this->db->get("subjects");
        return $res->result_array();
    }


    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('books')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("books");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("books");
           return "activate";
        }
        
    }

}

?>