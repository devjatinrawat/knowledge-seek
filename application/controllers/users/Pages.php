<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users/Users_model', 'UM');
	}

	public function aboutUs()
	{
		$data['subAct'] = "main";
		$data['act'] = "about";
		$this->load->view('users/aboutUs', $data);
	}

	public function contactUs()
	{
		$this->form_validation->set_rules("name", "Name", "required|trim");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|trim");
		$this->form_validation->set_rules("message", "Message", "required|trim");
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		if($this->form_validation->run() == true){

			$inputArray['name'] = $this->input->post('name');
			$inputArray['email'] = $this->input->post('email');
			$inputArray['message'] = $this->input->post('message');
			$inputArray['created_at'] = date("d-m-y H:i:s");

			$this->UM->insertContactData($inputArray);

			$this->load->library("email");

			$this->email->from(set_value('email'), set_value('name'));
			$this->email->to("knowledgeseek21@gmail.com");
			$this->email->subject("Contact Detail");
			$this->email->message($inputArray['message']);
			$this->email->set_newline("\r\n");

			if(!$this->email->send()){
				$show_error($this->email->print_debugger());
				}else{
				$this->session->set_flashdata('mssg', 'THANK YOU');
				 	redirect(base_url().'contact');
				}
				
		}
		else{
			$data['subAct'] = "main";
			$data['act'] = "contact";
			$this->load->view('users/contactUs', $data);
		}
		
	}

}
