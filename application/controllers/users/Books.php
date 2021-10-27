<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users/Users_books_model', 'UBM');
	}

    public function index()
	{
		$data['subjects'] = $this->UBM->getSubjects();
		$data['act'] = "book";
		$data['subAct'] = "service";
		$this->load->view('users/books/books', $data);
	}


    public function showBooks($id){
        $data['booksData'] = $this->UBM->getBooks($id);
      	$this->load->view("users/books/showBooks", $data);
    }

	    public function searchBooks(){
        $val = $this->input->get("search_val");
        $data['searchData'] =$this->UBM->searchBooks($val);

        echo json_encode($data);
    }
	

	public function downloadPaper($paper){
		$this->load->helper('download');

		force_download('public/uploads/papers/'.$paper, NULL);
	}

}
