<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model{

    public function getYOS()
    {
        $res = $this->db->get("yearorsem");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function getProgrames()
    {
        $res = $this->db->get("programes");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }
    
    public function getBranchData($param = array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
    
        $this->db->select("branches.*, programes.programe_name as programe_name, yearorsem.evs as yos_name");
        $this->db->order_by('id', 'DESC');
        $this->db->join("programes", "programes.id=branches.programe_id", "left");
        $this->db->join("yearorsem", "yearorsem.id=branches.yearorsem_id", "left");
        $res = $this->db->get("branches");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function addBranch($branchArray)
    {
        $this->db->insert("branches", $branchArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function editBranch($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("branches");
        if($res->num_rows()>0){
            return $res->row();
        }
    }

    public function updateBranch($id, $updateArray)
    {   
        $this->db->where('id', $id);
        $this->db->update("branches", $updateArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deleteBranch($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("branches");
        if($this->db->affected_rows()>0){
            return "delete";
        }
    }

    public function searchBranch($search)
    {
        $this->db->select("branches.*, programes.programe_name as programe_name, yearorsem.evs as yos_name");
        $this->db->like("branch_name", $search);
        $this->db->join("programes", "programes.id=branches.programe_id", "left");
        $this->db->join("yearorsem", "yearorsem.id=branches.yearorsem_id", "left");
        $res = $this->db->get("branches");
        return $res->result_array();
    }

    public function branchCount($param = array())
    {
        return $this->db->count_all_results("branches");
    }

    public function viewBranchData($id)
    {
        $this->db->select("branches.*, programes.programe_name as programe_name, yearorsem.evs as yos_name");
        $this->db->where('branches.id', $id);
        $this->db->join("programes", "programes.id=branches.programe_id", "left");
        $this->db->join("yearorsem", "yearorsem.id=branches.yearorsem_id", "left");
        $res = $this->db->get("branches");
        return $res->row_array();
    }

    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('branches')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("branches");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("branches");
           return "activate";
        }
        
    }


    public function getBranchDataForNotes()
    {
        return $this->db->get("branches")->result_array();
    }

}

?>