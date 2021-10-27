<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
			redirect(base_url().'kSeek/control_panel/unlock');
		}

		$this->load->model('admin/Admin_login_model', 'signin');
	}

	public function index()
	{
		$data['mainModules'] = "dashboard";
		$this->load->view('admin/dashboard', $data);
	}


	public function logedin_pass_change($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');

		if($this->form_validation->run() == true){
			$oldpass = $this->input->post('oldpassword');
			$pass = $this->input->post('password');
			$cpass = $this->input->post('confirmpassword');

			$info = $this->signin->fetch_logedin_user_Data($id);
			$passVerify = password_verify($oldpass, $info->password);
			if($passVerify){

			if($pass == $cpass){
							
				$hashPass = password_hash($pass,  PASSWORD_BCRYPT);
				$res = $this->signin->changePasswords($hashPass, $id);
				if($res){
					$this->session->set_flashdata('p_change', 'PASSWORD CHANGE SUCCESSFULLY');
					redirect(base_url().'dashboard');
				}
				
			}else{
				$this->session->set_flashdata('a_error', 'Password and confirm password are not matched');
					redirect(base_url().'admin_change_password/'.$id);
			}
		}else{
		$this->session->set_flashdata('old_pass_error', 'Password is incorrect');
					redirect(base_url().'admin_change_password/'.$id);
		}
	
		}else{
			$this->load->view('admin/dashboardChangePassword');
		}
	}

}
