<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Papers extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users/Users_papers_model', 'UPM');
	}

    public function index()
	{
        $this->load->model('users/Users_model');
		$data['programe'] = $this->Users_model->getProgrames();
		$data['act'] = "paper";
		$data['subAct'] = "service";
		$this->load->view('users/papers/papers', $data);
	}

	public function papersAjax(){
        $this->load->model('users/Users_model');

		$id = $this->input->get("prog_id");
		$branch_id = $this->input->get("branch_id");
	
		$data['branches'] = $this->Users_model->getBranches($id);
		$data['year_or_sem'] = $this->Users_model->get_year_or_sem($branch_id);

		echo json_encode($data);
	}

	public Function getSubjects(){
		$sub_branch_id = $this->input->get("branch_id");
		$sub_year_or_sem_id =  $this->input->get("year_or_sem_id");
		$data['subjects'] = $this->UPM->getSubjects($sub_branch_id, $sub_year_or_sem_id);
		
		echo json_encode($data);
	}

    public function searchPapers(){
        $val = $this->input->get("search_val");
        $data['searchData'] =$this->UPM->searchPapers($val);

        echo json_encode($data);
    }


    public function showPapers($id){
        $data['papersData'] = $this->UPM->getPapers($id);
      	$this->load->view("users/papers/showPapers", $data);
    }
	

	public function downloadPaper($paper){
		$this->load->helper('download');

		force_download('public/uploads/papers/'.$paper, NULL);
	}

}
