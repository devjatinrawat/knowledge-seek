<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syllabus extends CI_Controller {
 public function __construct(){
    parent::__construct();
    if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
        redirect(base_url().'kSeek/control_panel/unlock');
    }
    $this->load->model("admin/syllabus_model", "slly");
    
 }

 public function index()
 {
    $data['unit_data'] = $this->slly->getUnits();
    $data['mainModules'] = "subSection";
    $data['subModules'] = "viewSyllabus";
    $this->load->view("admin/subjectSection/syllabus", $data);
 }

 public function getSyllabData(){
   $id= $this->input->get("sub_id");
   $data['syllab_data'] =  $this->slly->getSyllabData($id);
   echo json_encode($data);
 }

 public function addSyllabus()
 {
         $syllabusArray = array(
            "name" =>  $this->input->post('name'),
             "unit_id" =>  $this->input->post('unit'),
            "subject_id" =>  $this->input->post('getId'),
             "syllabus_detail" =>  $this->input->post('syllabus'),  
             "created_at" => date("d-m-y H:i:s")
     );
       $result = $this->slly->addSyllabus($syllabusArray);
       $msg['success'] = false;
       $msg['type'] = 'add';
       if($result){
           $msg['success'] = true;
       }
         echo json_encode($msg);
 }


 public function getSyllabusData($page= 1)
    {
        $perpage = 6;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage-$perpage);
        $this->load->library("pagination");
        $config['base_url']   = "#";
        $config['total_rows'] =   $this->slly->syllabusCount();
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
        $data['syllabus_data'] =  $this->slly->getSyllabusData($param);
         echo json_encode($data);
    }

  

    public function editSyllabus(){
        $id =$this->input->get("syllabus_id");
       $result = $this->slly->editSyllabus($id);
       echo json_encode($result);
    }

    public function updateSyllabus()
    {
        $id = $this->input->post('getId');  

       $updateArray = array(

          "name" =>  $this->input->post('name'),
          "unit_id" =>  $this->input->post('unit'),
          "subject_id" =>  $this->input->post('updateSub'),
          "syllabus_detail" =>  $this->input->post('syllabus'),  
          "updated_at" => date("d-m-y H:i:s")  

       );
       $result = $this->slly->updateSyllabus($id, $updateArray);
       $msg['success'] = false;
       $msg['type'] = 'update';
       if($result){
           $msg['success'] = true;
       }
       echo json_encode($msg);
      
    }

    public function deleteSyllab()
    {
       $id = $this->input->get("syllab_id");
      $res = $this->slly->deleteSyllab($id);
        echo json_encode($res);
    }


    public function searchSyllabus()
    {
       $search = $this->input->get("search_data");
       $searchData = $this->slly->searchSyllabus($search);
       echo json_encode($searchData);

    }

    public function viewSyllabusData()
    {
      $id =$this->input->get("view_id");
      $result = $this->slly->viewSyllabusData($id);
      echo json_encode($result);
    }

     public function updateStatus()
    {
        $id = $this->input->get("stat_id");
        $res = $this->slly->updateStatus($id);
        echo json_encode($res);
    }

}
?>