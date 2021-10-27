<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Programe_model extends CI_Model{

    public function getProgrameData($param = array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
    
      $this->db->order_by('programes.id', 'DESC');
      $res = $this->db->get("programes");
      if($res->num_rows()>0){
          return $res->result_array();
      }
    }

    public function addPrograme($programeArray)
    {
            $this->db->insert("programes", $programeArray);
            if($this->db->affected_rows()> 0){
                return true;
            }else{
                return false;
            }
    }

    public function editPrograme($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("programes");
        if($res->num_rows()>0){
            return $res->row();
        }
    }

    public function updatePrograme($id, $updateArray)
    {   
        $this->db->where('id', $id);
        $this->db->update("Programes", $updateArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deletePrograme($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("Programes");
        if($this->db->affected_rows()>0){
            return "delete";
        } 
    }

    public function searchPrograme($search)
    {
        $this->db->like("programe_name", $search);
        $res = $this->db->get("programes");
        return $res->result_array();
    }

    public function programeCount($param = array())
    {
        return $this->db->count_all_results("programes");
    }
    
    public function viewProgrameData($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("programes");
        return $res->row_array();
    }

    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('programes')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("programes");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("programes");
           return "activate";
        }
        
    }

}

?>