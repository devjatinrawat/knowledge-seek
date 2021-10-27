<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_model extends CI_Model{

    public function getBranch()
    {
        $res = $this->db->get("branches");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function getYos()
    {
       
        $res = $this->db->get("semsandyears");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function addSubject($subjectArray, $subject_Deatil_Array)
    {
        $this->db->insert("subjects", $subjectArray);

        $subject_id = $this->db->insert_id();
        $count = COUNT($subject_Deatil_Array['sem_year_id']);

        for($i=0; $i<$count; $i++){
           
                $data = array(
                    "subject_id"     => $subject_id,
                    "branch_id"    => $subject_Deatil_Array['branch_id'],
                    "sem_year_id"       =>  $subject_Deatil_Array['sem_year_id'][$i]  
                );
                
                $this->db->insert("subjects_details", $data);
           
        } 
         
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

 
    public function getSubjectDetailData($param = array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }

        $this->db->select('subjects_details.*, COUNT(DISTINCT(branch_id)) as branches, COUNT(sem_year_id) as sems_years, subjects.id as sub_id, subjects.sub_name as sub_name, subjects.subject_code as sub_code, subjects.created_at as created_at, branches.branch_name as bName');
        $this->db->join("subjects","subjects.id=subjects_details.subject_id","left");
        $this->db->join("branches","branches.id=subjects_details.branch_id","left");
        $this->db->group_by('subject_id');
        // $this->db->join("semsandyears","semsandyears.id=subjects_detail.yos_id","left");
        $res = $this->db->get("subjects_details");
        if($res->num_rows()>0){
            return $res->result_array();
        }
    }

    public function searchSubject($search)
    {
        $this->db->select('subjects_details.*, COUNT(DISTINCT(branch_id)) as branches, COUNT(DISTINCT(sem_year_id)) as sems_years, subjects.id as sub_id, subjects.sub_name as sub_name, subjects.subject_code as sub_code, subjects.created_at as created_at, branches.branch_name as bName');
        $this->db->like("subjects.sub_name", $search);
        $this->db->or_like("branches.branch_name", $search);
        $this->db->join("subjects","subjects.id=subjects_details.subject_id","left");
        $this->db->join("branches","branches.id=subjects_details.branch_id","left");
        $this->db->group_by('subject_id');
        $res = $this->db->get("subjects_details");
       
        return $res->result_array();
    }

    public function subjectCount($param = array())
    {
        return $this->db->count_all_results("subjects");
    }

    public function fetchSubjectsData($id)
    {
        $this->db->where("id" , $id);
        $result = $this->db->get("subjects");
        return $result->row_array();
    }

    public function updateSubject($id, $subjectArray)
    {   
         $this->db->where("id", $id);
         $this->db->update("subjects", $subjectArray);
         
        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function deleteSubject($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("subjects");
        if($this->db->affected_rows()>0){
            return "delete";
        }
      
    }
    public function deleteSubjectsDetail($id)
    {
        $this->db->where('subject_id', $id);
        $this->db->delete("subjects_details");

        $this->db->where('subject_id', $id);
        $this->db->delete("syllabus");

        $this->db->where('subject_id', $id);
        $this->db->delete("notes");

        $this->db->where('subject_id', $id);
        $this->db->delete("papers");

        $this->db->where('subject_id', $id);
        $this->db->delete("books");
        if($this->db->affected_rows()>0){
            return "delete";
        }
      
    }

    public function updateStatus($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('subjects')->row();
        if($res->status == 1){
            $this->db->where('id', $id);
           $this->db->set('status', 0);
           $this->db->update("subjects");
           return "deactivate";
        }else{
            $this->db->where('id', $id);
            $this->db->set('status', 1);
           $this->db->update("subjects");
           return "activate";
        }
        
    }

    public function get_subjects_detail_for_delete()
    {
        return $this->db->get("subjects_details")->result_array();
    }

     // adding fields  functions

    public function addSubjectFields($subject_Deatil_Array)
    {    
        $count = COUNT($subject_Deatil_Array['sem_year_id']);
        $sub_id =  $subject_Deatil_Array['subject_id'];
        for($i=0; $i<$count; $i++){
                $data = array(
                    "subject_id"     => $sub_id ,
                    "branch_id"    => $subject_Deatil_Array['branch_id'],
                    "sem_year_id"       =>  $subject_Deatil_Array['sem_year_id'][$i]  
                );
                
            $this->db->insert("subjects_details", $data); 
        } 

        if($this->db->affected_rows()> 0){
            return true;
        }else{
            return false;
        }
    }

    public function getSubjectsFeild($sub_id)
    {    
        $this->db->select('subjects_details.*, branch_id as branchID, branches.branch_name as branchName');
        $this->db->join("branches","branches.id=subjects_details.branch_id","left");
        $this->db->where('subjects_details.subject_id', $sub_id);
        $this->db->group_by('subjects_details.branch_id');
        $res = $this->db->get("subjects_details");
        return $res->result_array();
    }

    public function getSubjectsFeildForProgram($sub_id, $branch_id)
    {
         $this->db->select('subjects_details.*,sem_year_id as sem_year_ID, semsandyears.sem_year as sem_year_Name');
         $this->db->join("semsandyears","semsandyears.id=subjects_details.sem_year_id","left");
         $this->db->where('subjects_details.subject_id', $sub_id, 'subjects_details.branch_id', $branch_id);
          $res = $this->db->get("subjects_details");
          return $res->result_array();
    }
  
    public function deleteField($sub_id, $branch_id)
    {
        $this->db->where('subject_id', $sub_id);
        $this->db->where('branch_id', $branch_id);
        $this->db->delete("subjects_details");
        if($this->db->affected_rows()> 0){
            return "deleteFields";
        }else{
            return "false";
        }
    }

    // ===================================================================================== //
    //                  fetch data from notes, books and papers using subject_id              //
    // ===================================================================================== //


    public function fetchPaperPdfData($id)
    {
        $this->db->where("subject_id", $id);
        $res = $this->db->get("papers");
        if($res->num_rows()>0){
             return $res->row_array();
        }
         
    }

    public function fetchNotePdfData($id)
    {
        $this->db->where("subject_id", $id);
        $res = $this->db->get("notes");
        if($res->num_rows()>0){
             return $res->row_array();
        }
    }

    public function fetchBookPdfData($id)
    {
        $this->db->where("subject_id", $id);
        $res = $this->db->get("books");
         if($res->num_rows()>0){
             return $res->row_array();
        }
    }


}

?>