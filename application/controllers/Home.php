<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->helper("text");
		$this->load->model("users/Blogs_model", "blog");
		$data['homearticle'] = $this->blog->homeArticles();
		$data['act'] = "home";
		$data['subAct'] = "main";
		$this->load->view('users/index', $data);
	}

	public function  error404(){
		$this->load->view('users/404_Error');
	}
}
