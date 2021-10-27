<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Comment extends CI_Controller {
    public function __construct(){
        parent::__construct();

         if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
        redirect(base_url().'kSeek/control_panel/unlock');
    }
     $this->load->model("admin/Comment_model", "cmmt");
    }


    public function index($id){
       
        $data["comments"] = $this->cmmt->getComments($id);
        $data['mainModules'] = "blog";
		$data['midModules'] = "articleBlog";
		$data['subModules'] = "viewArticle";
        $this->load->view("admin/comments/comments.php", $data);
    
    }

    public function getReplies(){
          $id = $this->input->get("id");
        $data['reply'] = $this->cmmt->getReply($id);
        echo json_encode($data);
    }

       public function delete($id, $article_id){
      	$this->cmmt->delete($id, $article_id);
		$this->session->set_flashdata("deleteComment", "Delete Successfully");
		redirect(base_url()."comments/".$article_id);
    }



       public function deleteReply($id, $article_id){
      	$this->cmmt->deleteReply($id);
		$this->session->set_flashdata("deleteReply", "Delete Successfully");
		redirect(base_url()."comments/".$article_id);
    }
    


} 

?>