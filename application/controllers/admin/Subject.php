<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
            redirect(base_url().'kSeek/control_panel/unlock');
        }

        $this->load->model("admin/Subject_model", "sub");
    }

    public function index()
    {
        $data['yos_data'] = $this->sub->getYos();
        $data['branchData'] = $this->sub->getBranch();
        $data['mainModules'] = "subSection";
         $data['subModules'] = "viewSubjects";
        $this->load->view("admin/subjectSection/subject", $data);
    }

     
    public function addSubject()
    {
        $subjectArray = array(
            "sub_name" => $this->input->post('name'),
            "subject_code" => $this->input->post('code'),
            "created_at" =>date("y-m-d H:i:s")
        );
            
        $subject_Deatil_Array = array(
            "branch_id" => $this->input->post('branches'),
            "sem_year_id" => $this->input->post('yos')
        );

        $result = $this->sub->addSubject($subjectArray, $subject_Deatil_Array);

        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }


    public function getSubjectData($page= 1)
    {
        $perpage = 10;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage-$perpage);
        
        $this->load->library("pagination");
        $config['base_url']   = "#";
        $config['total_rows'] =   $this->sub->subjectCount();
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
        $data['subject_detail_data'] =  $this->sub->getSubjectDetailData($param);
        echo json_encode($data);
    }

  

    public function editSubject()
    {
    
        $id = $this->input->get("edit_id");
        $result = array(
            "subjects" => $this->sub->fetchSubjectsData($id)
        );
    
        echo json_encode($result);
    }

    public function updateSubject()
    {
        $id = $this->input->post("upID");
       
          $subjectArray = array(
            "sub_name" => $this->input->post('name'),
            "subject_code" => $this->input->post('code'),
            "updated_at" =>date("y-m-d H:i:s")
        );
            
        $result = $this->sub->updateSubject($id, $subjectArray);

        $msg['success'] = false;
        $msg['type'] = 'update';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
      
    }



    public function deleteSubject()
    {

      $id = $this->input->get("delete_id");

      $data['res'] = $this->sub->deleteSubject($id);
      $check = $this->sub->get_subjects_detail_for_delete();
         $check1 = array();
         $check2 = array();
         $check3 = array();
        
        $check1 = $this->sub->fetchPaperPdfData($id);
        if(!empty($check1 )){
            if(file_exists("./public/uploads/papers/".$check1['papers'])){
            unlink("./public/uploads/papers/".$check1['papers']);
            }
         }
       
          $check2 = $this->sub->fetchNotePdfData($id);
            if(!empty($check2)){
            if(file_exists("./public/uploads/notes/".$check2['notes'])){
                unlink("./public/uploads/notes/".$check2['notes']);
            }
        }

        if(!empty($check3)){
            $check3 = $this->sub->fetchBookPdfData($id);
            if(file_exists("./public/uploads/books/".$check3['book'])){
                unlink("./public/uploads/books/".$check3['book']);
            }
            }

      $count = count($check);
      for($i=0; $i<$count; $i++){
        //   $data['result'] = $this->sub->deleteSubjectsDetail($id);
        $this->sub->deleteSubjectsDetail($id);
      }

        echo json_encode($data);
    }


    public function searchSubject()
    {
       $search = $this->input->get("search_data");
       $searchData = $this->sub->searchSubject($search);
       echo json_encode($searchData);

    }

    public function viewSubjectData()
    {
        $id = $this->input->get("view_id");

        $result = array(
                "fetchSubjects" =>  $this->sub->fetchSubjectsData($id)
        );
    
        echo json_encode($result);
    }

     public function updateStatus()
    {
        $id = $this->input->get("stat_id");
        $res = $this->sub->updateStatus($id);
        echo json_encode($res);
    }

    // adding fields  functions

    public function addSubjectFields(){

         $subject_Deatil_Array = array(
             "subject_id" => $this->input->post('fieldID'),
            "branch_id" => $this->input->post('branchesFields'),
            "sem_year_id" => $this->input->post('yosFields')
        );

          $result =$this->sub->addSubjectFields($subject_Deatil_Array);
        
        $msg['success'] = false;
        $msg['type'] = 'addField';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }


    public function getSubjectsFeild(){
        $sub_id = $this->input->get("sub_id");
        $res['branchDetail']= $this->sub->getSubjectsFeild($sub_id);

        foreach($res['branchDetail'] as $val){
        $res['sem_year_Detail'] = $this->sub->getSubjectsFeildForProgram($sub_id, $val['branchID']);
        }
         echo json_encode($res);
    }

    public function deleteField(){
        $sub_id = $this->input->get("subs_id");
        $branch_id = $this->input->get("branch_id");
          $res = $this->sub->deleteField($sub_id, $branch_id);

        echo json_encode($res);
    }

}
?>