<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs2 extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users/Blogs_model', 'blog');
	}

    public function index($id)
	{
         $data['blogs'] = $this->blog->getBlogsArticle($id);
        $this->load->view('users/blogs/blogs2', $data);
    }

	public function blogComment($id)
	{
		$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		// $this->form_validation->set_rules("message", "Comment", "trim|required");
	
		$insertarray= $this->input->post();

		if ($this->form_validation->run() == true) {
			if($insertarray['article_id'] == ''){
				$insertarray['article_id'] = $id;
				$insertarray['commented_at'] = date("d-m-y H:i:s");
				$res = $this->blog->addComment($insertarray);
			}else{
				$insertarray['replied_at'] = date("d-m-y H:i:s");
				$res = $this->blog->addReply($insertarray);
			}
			
			if($res){
				$array = array(
				'success' => "comment posted"
			);
		}
		}else{
		
		$array = array(
			"error_check" => "true",
			"allerror" => validation_errors(),
			"name_error" => form_error('name'),
			"mail_error" =>form_error('email'),
			);
		}
		echo json_encode($array);
	}

	

	public function getComments( ){
		$id = $this->input->get('article_id');
		$page = $this->input->get('page');
        $param['offset'] =2*$page;
        $param['limit'] =0;

	  	$data['comments'] = $this->blog->fetchComment($id, $param);
	    $data['reply'] = $this->blog->fetchReply($id);
		$data['count'] = $this->blog->countComment($id);
	
	   echo json_encode($data);

	}

	}
