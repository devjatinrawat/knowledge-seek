<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

 public function __construct(){
    parent::__construct();
    if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
        redirect(base_url().'kSeek/control_panel/unlock');
    }
    $this->load->model("admin/Category_model", "cat");
    
 }

	public function index($action = "insert")
	{
		$data['categories'] = $this->cat->getCategories();
		$data['mainModules'] = "blog";
		$data['midModules'] = "categoryBlog";
		$data['subModules'] = "viewCategory";
		$data['insertCat'] = $action;
		$this->load->view("admin/category/list.php",$data);
	}

	public function create()
	{
		$data['mainModules'] = "blog";
		$data['midModules'] = "categoryBlog";
		$data['subModules'] = "createCategory";

		$this->load->library("form_validation");

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
		$this->form_validation->set_rules('name', 'Name' ,'trim|required');

		if ($this->form_validation->run() == TRUE) {
		
				$insertarray['name'] = $this->input->post('name');
				$insertarray['status'] = $this->input->post('status');
				$insertarray['created_at'] = date('d-m-y H:i:s');

				$check = $this->cat->insertCategories($insertarray);
				if($check){
					$insertCat = "inserted";
				redirect(base_url()."category", $insertCat);
				}
				
			
		} else {
			$this->load->view("admin/category/create.php", $data);
		}
	}

	public function edit($id)
	{
		$editcategory = $this->cat->edit($id);
		$data['mainModules'] = "blog";
		$data['midModules'] = "categoryBlog";
		$data['subModules'] = "";

			
		$this->load->library("form_validation");

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
		$this->form_validation->set_rules('name', 'Name' ,'trim|required');

		if ($this->form_validation->run() == TRUE) {

				$insertarray['name'] = $this->input->post('name');
				$insertarray['status'] = $this->input->post('status');
				$insertarray['updated_at'] = date('d-m-y H:i:s');

				$check = $this->cat->update($id,$insertarray);
				if($check){
					$insertCat = "updated";
				redirect(base_url()."category", $insertCat);
				}
		}else{
			$data['editcategory'] = $editcategory;
			$this->load->view("admin/category/edit.php",$data);
		}
	}

	public function delete($id)
	{
		$this->cat->delete($id);
		$this->session->set_flashdata("deleteCat", "Category delete Successfully");
		redirect(base_url()."category");
	}

	public function searchCategory(){
		$search = $this->input->get('searchData');
		$data = $this->cat->searchCategory($search);
	
		echo json_encode($data);
	} 

}