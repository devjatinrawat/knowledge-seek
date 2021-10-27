<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

    public function getProgrames() {
        $res = $this->db->get("programes");
        if($res->num_rows()>0){
            return $res->result_array();
        }else{
            return "null";
        }
    }

    public function getBranches($id) {
        $html = "";
        $this->db->where("programe_id", $id);
        $res = $this->db->get("branches");
        if($res->num_rows()>0){
           $html .= '<option>Select Branches</option>';
            foreach($res->result_array() as $val){
                $html .= '<option value="'.$val['id'].'" >'. $val['branch_name'].'</option>';
            }

            return $html;
         }else{
            return $html="";
        }
    }

    public function get_year_or_sem($id){
         if(!empty($id)){
            $this->db->where("id", $id);
            $b_res =  $this->db->get("branches")->row();
            $b_id = $b_res->yearorsem_id;
             $html = "";
        $this->db->where("yos_id", $b_id);
        $res = $this->db->get("semsandyears");
        if($res->num_rows()>0){
           $html .= '<option>Select Semester/Years</option>';
            foreach($res->result_array() as $val){
                $html .= '<option value="'.$val['id'].'">'. $val['sem_year'].'</option>';
            }
            return $html;
        }else{
            return $html="";
        }
 }
        
    }


    public function insertContactData($inputArray){
        $this->db->insert('contact_data', $inputArray);
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

}

?>