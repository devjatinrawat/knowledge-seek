<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model{

    public function getContacts($param = array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
        $this->db->order_by('contact_data.id', "DSEC");
        $res = $this->db->get('contact_data');
        if($res->num_rows()>0){
            return $res->result_array();
        }else{
            return false;
        }
   
    }

    public function totalData($param = array())
    {
        return $this->db->count_all_results('contact_data');
    }

    public function getContactInfo($id)
    {
       $this->db->where('id', $id);
       $result = $this->db->get('contact_data');
       return $result->row();
    }

    
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("contact_data");
	}
}
?>