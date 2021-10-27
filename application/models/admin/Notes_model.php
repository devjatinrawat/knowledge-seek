<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes_model extends CI_Model{

    public function getSyllabus($id)
    {
        $this->db->select("syllabus.*, units.units as unit_name");
        $this->db->where('syllabus.subject_id', $id);
        $this->db->join("units", "units.id=syllabus.unit_id", "left");
        $res = $this->db->get("syllabus");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

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

    public function addNotes($notes_data)
    {
        $this->db->insert("notes", $notes_data);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function getNotesData($id)
    {
        $this->db->select("notes.*, syllabus.name as syllab_name, units.units as unit_name");
        $this->db->where('notes.subject_id', $id);
        $this->db->join("syllabus", "syllabus.id=notes.syllabus_id", "left");
        $this->db->join("units", "units.id=syllabus.unit_id", "left");
        $res = $this->db->get("notes");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function viewNotesData($id)
    {
        $this->db->select("notes.*, syllabus.name as syllab_name, units.units as unit_name");
        $this->db->where('notes.id', $id);
        $this->db->join("syllabus", "syllabus.id=notes.syllabus_id", "left");
          $this->db->join("units", "units.id=syllabus.unit_id", "left");
        $res = $this->db->get("notes");
        return $res->row_array();
    }

    public function editNote($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get("notes");
        if($res->num_rows()>0){
            return $res->row();
        }
    }

    public function updateNotes($id, $updateArray)
    {   
        $this->db->where('id', $id);
        $this->db->update("notes", $updateArray);
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deleteNotes($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("notes");
        if($this->db->affected_rows()>0){
            return "delete";
        } 
    }

     public function searchNotes($search)
    {
        $this->db->or_like("subjects.sub_name", $search);
           $this->db->or_like("subjects.subject_code", $search);
        $res = $this->db->get("subjects");
        return $res->result_array();
    }

    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('notes')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("notes");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("notes");
           return "activate";
        }
        
    }

}

?>