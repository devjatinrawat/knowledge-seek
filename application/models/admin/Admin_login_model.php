<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login_model extends CI_Model{

public function getAdminData($username = ""){

    if(empty($username)){
        $res = $this->db->get("admin_data");
            if($res->num_rows() > 0){
                return $res->row();
            }else{
                return "null";
            }
    }else{
    $this->db->where('username', $username);
    $res = $this->db->get("admin_data");
    if($res->num_rows() > 0){
        return $res->row();
    }else{
        return "null";
    }
    }
}

public function changePasswords($password, $id=''){
  if(!empty($id)){
     $this->db->set('password', $password);
    $this->db->where('id', $id);
    $res = $this->db->update('admin_data');
    if($this->db->affected_rows()>0){
        return $res;
    }
  }else{
    $this->db->set('password', $password);
    $this->db->where('id', 1);
    $res = $this->db->update('admin_data');
    if($this->db->affected_rows()>0){
        return $res;
    }
  }
   
}


public function fetch_logedin_user_Data($id){
     $this->db->where('id', $id);
    $res = $this->db->get("admin_data");
    if($res->num_rows() > 0){
        return $res->row();
    }else{
        return "null";
    }
}


public function updateToken($token, $mail){
 
     $this->db->set('token', $token);
    $this->db->where('email', $mail);
    $res = $this->db->update('admin_data');
    if($this->db->affected_rows()>0){
        return $res;
    }
 
}

public function getAdminToken($tkn){
     $this->db->where('token', $tkn);
     $this->db->limit(1);
    $res = $this->db->get("admin_data");
    if($res->num_rows()>0){
        return TRUE;
    }else{
        return FALSE;
    }
}


}


?>