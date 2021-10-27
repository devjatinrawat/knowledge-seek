<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class syllabus_model extends CI_Model{

    public function getUnits()
    {
        $res = $this->db->get("units");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function getSyllabData($id)
    {
        $this->db->select("syllabus.*, units.units as unit_name");
        $this->db->where('syllabus.subject_id', $id);
        $this->db->join("units", "units.id=syllabus.unit_id", "left");
        $res = $this->db->get("syllabus");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }
    
    
    public function getSyllabusData($param = array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
        $res = $this->db->get("subjects");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function addSyllabus($syllabusArray)
    {
            $this->db->insert("syllabus", $syllabusArray);
            if($this->db->affected_rows()> 0){
                return true;
            }else{
                return false;
            }
    }

    public function editSyllabus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("syllabus");
        if($res->num_rows()>0){
            return $res->row();
        }
    }

    public function updateSyllabus($id, $updateArray)
    {   
        $this->db->where('id', $id);
        $this->db->update("syllabus", $updateArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deleteSyllab($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("syllabus");
        if($this->db->affected_rows()>0){
            return "delete";
        }
    }

    public function searchSyllabus($search)
    {
        $this->db->or_like('subjects.sub_name', $search);
        $this->db->or_like('subjects.subject_code', $search);
        $res = $this->db->get("subjects");
        return $res->result_array();
    }

    public function syllabusCount($param = array())
    {
        return $this->db->count_all_results("syllabus");
    }

    public function viewSyllabusData($id)
    {
        $this->db->select("syllabus.*, units.units as unit_name, subjects.sub_name as subject_name");
        $this->db->where('syllabus.id', $id);
        $this->db->join("units", "units.id=syllabus.unit_id", "left");
        $this->db->join("subjects", "subjects.id=syllabus.subject_id", "left");
        $res = $this->db->get("syllabus");
        return $res->row_array();
    }

    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('syllabus')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("syllabus");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("syllabus");
           return "activate";
        }
        
    }



}

?>