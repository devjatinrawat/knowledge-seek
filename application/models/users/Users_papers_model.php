<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_papers_model extends CI_Model{

     public function getSubjects($sub_branch_id, $sub_year_or_sem_id){
    
        $idArrays = array(
            "branch_id" => $sub_branch_id,
            "sem_year_id" => $sub_year_or_sem_id,
        );

        $this->db->select("subjects_details.*, subjects.sub_name as sub_name, subjects.subject_code as subject_code");
        $this->db->where($idArrays);
        $this->db->join("subjects","subjects.id=subjects_details.subject_id","left");
        $res = $this->db->get("subjects_details");
       
        if($res->num_rows()>0){
            return $res->result_array();
        }else{
            return "";
        }
      
    }

    public function searchPapers($val){
        $this->db->like("sub_name", $val);
        $this->db->or_like("subject_code", $val);
        $res = $this->db->get("subjects");
        if($res->num_rows()>0){
            return $res->result_array();
        }else{
            return "";
        }
    }


    public function getPapers($id){
        
        $this->db->where("subject_id", $id, "status", 1);
        $res = $this->db->get("papers");
        return $res->result_array();
       
    }

}

?>