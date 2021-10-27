<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Papers extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
            redirect(base_url().'kSeek/control_panel/unlock');
        }
        $this->load->model("admin/Papers_model", "paper");
        
    }

    public function index()
    {
        $data['mainModules'] = "papers";
        $this->load->view("admin/papers/papers", $data);
    }


  public function getSubjectData($page= 1) 
  {
            $perpage = 6;
            $param['offset'] = $perpage;
            $param['limit'] = ($page*$perpage-$perpage);
            $this->load->library("pagination");
            $config['base_url']   = "#";
            $config['total_rows'] =   $this->paper->subjectsCount();
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
            $data['subjects_data'] =  $this->paper->getSubjectData($param);
            echo json_encode($data);
    }


        public function addPapers(){
            $config['upload_path']   = './public/uploads/papers';
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size'] = 100000;
            $config['file_name']  = $this->input->post('name')." ".$this->input->post('year');

            $this->load->library('upload', $config);

                if(!$this->upload->do_upload("papers")) {

                    $error = $this->upload->display_errors();
                    $data['Error'] =  $error;
                   
                }else{

                    $papers_data = $this->input->post();
                    $paper = $this->upload->data();

                    $papers_data['papers'] = $paper['file_name'];
                    $papers_data['created_at'] = date("y-m-d  H:i:s");

                     $result = $this->paper->addPapers($papers_data);
                      if($result){
                            $data['res'] = "add";
                      }else{
                        $data['res'] = "error";
                      }
                }
              echo json_encode($data);
        }


        public function getPapersData(){
             $id= $this->input->get("sub_id");
              $data['papers_data'] =  $this->paper->getPapersData($id);
              echo json_encode($data);
        }

    public function viewPapersData()
    {
      $id =$this->input->get("view_id");
      $result = $this->paper->viewPapersData($id);
      echo json_encode($result);
    }
  

     public function editPaper(){
        $id =$this->input->get("papers_id");
       $result = $this->paper->editPaper($id);
       echo json_encode($result);
    }

    public function updatePapers($id)
    {
        $check = $this->paper->viewPapersData($id);
        if (!empty($_FILES['papers']['name'])) {
            $config['upload_path']   = './public/uploads/papers';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 100000;
            $config['file_name']  = $this->input->post('name')." ".$this->input->post('year');
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload("papers")) {
                $error = $this->upload->display_errors();
                $datas['Error'] =  $error;
               
            }else{
               
                if($check['papers'] != '' && file_exists("./public/uploads/papers/".$check['papers'])){
                  unlink("./public/uploads/papers/".$check['papers']);
                }

                $papers_data = $this->input->post();
                $paper = $this->upload->data();

                $papers_data['papers'] = $paper['file_name'];
                $papers_data['updated_at'] = date("y-m-d  H:i:s");

                 $result = $this->paper->updatePapers($id, $papers_data);
                  if($result){
                        $datas['res'] = "update";
                  }else{
                    $datas['res'] = "error";
                  }
                
            }
        }else{

            $papers_data = $this->input->post();
            $papers_data['updated_at'] = date("d-m-y H:i:s");
            $papers_data['papers'] = $check['papers'];
             $result = $this->paper->updatePapers($id, $papers_data);
              if($result){
                    $datas['res'] = "update";
              }else{
                $datas['res'] = "error";
              }
        }
          echo json_encode($datas);
      
    }

    public function deletePapers()
    {
      $id = $this->input->get("del_id");
      $check = $this->paper->viewPapersData($id);
      if(file_exists("./public/uploads/papers/".$check['papers'])){
        unlink("./public/uploads/papers/".$check['papers']);
      }
      $data['res'] = $this->paper->deletePapers($id);
        echo json_encode($data);
    }

    public function searchPapers()
    {
       $search = $this->input->get("search_data");
       $searchData = $this->paper->searchPapers($search);
       echo json_encode($searchData);

    }

   
     public function updateStatus()
    {
        $id = $this->input->get("stat_id");
        $res = $this->paper->updateStatus($id);
        echo json_encode($res);
    }

}
?>