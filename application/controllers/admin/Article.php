<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

  public function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
            redirect(base_url().'kSeek/control_panel/unlock');
        }
        $this->load->model("admin/Article_model", "article");
        
    }

	public function index($page=1){

		$perpage = 5;
		$param['offset'] = $perpage;
		$param['limit'] = ($page*$perpage-$perpage); 
	
		$this->load->library("pagination");
		$config['base_url']   = base_url('admin/article/index');
		$config['total_rows'] = $this->article->selectcount($param);
		$config['per_page'] = $perpage;
		$config['use_page_numbers'] = true;

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open']   = "<li class='page_item'>";
		$config['num_tag_close']   = "</li>";
		$config['cur_tag_open'] = "<li class='disabled page_item'><li class='active page_item'><a href='#' class=\"page-link\">";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] =  "<li class=\"page-item\">";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li class=\"page-item\">";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li class=\"page-item\">";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] =  "<li class=\"page-item\">";
		$config['last_tagl_close'] = "</li>";	
		$config['attributes'] = array('class' => 'page-link');	

		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$fetcharticle = $this->article->select($param);

		$data['fetcharticle'] = $fetcharticle;
		$data['pagination_link'] = $pagination_link;
		$data['mainModules'] = "blog";
		$data['midModules'] = "articleBlog";
		$data['subModules'] = "viewArticle";

		$this->load->view('admin/article/list.php', $data);

	}

	public function create(){

		
		$this->load->model("admin/Category_model");
		$categories = $this->Category_model->getCategories();
		$data['categories'] = $categories;

		$data['mainModules'] = "blog";
		$data['midModules'] = "articleBlog";
		$data['subModules'] = "createArticle";

		$config['upload_path']   = './public/uploads/articles/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']  = TRUE;

		$this->load->library('upload', $config);

		$this->load->library("form_validation");

		$this->form_validation->set_rules('category_id', 'Category' ,'trim|required');
		$this->form_validation->set_rules('title', 'Title' ,'trim|required');
		$this->form_validation->set_rules('discription', 'Discription', 'trim|required');
		$this->form_validation->set_rules('author', 'Author' ,'trim|required');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			if (!empty($_FILES['image']['name'])) {

				if ($this->upload->do_upload('image')) {
					$data = $this->upload->data();
				$inputarray['image'] = $data['file_name'];
				$inputarray['category_id']	= $this->input->post('category_id');
				$inputarray['title']	= $this->input->post('title');
				$inputarray['discription']	= $this->input->post('discription');
				$inputarray['author']	= $this->input->post('author');
				$inputarray['status']	= $this->input->post('status');
				$inputarray['created_at']	= date("d-m-y H:i:s");

				$this->article->insert($inputarray);
				$this->session->set_flashdata("insertAr", "Article added sucessfully");
				redirect(base_url()."article");
				
				}else{
					$error = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
				    $data['imageError'] =  $error;
					$this->load->view("admin/article/create.php",$data);
				}
			}else{

				$inputarray['category_id']	= $this->input->post('category_id');
				$inputarray['title']	= $this->input->post('title');
				$inputarray['discription']	= $this->input->post('discription');
				$inputarray['author']	= $this->input->post('author');
				$inputarray['status']	= $this->input->post('status');
				$inputarray['created_at']	= date("d-m-y H:i:s");

				$this->article->insert($inputarray);
				$this->session->set_flashdata("insertAr", "Article added sucessfully");
				redirect(base_url()."article");

			}	

		}else{
		$this->load->view('admin/article/create.php', $data);
		}

	}


	public function edit($id){

		$this->load->model("admin/Category_model");
		$categories = $this->Category_model->getCategories();

		$articledetail = $this->article->getarticle($id);

		$data['categories'] = $categories;
		$data['articledetail'] = $articledetail;
		$data['mainModules'] = "blog";
		$data['midModules'] = "articleBlog";
		$data['subModules'] = "";


		$config['upload_path']   = './public/uploads/articles/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']  = TRUE;

		$this->load->library('upload', $config);

		$this->load->library("form_validation");

		$this->form_validation->set_rules('category_id', 'Category' ,'trim|required');
		$this->form_validation->set_rules('title', 'Title' ,'trim|required');
		$this->form_validation->set_rules('discription', 'Discription', 'trim|required');
		$this->form_validation->set_rules('author', 'Author' ,'trim|required');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			if (!empty($_FILES['image']['name'])) {

				if ($this->upload->do_upload('image')) {

					$data = $this->upload->data();

					if ($articledetail['image'] != "" && file_exists("./public/uploads/articles/".$articledetail['image'])) {
					 unlink("./public/uploads/articles/".$articledetail['image']);
				}



				$inputarray['image'] = $data['file_name'];
				$inputarray['category_id']	= $this->input->post('category_id');
				$inputarray['title']	= $this->input->post('title');
				$inputarray['discription']	= $this->input->post('discription');
				$inputarray['author']	= $this->input->post('author');
				$inputarray['status']	= $this->input->post('status');
				$inputarray['updated_at']	= date("d-m-y H:i:s");

				$this->article->editarticle($id, $inputarray);
				$this->session->set_flashdata("updateAr", "Article updated sucessfully");
				redirect(base_url()."article");
				
				}else{
					$error = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
				    $data['imageError'] =  $error;
					$this->load->view('admin/article/edit', $data);				}
			}else{

				$inputarray['category_id']	= $this->input->post('category_id');
				$inputarray['title']	= $this->input->post('title');
				$inputarray['discription']	= $this->input->post('discription');
				$inputarray['author']	= $this->input->post('author');
				$inputarray['status']	= $this->input->post('status');
				$inputarray['updated_at']	= date("d-m-y H:i:s");

				$this->article->editarticle($id, $inputarray);
				$this->session->set_flashdata("updateAr", "Article updated sucessfully");
				redirect(base_url()."article");

			}	

		}else{
		
		$this->load->view('admin/article/edit', $data);
	}
	}

public function delete($id)
{
	$this->load->model("admin/Article_model");
		 $articles = $this->Article_model->getarticle($id);

		if (empty($articles)) {
			$this->session->set_flashdata('error','Article not found');
				redirect(base_url()."admin/article/index");
			}

			if (file_exists("./public/uploads/articles/".$articles['image'])) {
					 unlink("./public/uploads/articles/".$articles['image']);
				}

		$this->Article_model->deleteComments($id);
		$this->Article_model->deleteReplies($id);

		$this->Article_model->deletearticle($id);
		$this->session->set_flashdata("deleteAr", "Article delete Successfully");
		redirect(base_url()."article");
}

	public function searchArticle(){	
		$search = $this->input->get('searchData');
		$data = $this->article->searchArticle($search);

		echo json_encode($data);
	}

}