<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Papers_model extends CI_Model{

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

    public function addPapers($papers_data)
    {
        $this->db->insert("papers", $papers_data);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }


    public function getPapersData($id)
    {
        $this->db->where('subject_id', $id);
        $res = $this->db->get("papers");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function viewPapersData($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("papers");
        return $res->row_array();
    }

    public function editPaper($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("papers");
        if($res->num_rows()>0){
            return $res->row();
        }
    }

    public function updatePapers($id, $updateArray)
    {   
        $this->db->where('id', $id);
        $this->db->update("papers", $updateArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deletePapers($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("papers");
        if($this->db->affected_rows()>0){
            return "delete";
        }
      
    }

    public function searchPapers($search)
    {
        $this->db->or_like("subjects.sub_name", $search);
           $this->db->or_like("subjects.subject_code", $search);
        $res = $this->db->get("subjects");
        return $res->result_array();
    }


    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('papers')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("papers");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("papers");
           return "activate";
        }
        
    }

}

?>