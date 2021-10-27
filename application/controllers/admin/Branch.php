<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {
 public function __construct(){
    parent::__construct();
    if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
        redirect(base_url().'kSeek/control_panel/unlock');
    }
    $this->load->model("admin/Branch_model", "branch");
    
 }

 public function index()
 {
    $data['yos_data'] = $this->branch->getYOS();
    $data['prog_data'] = $this->branch->getProgrames();
    $data['mainModules'] = "branch";
    $this->load->view("admin/branch/branch", $data);
 }

 public function addBranch()
 {
         $branchArray = array(
              "programe_id" =>  $this->input->post('programe'),
             "branch_name" =>  $this->input->post('name'),
             "yearorsem_id" =>  $this->input->post('yos'),
             "created_at" => date("y-m-d  H:i:s")
     );
       $result = $this->branch->addBranch($branchArray);
       $msg['success'] = false;
       $msg['type'] = 'add';
       if($result){
           $msg['success'] = true;
       }
         echo json_encode($msg);
 }


 public function getBranchData($page= 1)
    {
        $perpage = 6;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage-$perpage);
        $this->load->library("pagination");
        $config['base_url']   = "#";
        $config['total_rows'] =   $this->branch->branchCount();
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
        $data['pagination_link'] = $pagination_link;
        $data['branch_data'] =  $this->branch->getBranchData($param);
         echo json_encode($data);
    }

  

    public function editBranch(){
        $id =$this->input->get("branch_id");
       $result = $this->branch->editBranch($id);
       echo json_encode($result);
    }
    public function updateBranch()
    {
        $id = $this->input->post('getId');
        
       $updateArray = array(
        "programe_id" =>  $this->input->post('programe'),
        "branch_name" =>  $this->input->post('name'),
        "yearorsem_id" =>  $this->input->post('yos'),
           "updated_at" => date("y-m-d  H:i:s")  
       );
       $result = $this->branch->updateBranch($id, $updateArray);
       $msg['success'] = false;
       $msg['type'] = 'update';
       if($result){
           $msg['success'] = true;
       }
       echo json_encode($msg);
      
    }

    public function deleteBranch()
    {
      $id = $this->input->get("del_id");
      $data['res'] = $this->branch->deleteBranch($id);
        echo json_encode($data);
    }
    public function searchBranch()
    {
       $search = $this->input->get("search_data");
       $searchData = $this->branch->searchBranch($search);
       echo json_encode($searchData);

    }

    public function viewBranchData()
    {
      $id =$this->input->get("view_id");
      $result = $this->branch->viewBranchData($id);
      echo json_encode($result);
    }
     public function updateStatus()
    {
        $id = $this->input->get("stat_id");
        $res = $this->branch->updateStatus($id);
        echo json_encode($res);
    }
}
?>