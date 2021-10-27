<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('adminName')) && empty($this->session->userdata('adminID'))){
            redirect(base_url().'kSeek/control_panel/unlock');
        }
        $this->load->model("admin/Notes_model", "note");
        
    }

        public function index()
        {
              $data['mainModules'] = "viewnotes";
            $this->load->view("admin/notes/notes", $data);
        }

        public function getSyllabusData(){
               $id = $this->input->get('sub_id');
             $data['syllab_data'] = $this->note->getSyllabus($id);
             echo json_encode($data);
        }


  public function getSubjectData($page= 1) {
            $perpage = 6;
            $param['offset'] = $perpage;
            $param['limit'] = ($page*$perpage-$perpage);
            $this->load->library("pagination");
            $config['base_url']   = "#";
            $config['total_rows'] =   $this->note->subjectsCount();
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
            $data['subjects_data'] =  $this->note->getSubjectData($param);
            echo json_encode($data);
    }




        public function addNotes(){
            $config['upload_path']   = './public/uploads/notes';
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size'] = 100000;
            $config['file_name']  = $this->input->post('name');

            $this->load->library('upload', $config);

                if(!$this->upload->do_upload("notes")) {

                    $error = $this->upload->display_errors();
                    $data['Error'] =  $error;
                   
                }else{

                    $notes_data = $this->input->post();
                    $note = $this->upload->data();

                    $notes_data['notes'] = $note['file_name'];
                    $notes_data['created_at'] = date("y-m-d  H:i:s");

                     $result = $this->note->addNotes($notes_data);
                      if($result){
                            $data['res'] = "add";
                      }else{
                        $data['res'] = "error";
                      }
                }
              echo json_encode($data);
        }


        public function getNotesData(){
             $id= $this->input->get("sub_id");
              $data['notes_data'] =  $this->note->getNotesData($id);
              echo json_encode($data);
        }

    public function viewNotesData()
    {
      $id =$this->input->get("view_id");
      $result = $this->note->viewNotesData($id);
      echo json_encode($result);
    }
  

     public function editNote(){
        $id =$this->input->get("notes_id");
       $result = $this->note->editNote($id);
       echo json_encode($result);
    }

    public function updateNotes($id)
    {
        $check = $this->note->viewNotesData($id);
        if (!empty($_FILES['notes']['name'])) {
            $config['upload_path']   = './public/uploads/notes';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 100000;
            $config['file_name']  = "KnowledgeSeek_".$this->input->post('name');
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload("notes")) {
                $error = $this->upload->display_errors();
                $datas['Error'] =  $error;
               
            }else{
               
                if($check['notes'] != '' && file_exists("./public/uploads/notes/".$check['notes'])){
                  unlink("./public/uploads/notes/".$check['notes']);
                }

                $notes_data = $this->input->post();
                $note = $this->upload->data();

                $notes_data['notes'] = $note['file_name'];
                $notes_data['updated_at'] = date("y-m-d  H:i:s");

                 $result = $this->note->updateNotes($id, $notes_data);
                  if($result){
                        $datas['res'] = "update";
                  }else{
                    $datas['res'] = "error";
                  }
                
            }
        }else{

            $notes_data = $this->input->post();
            $notes_data['updated_at'] = date("d-m-y H:i:s");
            $notes_data['notes'] = $check['notes'];
             $result = $this->note->updateNotes($id, $notes_data);
              if($result){
                    $datas['res'] = "update";
              }else{
                $datas['res'] = "error";
              }
        }
          echo json_encode($datas);
      
    }

    public function deleteNotes()
    {
      $id = $this->input->get("del_id");
      $check = $this->note->viewNotesData($id);
      if(file_exists("./public/uploads/notes/".$check['notes'])){
        unlink("./public/uploads/notes/".$check['notes']);
      }
      $data['res'] = $this->note->deleteNotes($id);
        echo json_encode($data);
    }
    public function searchNotes()
    {
       $search = $this->input->get("search_data");
       $searchData = $this->note->searchNotes($search);
       echo json_encode($searchData);

    }

   
     public function updateStatus()
    {
        $id = $this->input->get("stat_id");
        $res = $this->note->updateStatus($id);
        echo json_encode($res);
    }

}
?>